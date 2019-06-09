<template>
    <router-view v-if="!loading"></router-view>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import { api } from "../api";
export default {
    name: "App",
    data() {
        return {
            loading: true,
            data: {}
        }
    },
    mounted() {
        this.get();
    },
    computed: {
	    // mix the getters into computed with object spread operator
	    ...mapGetters([
	      'getSetting',
	      // ...
	    ])
  	},
    methods: {
    	...mapActions([
	      'setSetting', // map `this.increment()` to `this.$store.dispatch('increment')`
	    ]),
        get() {
            this.loading = true;
            const parameter = {
                client_secret: api.clientSecret,
            };
            window.axios.post(api.setting, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    this.setSetting(r.data).then(function (e) {
			        	// console.log(app.getSetting.email);
                    	app.loading = false;
                    });
                })
                .catch(err => {
                    // console.log(err);
                    this.loading = false;
                });
        },
    }
};

</script>
<style>
</style>
