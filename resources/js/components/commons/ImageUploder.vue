<template>
    <div>
        <div class="file-uploder">
            画像を選択
            <input type="file" @change="previewImage" accept="image/*">
        </div>
        <div v-if="imageData.length > 0">
            <img :src="imageData">
        </div>
    </div>
</template>


<script>
export default {
    data () {
        return {
            imageData: ""
        }
    },
    methods: {
        previewImage: function(event) {
            // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    this.imageData = e.target.result;
                }
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.file-uploder {
    display: inline-block;
    overflow: hidden;
    position: relative;
    padding: 1em;
    border: 1px solid #dd0000;
    background: #dd0000;
    color:#fff;
}
 
.file-uploder input[type="file"] {
    opacity: 0;
    filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
    position: absolute;
    right: 0;
    top: 0;
    margin: 0;
    font-size: 100px;
    cursor: pointer;
}
</style>