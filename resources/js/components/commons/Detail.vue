<template>
    <v-card outlined>
        <v-card-title>
            {{topic.name}}
        </v-card-title>
        <v-card-text class="text-left">
            {{topic.detail}}
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data () {
        return {
            topic: {
                name: 'こんにちは',
                detail: '自由に書き込んでください',
            },
        }
    }
}
</script>