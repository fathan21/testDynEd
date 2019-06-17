<template>
    <!-- Feature Category Section & sidebar -->
    <section id="feature_category_section" class="feature_category_section single-page section_wrapper">
        <MediaSkolten v-if="loading"></MediaSkolten>
        <div v-if="error && !loading" class="text-center">
            plesae try again, <br><a v-on:click="getData()" class="btn btn btn-danger btn-sm">try</a>
        </div>
        <div class="container" v-if="!loading && !error">
            <div class="row">
                <div class="col-md-9">
                    <div class="single_content_layout">

                        <div class="item feature_news_item"  style="postion:relative">
                            <div class="item_img" v-if="data.img && data.type_page !='galery' ">
                                <img class="img-responsive" :src="data.img" :alt="data.title">
                            </div>
                            <div class="galery-div">
                                <carousel v-if="data.imgs" id="feature_video_slider"  :items="1" :nav="true" :autoplay="false" :loop="false" :dots="false">

                                    <div class="item_img" v-for="item in data.imgs">
                                        <img class="img-responsive" :src="item.img" :alt="item.name">
                                    </div>  
                                    <template slot="prev"><span class="prev-galery"><i class="fa fa-arrow-circle-left"></i></span></template>
                                    <template slot="next"><span class="next-galery"><i class="fa fa-arrow-circle-right"></i></span></template>
                                </carousel>
                            </div>
                            <!--item_img-->
                            <div class="item_wrapper">
                                <div class="news_item_title">
                                    <h2><a href="#">{{data.title}}</a></h2>
                                </div>
                                <!--news_item_title-->
                                <div class="item_meta" v-if="data.date"><a href="#">{{data.date | toDateIndo }},</a> by:<a href="#">{{data.writer}}</a></div>
                                <!--
                                <span class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-full"></i>
                                </span>
                                -->
                                <!--
                                <div class="single_social_icon" >
                                    <a class="icons-sm fb-ic"  v-on:click="share('fb')"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                                    <a class="icons-sm tw-ic"  v-on:click="share('tw')"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                                </div>
                                -->
                                <social-sharing  v-if="data.meta"
                                      :url="data.meta.url"
                                      :title="data.meta.title"
                                      :description="data.meta.description"
                                      inline-template>
                                      <div class="single_social_icon">
                                          <network network="facebook"  >
                                              <a class="icons-sm fb-ic">
                                                  <i class="fa fa-facebook"></i><span>Facbook</span>
                                              </a>
                                          </network>
                                          <network network="twitter"  >
                                              <a class="icons-sm tw-ic">
                                                  <i class="fa fa-twitter"></i><span>Twitter</span>
                                              </a>
                                          </network>
                                          <network network="whatsapp"  >
                                              <a class="icons-sm whatsapp-ic">
                                                  <i class="fa fa-whatsapp"></i><span>Whatsapp</span>
                                              </a>
                                          </network>
                                          <network network="line"  >
                                              <a class="icons-sm line-ic">
                                                  <i class="fa fa-commenting-o"></i><span>Line</span>
                                              </a>
                                          </network>
                                          <network network="email"  >
                                              <a class="icons-sm li-ic">
                                                  <i class="fa fa-envelope"></i><span>Email</span>
                                              </a>
                                          </network>
                                      </div>
                                </social-sharing>
                                <!--social_icon1-->
                                <div class="item_content" v-html="data.content">

                                </div>

                                    <div v-for="item in data.content_slide">
                                        <h3>
                                            {{item.display_order}}.  {{item.title}}
                                        </h3>
                                        <div class="item_img" v-if="item.img">
                                            <img class="img-responsive" :src="item.img" :alt="item.title">
                                        </div>
                                        <div class="item_content" v-html="item.content">

                                        </div>
                                    </div>

                                <!--item_content-->
                                <div class="category_list"  v-if="data.key_word"> 
                                    <a href="#" v-for="item in (data.key_word).split(',')" >{{item}}</a>
                                </div>
                                <!--category_list-->
                            </div>
                            <!--item_wrapper-->
                        </div>


                        <!--feature_news_item-->
                        <div class="single_related_news" v-if="related.length > 0">
                            <div class="single_media_title">
                                <h2>Related News</h2>
                            </div>
                            <div class="media_wrapper">
                                <Media6 v-for="item in related" :data="item" v-bind:key="item.id"></Media6>
                            </div>
                            <!--media_wrapper-->
                        </div>
                        <!--single_related_news-->
                        <!--
                        <div class="ad">
                            <img class="img-responsive" src="assets/img/img-single-ad.jpg" alt="Chania">
                        </div>
                        -->
                        <!--
                        <Comment :data="comment"></Comment>
                        -->
                        <!--add_a_comment-->
                    </div>
                    <!--single_content_layout-->
                </div>
                <div class="col-md-3" v-if="!loading"> 
                	<Sidebar></Sidebar>
                </div>
            </div>
        </div>
    </section>
    <!--feature_category_section-->
</template>
<script>
import carousel from 'vue-owl-carousel';
var SocialSharing = require('vue-social-sharing');
import Sidebar from '../components/Sidebar';
import Comment from '../components/Comment';
import Media6 from '../components/Media6';
import { api } from "../api";
export default {
    name: "Page",
  	components: {
  		Sidebar,
        Comment,
        Media6,
        SocialSharing,
        carousel
  	},
    watch:{
        $route (to, from){
            this.filter.link = this.$router.history.current.params.link;
            this.getData();
        }
    },
    created() {
        this.filter.link = this.$router.history.current.params.link;
        this.getData();

    },
    data() {
        return {
            loading: false,
            error: false,
            filter:{
                link:''
            },
            data: {},
            comment: {},
            related:[]
        }
    },
    methods: {

        share(tp){
            alert(tp);
        },
        getData() {
            this.loading=true;
            const parameter = {
                client_secret: api.clientSecret,
                filter:this.filter
            };
            window.axios.post(api.news_detail+`/${this.filter.link}`,parameter)
                .then(res => {
                    this.loading=false;
                    this.error  = false;
                    let r = res.data;
                    let app = this;
                    this.data = r.data;
                    this.data.meta.url = window.location.href;
                    if(this.data.type_page!='page'){
                        this.getRelated();
                    }
                    this.meta.set(this.data.meta);
                })
                .catch(err => {
                    this.loading=false;
                    this.error  = true;
                    // console.log(err);
                });
        },
        getRelated() {
            const parameter = {
                client_secret: api.clientSecret,
                filter:this.filter
            };
            window.axios.post(api.news_detail_related+`/${this.filter.link}`, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    this.related = r.data;
                })
                .catch(err => {
                    // console.log(err);
                });
        },
        getComment() {
            const parameter = {
                client_secret: api.clientSecret,
                filter:this.filter
            };
            window.axios.post(api.news_detail_comment, parameter)
                .then(res => {
                    let r = res.data;
                    let app = this;
                    this.comment = r.data;
                })
                .catch(err => {
                    // console.log(err);
                });
        }
    },
};

</script>
<style></style>
