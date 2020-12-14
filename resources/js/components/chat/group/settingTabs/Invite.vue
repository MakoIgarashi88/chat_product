<template>
    <v-card outlined>
        <div v-if="invites.length">
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                        <th class="text-right">
                        </th>
                        <th class="text-left">
                            友だちリスト
                        </th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(invite, index) in invites" :key="index">
                        <td class="text-right"><IconSm :src="invite.image_name" /></td>
                        <td class="text-left">{{ invite.nickname }}</td>
                        <td><input type="checkbox"></td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
            <v-divider></v-divider>
            <v-card-text class="pa-0">
                <v-row>
                    <v-col class="text-center">
                        <v-btn color="primary">招待</v-btn>
                    </v-col>
                </v-row>
            </v-card-text>   
        </div>
        <div v-else>
            <v-card-text>
                <v-row>
                    <v-col class="text-center">
                        招待できるフレンドがいません
                    </v-col>
                </v-row>
            </v-card-text>
        </div>
    </v-card>
</template>

<script>
import { mapState } from 'vuex'
export default {
    computed: mapState([ 'invites' ]),
}
</script>