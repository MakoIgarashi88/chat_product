<template>
    <div class="text-center pt-2 pb-2">
        <v-pagination v-model="page" :length="pageCount" circle @input="pageChange"></v-pagination>
    </div>
</template>

<script>
export default {
    props: {
        pageCount: {
            type: Number,
        }
    },
    data () {
        return {
            page: 1,
        }
    },
    methods: {
        pageChange: function(pageNumber){
        //   console.log(number)
        this.$emit('getPage', pageNumber)
        },
    }
}
</script>