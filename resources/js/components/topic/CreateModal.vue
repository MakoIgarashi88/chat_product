<template>
    <div>
        <v-btn @click="modal=true"><i class="far fa-file-alt"></i></v-btn>

        <default-modal @close="modal=false" v-show="modal">

            <template slot="header">
                <v-row>
                    <v-col class="text-center">
                        トピック作成
                    </v-col>
                </v-row>
            </template>
            <template slot="body">
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col>
                            <v-textarea label="トピックタイトル" auto-grow outlined rows="1" row-height="15"></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-col cols="5">
                            <v-file-input label="画像を選択" outlined dense></v-file-input>
                        </v-col>
                        <v-col></v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-textarea label="詳細" auto-grow outlined rows="3" row-height="25"></v-textarea>
                        </v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col>
                            <v-textarea label="タグ" auto-grow outlined rows="1" row-height="15"></v-textarea>
                        </v-col>
                        <v-col>
                            <v-btn>確定</v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-card outlined>
                                <v-row>
                                    <v-col>
                                        <v-chip class="ml-2">漫画</v-chip>
                                        <v-chip class="ml-2">漫画</v-chip>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-form>
            </template>
            <template slot="footer">
                <v-row>
                    <v-col class="text-center">
                        <v-btn>作成</v-btn>
                    </v-col>
                </v-row>
            </template>
        </default-modal>
    </div>
</template>

<script>
export default {
    data () {
        return {
            modal: false,
            valid: true,
        }
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>