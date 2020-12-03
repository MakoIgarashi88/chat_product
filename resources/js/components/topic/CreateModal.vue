<template>
    <div>
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary">
                    <i class="far fa-plus-square"></i>
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
                    <FileUp />
                    <v-row justify="center">
                        <v-col>
                            <v-textarea
                             label="トピックタイトル"
                              outlined rows="1"
                              row-height="15"
                              hide-details
                              v-model="topic_title"
                              ></v-textarea>
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
                    <v-row align="center">
                        <v-col>
                            <v-textarea
                             label="タグ" 
                             outlined 
                             rows="1" 
                             row-height="15" 
                             hide-details
                             ></v-textarea>
                        </v-col>
                        <v-col cols="auto">
                            <v-btn color="primary">追加</v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-card outlined>
                                <v-row>
                                    <v-col>
                                        <v-chip class="ml-2">漫画</v-chip>
                                        <v-chip class="ml-2">鬼滅</v-chip>
                                        <div>ここに順次追加されていく</div>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="text-center">
                            <v-btn color="primary" @click="onAdd()">作成</v-btn>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>
        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
export default {
    data () {
        return {
            dialog: false,
            topic_title: "",
            detail: "",
            isLoading: false,
        }
    },
    methods: {
        onAdd () {
            this.isLoading = true
            axios.post('/api/topic/', {
                name: this.topic_title,
                detail: this.detail,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.isLoading = false
                this.dialog = false
                this.$emit('update')
            })
        },
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>