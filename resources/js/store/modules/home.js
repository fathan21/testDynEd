

/*
|--------------------------------------------------------------------------
| Initial State
|--------------------------------------------------------------------------
*/
const initialState = {
	category_home:[],
	galery_home:[]
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
		console.log()
		return state.galery_home;
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