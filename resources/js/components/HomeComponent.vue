<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Home Component</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                I'm an home component.
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">
                                <router-link :to="{ name: 'chat' }" class="btn btn-primary ">チャット</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted () {
            this.getItems()
        },
        methods: {
            getItems: function () {
                axios.get('/api/user')
                .then(resp => {
                    console.log(resp)
                    this.users = resp.data
                }).catch(error => {
                    // alert(error)
                })
            },
        }
    }
</script>
