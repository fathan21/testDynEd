import Vue from 'vue';
import Vuex from 'vuex';
// import auth from "./modules/auth";
import setting from "./modules/setting";
import homeStore from "./modules/home";

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		setting,
		homeStore
	}//,
	//strict: true
});
