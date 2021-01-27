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
                   <v-row>
                       <v-col>
                           <FileUp :image_name="image" @change="onChange"/>
                       </v-col>
                   </v-row>
                    <v-row justify="center">
                        <v-col>
                            <v-text-field
                             label="トピックタイトル"
                             outlined
                             rows="1"
                             row-height="15"
                             hide-details
                             v-model="name"
                             ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-textarea
                             label="詳細" 
                             outlined rows="2" 
                             row-height="15" 
                             hide-details
                             v-model="detail"
                             ></v-textarea>
                        </v-col>
                    </v-row>
                    <form @submit.prevent="onAddTag">
                        <v-row align="center">
                            <v-col>
                                <v-text-field
                                    v-if="tags.length < 3"
                                    label="タグ" 
                                    v-model="tag" 
                                    outlined 
                                    hide-details 
                                    required
                                    />
                                <v-text-field
                                    v-else
                                    label="タグの設定は３件までです"  
                                    outlined 
                                    hide-details 
                                    required
                                    disabled
                                    />
                            </v-col>
                            <v-col cols="auto">
                                <v-btn type="submit" color="primary">追加</v-btn>
                            </v-col>
                        </v-row>
                    </form>
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
        }
    },
    computed: mapState([ 'topic' ]),
    methods: {
        onEdit() {
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
                this.$store.commit('finishLoading')
            })
        },
        onChange(file) {
            this.image_name = file
        },
        onAddTag () {
            if ( this.tag ) {
                this.tags.push(this.tag)
                this.tag = ""
            }
        },
        onRemove (index) {
            this.tags.splice(index, 1)
        },
    },
    watch: {
        old_title (old_title) {
            this.name = _.cloneDeep(old_title)
        },
        old_detail (old_detail) {
            this.detail = _.cloneDeep(old_detail)
        },
        old_tags (old_tags) {
            this.tags = _.cloneDeep(old_tags)
        },
    }
}
</script>