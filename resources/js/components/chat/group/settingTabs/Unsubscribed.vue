<template>
    <v-card outlined>
        <v-row>
            <v-col class="text-center">
                <v-btn color="primary" @click="onRemove">退会</v-btn>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
import { mapState } from 'vuex'
export default {
    computed: mapState([ 'members' ]),
    methods: {
        onRemove () {
            if(confirm('本当に退会しますか')) {
                aaaaa
            }
        }
    }
}
</script>