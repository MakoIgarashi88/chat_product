<template>
    <div>
        <v-row>
            <v-col class="text-center">
                <IconLg :src="image" v-if="!upload_image" />
                <IconLg :src="upload_image" v-else />
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col>
                <v-file-input
                 label="画像を選択してください"
                 outlined
                 dense
                 prepend-icon="mdi-camera"
                 accept="image/*"
                 @change="changeImage"
                 ></v-file-input>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: [ 'image_name' ],
    mounted() {
        if (this.image_name) this.image = this.image_name
    },
    data () {
        return {
            upload_image: null,
            image: '/storage/images/default.png',
            file_name: "",
        }
    },
    methods: {
       changeImage (file) {
            if (file !== undefined && file !== null) {
                if (file.name.lastIndexOf('.') <= 0) {
                    return
                }
                const fr = new FileReader()
                fr.readAsDataURL(file)
                fr.addEventListener('load', () => {
                    this.upload_image = fr.result
                    this.$emit('change', this.upload_image)
                })
            } else {
                this.upload_image = null
            }
        }
    }
}
</script>