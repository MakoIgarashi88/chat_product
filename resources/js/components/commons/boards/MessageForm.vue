<template>
    <div>
        <v-row justify="center">
            <v-col>
                <v-textarea solo label="メッセージを入力してください" v-model="message"></v-textarea>
            </v-col>
        </v-row>
        <v-row justify="center" class="pa-0">
            <v-col cols="auto" class="pa-0 pb-2">
                <v-btn color="primary" @click="onSubmit">送信</v-btn>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    data () {
        return {
            message: "",
        }
    },
    methods: {
        onSubmit () {
            if (!this.message) {
                alert ('メッセージを入力してください')
                return
            } else {
                this.$emit('submit', this.message) 
                this.message = ""
            }
        }
    }
}
</script>