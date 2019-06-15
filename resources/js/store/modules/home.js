

/*
|--------------------------------------------------------------------------
| Initial State
|--------------------------------------------------------------------------
*/
const initialState = {
	category_home:[],
	galery_home:[],
	sidebar:{}
};

/*
|--------------------------------------------------------------------------
| Mutations
|--------------------------------------------------------------------------
*/
const mutations = {
	['SET_CATEGORY_HOME'](state, payload) {
		state.category_home = payload.category_home;
	},
	['SET_GALERY_HOME'](state, payload) {
		state.galery_home = payload.galery_home;
	},
	['SET_SIDEBAR'](state, payload) {
		state.sidebar = payload.sidebar;
	}
};

/*
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
*/
const actions = {
	setCategoryHome: (context, category_home) => {
		// console.log(app);
		context.commit('SET_CATEGORY_HOME', {category_home})
	},
	setGaleryHome: (context, galery_home) => {
		context.commit('SET_GALERY_HOME', {galery_home})
	},
	setSidebar: (context, sidebar) => {
		context.commit('SET_SIDEBAR', {sidebar})
	}
};

/*
|--------------------------------------------------------------------------
| Getters
|--------------------------------------------------------------------------
*/
const getters = {
	getCategoryHome: (state) => {
		return state.category_home;
	},
	getGaleryHome: (state) => {
		return state.galery_home;
	},
	getSidebar: (state) => {
		return state.sidebar;
	}
};

/*
|--------------------------------------------------------------------------
| Export the module
|--------------------------------------------------------------------------
*/
export default {
	state: initialState,
	mutations,
	actions,
	getters
}