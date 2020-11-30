<template>
    <v-container>
        <v-row justify="center">
            <v-col>
                <v-card>
                    <v-card-title>
                        <v-row>
                            <v-col class="text-center">
                                <v-btn color="primary"><i class="fas fa-home"></i></v-btn>
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
                                <v-btn color="primary">送信</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import Message from '../Message.vue'
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
