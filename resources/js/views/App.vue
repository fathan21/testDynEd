<template>
    <div>
        <div class="loading-app" v-if="loading">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            
        </div>
        <router-view v-if="!loading"></router-view>
    </div>
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

    watch:{
        $route (to, from){
            var meta_data =  (this.getSetting.menu).filter(function(hero) {
                return hero.link == to.path;
            });
            if( (meta_data).length > 0 ){
                this.meta.set(meta_data[0].meta);
            }
        }
    },
    created() {
        this.get();
    },
    computed: {
	    // mix the getters into computed with object spread operator
	    ...mapGetters([
	      'getSetting',
          'getSidebar',
	      // ...
	    ])
  	},
    methods: {
    	...mapActions([
	      'setSetting', // map `this.increment()` to `this.$store.dispatch('increment')`
          'setSidebar'
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
                    this.getSideB();
                })
                .catch(err => {
                    // console.log(err);
                    this.loading = false;
                });
        },
        getSideB() {
            const parameter = {
                client_secret: api.clientSecret,
            };
            window.axios.post(api.sidebar, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    this.setSidebar(r.data).then(function (e) {
                        
                    });
                })
                .catch(err => {
                    // console.log(err);
                });
        },
    }
};

</script>
<style>
</style>
