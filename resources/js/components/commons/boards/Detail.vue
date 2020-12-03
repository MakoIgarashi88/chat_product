<template>
    <v-card outlined>
        <v-card-title>
            {{name}}
        </v-card-title>
        <v-card-text class="text-left">
            {{detail}}
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: ['name', 'detail'],
    data () {
        return {
        }
    },
}
</script>