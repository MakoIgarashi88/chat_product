<template>
    <div>
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary">
                    <i class="fas fa-cog"></i>
                </v-btn>
            </template>

            <v-card>
                <v-card-title>
                    <v-row justify="center">
                        <v-col class="text-center">
                            掲示板編集
                        </v-col>
                    </v-row>
                </v-card-title>
               <v-card-text>
                    <v-form ref="form">
                        <v-row justify="center">
                            <v-col>
                                <v-text-field
                                 label="掲示板タイトル"
                                 outlined
                                 rows="1"
                                 row-height="15"
                                 v-model="name"
                                 required
                                 :rules="nameRules"
                                 ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                 label="詳細" 
                                 outlined rows="2" 
                                 row-height="15" 
                                 v-model="detail"
                                 :rules="detailRules"
                                 ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col class="text-center">
                                <v-btn color="primary" @click="onEdit()">編集</v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
               </v-card-text>

            </v-card>
            <b-loading :isLoading.sync="isLoading" />
        </v-dialog>
    </div>
</template>

<script>
export default {
    props: ['isLoading', 'old_title', 'old_detail'],
    data () {
        return {
            dialog: false,
            name: "",
            detail: "",
            nameRules: [
                v => !!v || 'タイトルを入力してください',
                v => (v && v.length <= 20) || '20文字以内で入力してください',
            ],
            detailRules: [
                v => !!v || '詳細を入力してください',
                v => (v && v.length <= 400) || '400文字以内で入力してください',
            ],
        }
    },
    methods: {
        onEdit () {
            if (!this.$refs.form.validate()) return
            this.$store.commit('startLoading')
            axios.post('/api/board', {
                name   : this.name,
                detail : this.detail,
            }).then(res=> {
                this.$store.commit('boardUpdate', res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.dialog = false
                this.$store.commit('finishLoading')
            })
        },
    },
    watch: {
        old_title (old_title) {
            this.name = _.cloneDeep(old_title)
        },
        old_detail (old_detail) {
            this.detail = _.cloneDeep(old_detail)
        },
    },
}
</script>