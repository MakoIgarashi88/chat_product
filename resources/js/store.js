import Vuex from 'vuex';
import Vue from 'vue';
Vue.use(Vuex);
 
export default new Vuex.Store({
    strict: true, // strictは本番環境では必ず無効化してください
    state: {
        isLoading: false,
        count: 0,
        books: {
            name: '東方',
            price: 10000
        },
    },
    mutations: {
        startLoading (state) {
            state.isLoading = true
        },
        finishLoading (state) {
            state.isLoading = false
        },
        minus(state) {
            state.count--
        },
        plus(state) {
            state.count++
        },
        addBook(state, payload) {
            state.books.push(payload.book)
        }
    },
    getters: {
        // bookCount(state) {
        //     return state.books.length
        // },
        // getBookByPrice(state) {
        //     return price => {
        //         return state.books.filter(book => book.price < price)
        //     }
        // }
    }
});