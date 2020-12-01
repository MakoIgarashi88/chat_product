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
Vue.component('GroupCreate', require('./components/commons/GroupCreate.vue').default);
Vue.component('image-uploder', require('./components/commons/ImageUploder.vue').default);
Vue.component('Detail', require('./components/commons/Detail.vue').default);
Vue.component('BackButton', require('./components/commons/buttons/BackButton.vue').default);
Vue.component('IconLg', require('./components/commons/icons/IconLg.vue').default);
Vue.component('IconSm', require('./components/commons/icons/IconSm.vue').default);
Vue.component('Detail', require('./components/commons/Detail.vue').default);
Vue.component('CommentList', require('./components/commons/CommentList.vue').default);
Vue.component('MessageForm', require('./components/commons/MessageForm.vue').default);
Vue.component('FileUp', require('./components/commons/uploads/FileUp').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        iconfont: 'mdi',
        theme: {
            themes: {
              light: {
                primary: '#FFB74D',
                secondary: '#795548',
                accent: '#8c9eff',
                error: '#b71c1c',
              },
            },
          },
    }),
    router,
    watch: {
        '$route': function () {
            Echo.leave('chat')
        }
    }
});
