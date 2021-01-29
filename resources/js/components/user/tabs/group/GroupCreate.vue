<template>
    <div>
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary">
                    グループ作成
                </v-btn>
            </template>

            <v-card>
                <v-card-title>
                    <v-row justify="center">
                        <v-col class="text-center">
                            グループ作成
                        </v-col>
                    </v-row>
                </v-card-title>

                <v-card-text>
                    <v-form ref="form">
                        <FileUp @change="entryImage"/>
                        <v-row justify="center">
                            <v-col>
                                <v-text-field
                                 label="グループ名"
                                 :rules="nameRules"
                                  outlined rows="1"
                                  row-height="15"
                                  v-model="group_name"
                                  ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                 label="詳細"
                                 :rules="detailRules"
                                 outlined rows="2" 
                                 row-height="15" 
                                 v-model="detail"
                                 ></v-textarea>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <v-simple-table>
                                    <template v-slot:default>
                                        <thead>
                                            <tr>
                                            <th class="text-right">
                                            </th>
                                            <th class="text-left">
                                                友だちリスト
                                            </th>
                                            <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(friend, index) in mp_friends" :key="index">
                                            <td class="text-right pa-1"><IconSm :src="friend.image_name" /></td>
                                            <td class="text-left">{{ friend.nickname }}</td>
                                            <td><v-checkbox :value="friend.id" v-model="checked"></v-checkbox></td>
                                            </tr>
                                        </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col class="text-center">
                                <v-btn color="primary" @click="onAdd()">作成</v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    data () {
        return {
            group_name: null,
            modal: false,
            dialog: false,
            upload_image: "",
            group_name: "",
            detail: "",
            checked: [],
            nameRules: [
                v => !!v || 'タイトルを入力してください',
                v => (v && v.length <= 20) || '20文字以内で入力してください',
            ],
            detailRules: [
                v => !!v || '詳細を入力してください',
                v => (v && v.length <= 50) || '50文字以内で入力してください',
            ],
        }
    },
    mounted () {
        //
    },
    computed: mapState([ 'isLoading', 'mp_friends', 'mp_groups']),
    methods: {
        entryImage: function (file)  {
            // console.log(file)
            this.upload_image = file
        },
        onAdd () {
            if (!this.$refs.form.validate()) return
            this.$store.commit('startLoading')
            axios.post('/api/group/', {
                name        : this.group_name,
                detail      : this.detail,
                upload_image: this.upload_image,
                checked     : this.checked,
            }).then(resp => {
                console.log(resp.data)
                this.$store.commit ('groupPush', {
                    file : resp.data.new_group
                })
                console.log(this.mp_groups)
            }).catch(error => {
                alert('グループの作成に失敗しました。')
            }).finally(resp => {
                this.checked = [],
                this.dialog = false
                this.$store.commit('finishLoading')
            })
        }
    },
}
</script>