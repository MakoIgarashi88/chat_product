<template>
    <v-card outlined>
        <v-card-subtitle v-show="group.detail">
            {{group.detail}}
        </v-card-subtitle>
        <v-simple-table>
            <template v-slot:default>
            <thead>
                <tr>
                <th class="text-right">
                </th>
                <th class="text-left">
                    メンバー
                </th>
                </tr>
            </thead>
            <tbody>
                <tr
                v-for="(member, index) in members" :key="index">
                <td class="text-right pa-1"><IconSm :src="member.image_name"/></td>
                <td class="text-left">
                    <router-link :to="{ name: 'friend.show', params: { 'user_id': member.id } }">
                        {{ member.nickname }}
                    </router-link>
                </td>
                </tr>
            </tbody>
            </template>
        </v-simple-table>
    </v-card>
</template>

<script>
import { mapState } from 'vuex'
export default {
    computed: mapState([ 'members', 'group' ]),
}
</script>