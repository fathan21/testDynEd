

/*
|--------------------------------------------------------------------------
| Initial State
|--------------------------------------------------------------------------
*/
const initialState = {
	app:{d:'1'}
};

/*
|--------------------------------------------------------------------------
| Mutations
|--------------------------------------------------------------------------
*/
const mutations = {
	['SET_SETTING'](state, payload) {
		state.app = payload.app;
	},
	['UNSET_SETTING'](state, payload) {
		state.app = {};
	}
};

/*
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
*/
const actions = {
	setSetting: (context, app) => {
		// console.log(app);
		context.commit('SET_SETTING', {app})
	},
	unsetSetting: (context) => {
		context.commit('UNSET_SETTING');
	}
};

/*
|--------------------------------------------------------------------------
| Getters
|--------------------------------------------------------------------------
*/
const getters = {
	getSetting: (state) => {
		console.log('getter');
		return state.app;
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