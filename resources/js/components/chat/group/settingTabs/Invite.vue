<template>
    <v-card outlined>
        <v-simple-table>
            <template v-slot:default>
            <thead>
                <tr>
                <th class="text-center">
                    #
                </th>
                <th class="text-center">
                    友だちリスト
                </th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <tr
                v-for="(item, index) in users" :key="index">
                <td class="text-center">{{index+1}}</td>
                <td class="text-center">{{ item }}</td>
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
    </v-card>
</template>

<script>
export default {
    data () {
        return {
            users: [
                "胡蝶しのぶ",
                "爆豪勝己",
                "チャンミン",
            ]

        }
    },
}
</script>