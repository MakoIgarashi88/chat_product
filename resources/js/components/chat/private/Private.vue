<template>
    <v-container>
        <v-row justify="center">
            <v-col>
                <v-card>
                    <v-card-title>
                        <v-row>
                            <v-col class="text-center">
                                <HomeButton />
                            </v-col>
                            <v-col class="text-center">
                                {{friend.name}}
                            </v-col>
                            <v-col class="text-center">
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text>
                        <Message :image="friend.image" />
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
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import Message from './Message.vue'
export default {
    props: ['friend_id'],
    data () {
        return {
            friend: {
                name: 'fuuga',
                image: '/storage/images/e4yocHpzM84s5Z4f.png',
            },
            message: null,
            messages: [

            ],
            isLoading: false,
        }
    },
    components: {
        Message,
    }
}
</script>
