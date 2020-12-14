<template>
    <v-card outlined>
        <v-card-text>
            <v-row justify="center">
                <v-col cols="auto">
                    <FileUp :image_name="group.image_name" @change="imageUpload"/>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col cols="12" sm="auto" class="text-sm-end">
                        グループ名 : 
                </v-col>
                <v-col cols="12" sm="auto">
                    <v-text-field auto-grow outlined hide-details v-model="group_name"></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col cols="12" sm="auto" class="text-sm-end">
                        詳細 : 
                </v-col>
                <v-col cols="12" sm="auto">
                    <v-textarea auto-grow outlined hide-details roes="1" row-height="15" v-model="group_detail"></v-textarea>
                </v-col>
            </v-row>
            <v-row>
                <v-col class="text-center">
                    <v-btn color="primary" @click="onChange" >変更</v-btn>
                </v-col>
            </v-row>
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
            this.$store.commit('startLoading')
            axios.put('/api/group/edit', {
                group_id: this.group.id,
                group_name: this.group_name,
                group_detail: this.group_detail,
                group_image: this.upload_image,
            }).then(res => {
                console.log(res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$emit('change')
            })
        }
    }
}
</script>