<template>
    <div>
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary">
                    トピックを作る
                </v-btn>
            </template>

            <v-card>
                <v-card-title>
                    <v-row justify="center">
                        <v-col class="text-center">
                            トピック作成
                        </v-col>
                    </v-row>
                </v-card-title>

                <v-card-text>
                    <v-form lazy-validation ref="form">
                        <FileUp @change="entryImage"/>
                        <v-row justify="center">
                            <v-col>
                                <v-text-field
                                label="トピックタイトル"
                                required
                                :rules="nameRules"
                                outlined rows="1"
                                row-height="15"
                                v-model="topic_title"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                label="詳細" 
                                required
                                :rules="detailRules"
                                outlined rows="2" 
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
                                        @keyup.enter="onAddTag"
                                        />
                                </v-col>
                                <v-col cols="auto">
                                    <v-btn @click="onAddTag" color="primary" :disabled="tag.length>=30">追加</v-btn>
                                </v-col>
                            </v-row>
                        </v-form>
                        <v-row>
                            <v-col>
                                <v-card outlined>
                                    <v-row>
                                        <v-col>
                                            <v-chip-group>
                                                <v-chip
                                                v-for="(tag,index) in tags" :key="index"
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
                                <v-btn color="primary" @click="onAdd">作成</v-btn>
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
            dialog: false,
            upload_image: null,
            topic_title: "",
            detail: "",
            tag: "",
            tags: [],
            nameRules: [
                v => !!v || 'タイトルを入力してください',
                v => (v.length <= 20) || '20文字以内で入力してください',
            ],
            detailRules: [
                v => !!v || '詳細を入力してください',
                v => (v.length <= 100) || '100文字以内で入力してください',
            ],
        }
    },
    computed: mapState([ 'isLoading' ]),
    methods: {
        entryImage: function (file)  {
            // console.log(file)
            this.upload_image = file
        },
        onAdd () {
            if (!this.$refs.form.validate()) return
            this.$store.commit('startLoading')
            axios.post('/api/topic', {
                upload_image: this.upload_image,
                name        : this.topic_title,
                detail      : this.detail,
                tags        : this.tags,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.dialog = false,
                this.$refs.form.reset()
                this.topic_title = ''
                this.detail = ''
                this.tag = ''
                this.tags = [],
                this.$emit('update')
                this.$store.commit('finishLoading')
            })
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
            console.log(this.tags)
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>