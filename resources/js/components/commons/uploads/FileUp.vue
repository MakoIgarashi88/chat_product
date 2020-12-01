<template>
    <div>
        <v-row>
            <v-col class="text-center">
                <IconLg :src="image" />
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col>
                <v-file-input label="画像を選択してください" outlined dense prepend-icon="mdi-camera"></v-file-input>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    data () {
        return {
            image: '/storage/images/1z2M3ouOdb74r93Q.png',
        }
    }
}
</script>