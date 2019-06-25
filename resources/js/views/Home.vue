<template>
    <div class="">
          <HomeCarousel></HomeCarousel>
        <MediaSkolten v-if="loading"></MediaSkolten>
        <HomeCategory v-if="!loading && !error" :category_home="getCategoryHome"></HomeCategory>
        <HomeGalery v-if="!loading && !error" :data="getGaleryHome"></HomeGalery>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import { api } from "../api";

import HomeCarousel from '../components/HomeCarousel';
import HomeCategory from '../components/HomeCategory';
import HomeGalery from '../components/HomeGalery';
export default {
    name: "Home",
    components: {
        HomeCarousel,
        HomeCategory,
        HomeGalery
    },
    data() {
        return {
            loading: false,
            error:false,
        }
    },
    mounted() {
      if(this.getCategoryHome.length <= 0){
        this.getCategoryH();
      }
    },
    computed: {
        // mix the getters into computed with object spread operator
        ...mapGetters([
            'getCategoryHome',
            'getGaleryHome',
            // ...
        ])
    },
    methods: {
        ...mapActions([
            'setCategoryHome', // map `this.increment()` to `this.$store.dispatch('increment')`
            'setGaleryHome'
        ]),
        getCategoryH() {
            this.loading = true;
            const parameter = {
                client_secret: api.clientSecret,
            };
            window.axios.post(api.category_home, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    this.setCategoryHome(r.data).then(function(e) {
                        // console.log(app.getCategoryHome);
                        app.loading = false;
                    });
                    if(this.getGaleryHome.length <= 0){
                        this.getGaleryyH();
                    }
                })
                .catch(err => {
                    this.loading = false;
                });
        },
        getGaleryyH() {
            // this.loading = true;
            const parameter = {
                client_secret: api.clientSecret,
            };
            window.axios.post(api.galery_home, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    this.setGaleryHome(r.data).then(function(e) {
                        // console.log(app.getGaleryHome);
                        app.loading = false;
                    });
                })
                .catch(err => {
                    this.loading = false;
                });
        },
    }

};

</script>
<style></style>
