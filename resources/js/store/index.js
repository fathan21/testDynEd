import Vue from 'vue';
import Vuex from 'vuex';
// import auth from "./modules/auth";
import setting from "./modules/setting";
import homeStore from "./modules/home";
// import sidebar from "./modules/sidebar";

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		setting,
		homeStore,
		//sidebar
	}//,
	//strict: true
});
