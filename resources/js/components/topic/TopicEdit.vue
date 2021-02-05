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
                            トピック編集
                        </v-col>
                    </v-row>
                </v-card-title>
               <v-card-text>
                    <v-form ref="form">
                        <v-row>
                            <v-col>
                                <FileUp :image_name="image" @change="onChange"/>
                            </v-col>
                        </v-row>
                        <v-row justify="center">
                            <v-col>
                                <v-text-field
                                label="トピックタイトル"
                                :rules="nameRules"
                                outlined
                                rows="1"
                                row-height="15"
                                v-model="name"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                label="詳細"
                                :rules="detailRules"
                                outlined
                                rows="2" 
                                row-height="15" 
                                v-model="detail"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                        <v-form ref="form2">
                            <v-row align="center">
                                <v-col>
                                    <v-text-field
                                    :disabled="tags.length >= 3"
                                    :label="tags.length >= 3 ? 'タグの設定は３件までです' :'タグ'" 
                                    :error-messages="tag.length >= 30 ? '30文字以内で入力してください' : ''"
                                    v-model="tag" 
                                    outlined 
                                    required
                                    @keyup.enter="onAddTag"
                                    />
                                </v-col>
                                <v-col cols="auto">
                                    <v-btn color="primary" @click="onAddTag" :disabled="tag.length>=30">追加</v-btn>
                                </v-col>
                            </v-row>
                        </v-form>
                        <v-row>
                            <v-col>
                                <v-card outlined>
                                    <v-row>
                                        <v-col>
                                            <v-chip-group>
                                                <v-chip v-for="(tag,index) in tags" :key="index"
                                                    @click:close="onRemove(index)"
                                                    close
                                                    class="ml-2"
                                                    small
                                                    color="tag" 
                                                    text-color="white" 
                                                    >
                                                    {{tag}}
                                                </v-chip>
                                            </v-chip-group>
                                        </v-col>
                                    </v-row>
                                </v-card>
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
import { mapState } from 'vuex'
export default {
    props: ['isLoading', 'topic_id', 'image', 'old_title', 'old_detail', 'old_tags'],
    data () {
        return {
            dialog: false,
            name: "",
            detail: "",
            image_name: "",
            tag: "",
            tags: [],
            nameRules: [
                v => !!v || 'タイトルを入力してください',
                v => (v && v.length <= 20) || '20文字以内で入力してください',
            ],
            detailRules: [
                v => !!v || '詳細を入力してください',
                v => (v && v.length <= 100) || '100文字以内で入力してください',
            ],
        }
    },
    computed: mapState([ 'topic' ]),
    methods: {
        onEdit() {
            if (!this.$refs.form.validate()) return
            this.$store.commit('startLoading')
            axios.post('/api/topic/detail', {
                topic_id     : this.topic_id,
                name         : this.name,
                detail       : this.detail,
                tags         : this.tags,
                upload_image : this.image_name,
            }).then(res => {
                this.$store.commit('topicUpdate', res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.dialog = false
                this.$refs.form.reset()
                this.topic_title = ''
                this.detail = ''
                this.tag = ''
                this.tags = [],
                this.$store.commit('finishLoading')
            })
        },
        onChange(file) {
            this.image_name = file
        },
        onAddTag () {
            if (!this.$refs.form2.validate()) return
            if ( this.tag ) {
                this.tags.push(this.tag)
                this.tag = ""
            }
        },
        onRemove (index) {
            this.tags.splice(index, 1)
            // if (!this.tags.length) {
            //     this.tags = []
            // }
        },
    },
    watch: {
        dialog (dialog) {
            if (dialog) {
                this.name   = _.cloneDeep(this.old_title)
                this.detail = _.cloneDeep(this.old_detail)
                this.tags   = _.cloneDeep(this.old_tags)
            } else {
                this.name   = ""
                this.detail = ""
                this.tags   = ""
            }
        },
    }
}
</script>