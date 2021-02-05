<template>
    <v-card outlined>
        <v-card-text>
            <v-form ref="form">
                <v-row justify="center">
                    <v-col cols="auto">
                        <FileUp :image_name="group.image_name" @change="imageUpload"/>
                    </v-col>
                </v-row>
                <v-row justify="center" align="center">
                    <v-col cols="9">
                        <v-text-field
                        label="グループ名"
                        :rules="nameRules"
                        required
                        auto-grow 
                        outlined 
                        v-model="group_name"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row justify="center" align="center">
                    <v-col cols="9">
                        <v-textarea
                        label="詳細"
                        :rules="detailRules"
                        required
                        auto-grow 
                        outlined 
                        row-height="15" 
                        v-model="group_detail"></v-textarea>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col class="text-center">
                        <v-btn color="primary" @click="onChange" >変更</v-btn>
                    </v-col>
                </v-row>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
import { mapState } from 'vuex'
export default {
    data () {
        return {
            group_name: "",
            group_detail: "",
            upload_image: "",
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
    computed: mapState([ 'group', 'isLoading' ]),
    mounted () {
        this.group_name = this.group.name
        this.group_detail = this.group.detail
    },
    methods: {
        imageUpload (data) {
            this.upload_image = data
        },
        onChange () {
            if (!this.$refs.form.validate()) return
            this.$store.commit('startLoading')
            axios.put('/api/group/edit', {
                group_id: this.group.id,
                group_name: this.group_name,
                group_detail: this.group_detail,
                group_image: this.upload_image,
            }).then(res => {
                alert('編集しました')
                // console.log(res.data)
            }).catch(error => {
                alert('送信に失敗しました')
            }).finally(res => {
                this.$emit('change')
            })
        }
    }
}
</script>