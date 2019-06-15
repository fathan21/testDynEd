<template>
    <!-- Feature Category Section & sidebar -->
                            
    <section id="feature_category_section" class="feature_category_section category_page section_wrapper">

        <MediaSkolten v-if="loading"></MediaSkolten>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <Media4 v-if="filter.page==1 && main_news.id" :data="main_news"></Media4>
                            <!--feature_news_item-->
                        </div>
                        <!--col-md-6-->
                    </div>
                    <div class="row">
                        <div class="col-md-6" v-for="item in data">
                            <Media4 :data="item"></Media4>
                            <!--feature_news_item-->
                        </div>
                        <!--col-md-6-->
                    </div>
                    <!--row-->
                    <div class="row">
                        <div class="col-md-12" style="text-align:center">
                            <pagination v-model="filter.page" :records="countData" @paginate="pagenation" :per-page="filter.limit"></pagination>
                        </div>
                    </div>
                </div>
                <!--col-md-9-->
                <div class="col-md-3" v-if="!loading">
                  <Sidebar></Sidebar>
                </div>
            </div>
        </div>
    </section>
    <!--feature_category_section-->
</template>
<script>
import Sidebar from '../components/Sidebar';
import { api } from "../api";
import Media4 from '../components/Media4';
import Pagination from 'vue-pagination-2';
export default {
    name: "Category",
  	components: {
  		Sidebar,
        Media4,
        Pagination
  	},
    watch:{
        $route (to, from){
            this.filter.cat = this.$router.history.current.params.link;
            this.getData();
        }
    },
    created() {
        this.filter.cat = this.$router.history.current.params.link;
        this.getData();

    },
    data() {
        return {
            loading: true,
            filter:{
                page:1,
                limit: 6,
                q:'',
                cat:''
            },
            countData:0,
            data: [],
            main_news:{},
        }
    },
    mounted() {
    },
    methods: {
        getData() {
            this.loading=true;
            const parameter = {
                client_secret: api.clientSecret,
                filter:this.filter
            };
            window.axios.post(api.news, parameter)
                .then(res => {
                    this.loading=false;
                    let r = res.data;
                    let app = this;
                    this.data = r.data;
                    this.main_news=r.data[0];
                    this.countData = r.count;
                })
                .catch(err => {
                    this.loading=false;
                    // console.log(err);
                });
        },
        pagenation(evnt){
            jQuery('html, body').animate({scrollTop: 0}, 500);
            this.getData();
        }
    }
};

</script>
<style></style>
