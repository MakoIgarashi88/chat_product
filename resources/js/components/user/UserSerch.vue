<template>
    <div>
        <button class="btn btn-primary" @click="modal=true">追加</button>

        <default-modal @close="modal=false" v-if="modal">

            <template slot="header">
                <h5 class="modal-title">友だち追加</h5>
            </template>

            <template slot="body">
                <div class="row align-items-center">
                    <div class="mr-2">友だちの名前 :</div>
                    <div><input type="text" class="form-control" v-model="search_name"></div>
                </div>
                <div class="row justify-content-between mt-3" v-if="friend.id">
                    <div class="col-auto">名前 :</div>
                    <div class="col-auto">{{ friend.name }}</div>
                    <div class="col-auto">ニックネーム :</div>
                    <div class="col-auto">{{ friend.nickname }}</div>
                    <div class="col-auto">
                        <button class="btn btn-primary" @click="onAddFriend">追加</button>
                    </div>
                </div>

            </template>

            <template slot="footer">
                <button class="btn btn-primary" @click="onSearch">検索</button>
            </template>

        </default-modal>
    </div>
</template>

<script>
export default {
    data () {
        return {
            search_name: null,
            modal: false,
            isLoading: false,
            friend: {
                id: null,
                name: null,
                nickname: null,
            }
        }
    },
    mounted () {
        //
    },
    methods: {
        onSearch() {
            axios.get('/api/friend/search/' + this.search_name)
            .then(res => {
                this.friend = res.data
            }).catch(error => {
                alert(error)
            })
            // if (confirm('友だちを追加しますか？')) {
            //     console.log('友だち追加の処理')
            // }
        },
        onAddFriend () {
            axios.post('/api/friend/add/', {
                friend_id: this.friend.id,
            }).then(resp => {
                if (resp.data.message.length) {
                    alert(resp.data.message)
                } else {
                    alert('友だちになりました。')
                    this.$emit('update')
                }
            }).catch(error => {
                alert('友だちの追加に失敗しました。')
            })
        }
    }
}
</script>
