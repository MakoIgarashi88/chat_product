/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router'
window.Vue = Vue;
Vue.use(VueRouter);

import store from './store.js';

import Vuetify from 'vuetify';
Vue.use(Vuetify);
import 'material-design-icons-iconfont/dist/material-design-icons.css'

import DatePickerStandard from 'vue-mg-date-picker-standard'
Vue.component('DatePickerStandard', DatePickerStandard)

import MgPaginate from 'vue-mg-paginate'
Vue.component('MgPaginate', MgPaginate)

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// グローバルコンポーネント
Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('default-modal', require('./components/commons/DefaultModal.vue').default);
Vue.component('b-loading', require('./components/commons/BlueLoading.vue').default);
Vue.component('GroupCreate', require('./components/user/tabs/group/GroupCreate.vue').default);
Vue.component('image-uploder', require('./components/commons/ImageUploder.vue').default);
Vue.component('FileUp', require('./components/commons/FileUp').default);
Vue.component('Message', require('./components/chat/Message.vue').default);

Vue.component('BackButton', require('./components/commons/buttons/BackButton.vue').default);
Vue.component('HomeButton', require('./components/commons/buttons/HomeButton.vue').default);
Vue.component('SendButton', require('./components/commons/buttons/SendButton.vue').default);
Vue.component('GoChatButton', require('./components/commons/buttons/GoChatButton.vue').default);

Vue.component('IconLg', require('./components/commons/icons/IconLg.vue').default);
Vue.component('IconSm', require('./components/commons/icons/IconSm.vue').default);

Vue.component('Detail', require('./components/commons/boards/Detail.vue').default);
Vue.component('CommentList', require('./components/commons/boards/CommentList.vue').default);
Vue.component('MessageForm', require('./components/commons/boards/MessageForm.vue').default);
Vue.component('PageNation', require('./components/commons/boards/PageNation.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify: new Vuetify({
        iconfont: 'mdi',
        theme: {
            themes: {
              light: {
                primary: '#FFB74D',
                secondary: '#795548',
                tag: '#ba6365',
                accent: '#8c9eff',
                error: '#b71c1c',
              },
            },
          },
    }),
    data () {
      return {
        show1: false,
        show2: false,
        password: 'Password',
        rules: {
          required: value => !!value || '必須入力です',
          min: v => v.length >= 4 || '4文字以上の英数字で入力してください',
          passmin: v => v.length >= 8 || '8文字以上の英数字で入力してください',
        },
      }
    },
    watch: {
        '$route': function (route) {
            Echo.leave('chat')
            if (route.name == 'user') {
              this.$store.commit('userInit')
            }
        }
    }
});
