<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">User Component</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                Users List.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto" v-for="user in users" :key="user.id">{{user.name}}</div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            users: [],
            isLoading: false,
        }
    },
    mounted () {
        this.getItems()
    },
    methods: {
        getItems: function () {
            axios.get('/api/user/list')
            .then(resp => {
                this.users = resp.data
            }).catch(error => {
                alert(error)
            })
        },
    }
}
</script>
