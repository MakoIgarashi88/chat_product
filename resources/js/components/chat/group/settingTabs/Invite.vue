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
                        <td class="text-right pa-1"><IconSm :src="invite.image_name" /></td>
                        <td class="text-left">{{ invite.nickname }}</td>
                        <td><v-checkbox :value="invite.id" v-model="checked"></v-checkbox></td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
            <v-divider></v-divider>
            <v-card-text class="pa-0">
                <v-row>
                    <v-col class="text-center">
                        <v-btn color="primary" @click="onInvite">招待</v-btn>
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
    computed: mapState(['isLoading', 'invites', 'group' ]),
    data () {
        return {
            checked: [],
        }
    },
    methods: {
        onInvite () {
            this.$store.commit('startLoading')
            axios.post('/api/group/invite', {
                group_id: this.group.id,
                invite_ids: this.checked,
            }).then(res => {
                // console.log(res.data)
                this.$store.commit('groupInvitePush', res.data)
            }).catch(error => {
                alert(error)
            }).finally(res => {
                this.checked = [],
                this.$emit('close')
                this.$store.commit('finishLoading')
            })
        },
    }
}

</script>