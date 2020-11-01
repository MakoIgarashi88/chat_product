<template>
    <div>
        <button class="btn btn-primary" @click="modal=true">追加</button>

        <default-modal @close="modal=false" v-if="modal">

            <template slot="header">
                <h5 class="modal-title">グループ追加</h5>
            </template>

            <template slot="body">
                <div>グループ名:</div>
                <div><input type="text" class="form-control" v-model="group_name"></div>
            </template>

            <template slot="footer">
                <button class="btn btn-primary" @click="onStore">追加</button>
            </template>

        </default-modal>
    </div>
</template>

<script>
export default {
    data () {
        return {
            group_name: null,
            modal: false,
            isLoading: false,
        }
    },
    mounted () {
        //
    },
    methods: {
        onStore () {
            if (!this.group_name) {
                alert('グループ名を入力してください。')
                return
            }
            this.isLoading = true
            axios.post('/api/group/', {
                name: this.group_name,
            }).then(resp => {
                this.modal = false
                this.$emit('update')
            }).catch(error => {
                alert('グループの作成に失敗しました。')
            }).finally(resp => {
                this.isLoading = false
            })
        }
    }
}
</script>
