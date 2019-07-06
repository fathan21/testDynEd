// import Vue from 'vue';
import router from './router';
import App from './views/App.vue';
import store from './store/index';
// import { differenceInHours, format } from "date-fns";

import * as format from 'date-fns/format/index';
import * as differenceInHours from 'date-fns/difference_in_hours/index';
import VueAnalytics from 'vue-analytics';
//import carousel from 'vue-owl-carousel';
import meta from './helpers/meta';
import VueLazyload from 'vue-lazyload';

//import Adsense from 'vue-google-adsense/dist/Adsense.min.js'
//import InArticleAdsense from 'vue-google-adsense/dist/InArticleAdsense.min.js'
//import InFeedAdsense from 'vue-google-adsense/dist/InFeedAdsense.min.js'
 
//import MediaSkolten from './components/MediaSkolten';

const MediaSkolten = () => import(/* webpackChunkName: "MediaSkolten" */'./components/MediaSkolten');
//const carousel = () => import(/* webpackChunkName: "carousel" */'vue-owl-carousel');

require('./bootstrap');
window.Vue = require('vue');
Vue.use(VueLazyload, {
  preLoad: 5,
  error: '/assets/img/img-def-min.png',
  loading: '/assets/img/img-def-min.png',
  attempt: 1
});
//window.Vue.use(require('vue-script2'));
//window.Vue.use(Adsense)
//window.Vue.use(InArticleAdsense)
//window.Vue.use(InFeedAdsense)

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
//window.Vue.component('carousel',carousel);
window.Vue.component('MediaSkolten',MediaSkolten);
window.Vue.prototype.meta = meta;
window.Vue.use(meta);
Vue.use(VueAnalytics, {
  id: 'UA-75874693-1',
  router
})

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    render: h => h(App)
});
