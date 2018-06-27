
import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';

(<any>window).Vue = require('vue');

Vue.use(Vuetify);

const app = new Vue({
    el: '#app'
});
