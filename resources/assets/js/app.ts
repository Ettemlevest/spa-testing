
import './bootstrap';
import Vue from 'vue';
// import Vuetify from 'vuetify';
import OfficeUIFabricVue from 'office-ui-fabric-vue';

(<any>window).Vue = require('vue');

// Vue.use(Vuetify);
Vue.use(OfficeUIFabricVue);

const app = new Vue({
    el: '#app'
});
