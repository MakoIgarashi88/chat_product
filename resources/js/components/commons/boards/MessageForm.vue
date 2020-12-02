<template>
    <div>
        <v-row justify="center">
            <v-col>
                <v-textarea solo label="メッセージを入力してください"></v-textarea>
            </v-col>
        </v-row>
        <v-row justify="center" class="pa-0">
            <v-col cols="auto" class="pa-0 pb-2">
                <v-btn color="primary">送信</v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    data () {
        return {
        }
    }
}
</script>