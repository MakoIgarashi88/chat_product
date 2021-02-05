<template>
    <div>
        <v-row justify="center">
            <v-col>
                <v-textarea 
                solo 
                label="メッセージを入力してください"
                :error-messages="message.length > 400 ? '400文字以内で入力してください' : ''"
                v-model="message"
                ></v-textarea>
            </v-col>
        </v-row>
        <v-row justify="center" class="pa-0">
            <v-col cols="auto" class="pa-0 pb-2">
                <v-btn 
                color="primary" 
                @click="onSubmit"
                :disabled="!message || message.length > 400"
                >送信</v-btn>
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
            this.$emit('submit', this.message) 
            this.message = ""
        }
    }
}
</script>