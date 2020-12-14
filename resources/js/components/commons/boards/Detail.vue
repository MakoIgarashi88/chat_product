<template>
    <v-card outlined>
        <v-card-title>
            {{board.name}}
        </v-card-title>
        <v-card-text class="text-left">
            {{board.detail}}
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: ['board'],
    data () {
        return {
        }
    },
}
</script>