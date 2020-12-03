<template>
    <div>
        <v-row justify="center">
            <v-col class="text-center">
                <v-btn @click="minus">-</v-btn>
            </v-col>
            <v-col class="text-center">
                {{ count }}
            </v-col>
            <v-col class="text-center">
                <v-btn @click="plus">+</v-btn>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col class="text-center">
                <form @submit.prevent="onClick">
                    <div>名前</div>
                    <input type="text" v-model="name" /><br/>
                    <div>価格</div>
                    <input type="number" v-model="price" /><br/>
                    <input type="submit" value="登録" /><br/>
                </form>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            name: "",
            price: 0,
        }
    },
    name: 'app',
    computed: {
        ...mapState([ 'count' ]),
        ...mapGetters([ 'books' ])
    },
    methods: {
        minus() {
            this.$store.commit('minus')
        },
        plus() {
            this.$store.commit('plus')
        }, 
        onClick() {
            this.$store.commit('addBook' , {
                book: {
                    name: this.name, price: this.price
                }
            })
        }
    }
}
</script>