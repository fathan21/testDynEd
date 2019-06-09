// import Vue from 'vue';
import router from './router';
import App from './views/App.vue';
import store from './store/index';
import { differenceInHours, format } from "date-fns";
import carousel from 'vue-owl-carousel';
 

require('./bootstrap');
window.Vue = require('vue');

window.Vue.filter('toDateIndo', function (value) {
	let dateLeft = new Date();
	let dateRight = new Date(value);
	let difH = differenceInHours(dateLeft, dateRight);
	if(difH > 24){
	    return `${format(value,'DD MMM YYYY')}`;
	}else{
	    return `${format(value,'HH:mm DD MMM YYYY')}`;
	}
});
window.Vue.component('carousel',carousel);

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    render: h => h(App)
});
