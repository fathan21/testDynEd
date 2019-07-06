<template>
    <!-- Feature Category Section & sidebar -->
                            
    <section id="feature_category_section" class="feature_category_section category_page section_wrapper">

        <MediaSkolten v-if="loading"></MediaSkolten>
        <div v-if="error && !loading" class="text-center">
            plesae try again, <br><a v-on:click="getData()" class="btn btn btn-danger btn-sm">try</a>
        </div>
        <div class="container" v-if="!loading && !error">
            <div class="row">
                <div class="col-md-9" id="">
                    <div class="row">
                        <div class="col-md-12">
                            <div v-if="data.length <=0 && !main_news.title" class="text-center">
                                <h2>Data not available</h2>
                            </div>
                            <div class="category_layout category_layout_headline" v-if=" main_news.title">
                                <Media4 v-if=" main_news.title" :data="main_news" :isHeader="true"></Media4>
                            </div>
                            <!--feature_news_item-->
                        </div>
                        <!--col-md-6-->
                    </div>
                    <div class="row" id="countDT">
                        <div class="col-md-6" v-for="item in data">
                            <Media4 :data="item"></Media4>
                            <!--feature_news_item-->
                        </div>
                        <!--col-md-6-->
                    </div>
                    <!--row-->
                    <div style="text-align:center" v-if="load_more_loading">
                        Loading ....
                    </div>
                    <div class="row" id="loadmore">
                        <div class="col-md-12" style="text-align:center">
                            <pagination v-model="filter.page" :records="countData" @paginate="pagenation" :per-page="filter.limit"></pagination>
                        </div>
                    </div> -

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
            this.main_news = {};
            this.filter.page = 1;
            this.load_more = false;
            this.load_more_loading = false;
            this.filter.cat = this.$router.history.current.params.link;
            this.getData();
        }
    },
    destroyed() {
       // window.removeEventListener('scroll', this.handleScroll);
    },
    created() {
        //window.addEventListener('scroll', this.handleScroll);
        this.filter.cat = this.$router.history.current.params.link;
        this.getData();

    },
    data() {
        return {
            loading: false,
            error:false,
            load_more: false,
            load_more_loading: false,
            filter:{
                page:1,
                limit: 6,
                q:'',
                cat:'',
            },
            countData:0,
            data: [],
            main_news:{},
        }
    },
    mounted() {
        //this.handleScroll();
    },
    methods: {
        handleScroll: function () {
            window.onscroll = () => {

                var container = document.getElementById("countDT");
                //container.scrollTop = container.scrollHeight;
                if(!container){
                    return;
                }
              let bottomOfWindow = document.documentElement.scrollTop > container.offsetHeight; // document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
                //console.log(document.documentElement.scrollTop,'position');
                // console.log(window.innerHeight,'win eight');
                // console.log(container.offsetHeight,'eight');
              if (bottomOfWindow) {
                console.log('loadmore');
                this.loadMore(this.data);
              }
            };
        },
        loadMore(data) {
            this.filter.page = this.filter.page  +1;
            if(this.load_more){
                return;
            }

            //this.loading=true;
            const parameter = {
                client_secret: api.clientSecret,
                filter:this.filter,
                page_type:'cat',
            };
            this.load_more = true;
            this.load_more_loading = true;
            window.axios.post(api.news, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    let dl = r.data;

                    app.load_more_loading = false;
                    if(dl.length <= 0){
                        app.load_more = true;
                    }else{
                        app.load_more = false;
                    }
                    for (var i = 0; i < dl.length; i++) {
                        this.data.push(dl[i]);
                    }

                })
                .catch(err => {
                    app.load_more = false;
                    // console.log(err);
                });
        },
        getData() {
            this.loading=true;
            const parameter = {
                client_secret: api.clientSecret,
                filter:this.filter,
                page_type:'cat',
            };
            window.axios.post(api.news, parameter)
                .then(res => {
                    this.loading=false;
                    this.error = false;
                    let r = res.data;
                    let app = this;
                    this.data = r.data;
                    if(r.main.title){
                        this.main_news=r.main;   
                    }
                    this.countData = r.count;
                })
                .catch(err => {
                    this.loading=false;
                    this.error = true;
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
