<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on, attrs }">
                <v-btn color="primary" v-bind="attrs" v-on="on">
                    <i class="fas fa-bars"></i>
                </v-btn>
            </template>
            <v-card>
                <v-tabs v-model="tab" background-color="secondary" centered dark icons-and-text>
                    <v-tabs-slider></v-tabs-slider>

                    <v-tab>
                        参加者
                        <v-icon>mdi-account-multiple</v-icon>
                    </v-tab>

                    <v-tab>
                        招待
                        <v-icon>mdi-email</v-icon>
                    </v-tab>

                    <v-tab>
                        編集
                        <v-icon>mdi-pencil</v-icon>
                    </v-tab>
                    <v-tab>
                        退会
                        <v-icon>mdi-exit-to-app</v-icon>
                    </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                    <v-tab-item>
                        <Member />
                    </v-tab-item>
                    <v-tab-item>
                        <Invite />
                    </v-tab-item>
                    <v-tab-item>
                        <Edit />
                    </v-tab-item>
                    <v-tab-item>
                        退会処理
                    </v-tab-item>
                </v-tabs-items>
                <!-- <v-card-title>
                    <v-row justify="center">
                        <v-col class="text-center">
                            
                        </v-col>
                    </v-row>
                </v-card-title>
                <v-card-subtitle>
                    <v-row justify="center">
                        <v-col class="text-center">
                            <v-btn>参加者</v-btn>
                        </v-col>
                        <v-col class="text-center">
                            <v-btn>招待</v-btn>
                        </v-col>
                        <v-col class="text-center">
                            <v-btn>編集</v-btn>
                        </v-col>
                        <v-col class="text-center">
                            <v-btn>退会</v-btn>
                        </v-col>
                    </v-row>
                </v-card-subtitle>
                <v-card-text>
                    <v-container>
                        <v-row>
                        </v-row>
                    </v-container>
                </v-card-text> -->
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog = false">
                        Close
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
import Member from './settingTabs/Member.vue'
import Invite from './settingTabs/Invite.vue'
import Edit from './settingTabs/Edit.vue'
export default {
    data () {
        return {
            dialog: false,
            tab: null,
        }
    },
	components: {
        Member,
        Invite,
        Edit,
	}

}
</script>