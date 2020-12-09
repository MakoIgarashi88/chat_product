<template>
    <div>
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-bind="attrs" v-on="on" color="primary">
                    メッセージを送信<i class="far fa-comment-dots"></i>
                </v-btn>
            </template>

            <v-card>
                <v-card-title>
                    <v-row>
                        <v-col class="text-center">
                            <HomeButton />
                        </v-col>
                        <v-col class="text-center">
                            {{group.name}}
                        </v-col>
                        <v-col class="text-center">
                            <GroupSetting />
                        </v-col>
                    </v-row>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <Message />
                </v-card-text>
                <v-divider></v-divider>
                <v-card-text class="pt-0 pb-0">
                    <v-row justify="center" align="center">
                        <v-col>
                            <v-textarea auto-grow outlined rows="1" row-height="15" hide-details></v-textarea>
                        </v-col>
                        <v-col cols="auto">
                            <SendButton />
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>
        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
import Message from './Message.vue'
import GroupSetting from '../group/GroupSetting.vue'
export default {
    props: ['group_id'],
    data () {
        return {
            group: {
                name: 'いつめん'
            },
            message: null,
            messages: [

            ],
            isLoading: false,
        }
    },
    components: {
        Message,
        GroupSetting,
    }
}
</script>
