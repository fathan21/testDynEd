<template>
    <!-- Feature Category Section & sidebar -->
    <section id="feature_category_section" class="feature_category_section section_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" style="margin-bottom:20px">
                        <div class="col-md-12">
                            <div class="category_layout category_layout_headline" >

                                    <carousel v-if="headline.length > 0" id="feature_video_slider" class="" :responsive="{0:{items:1,nav:false}}" :autoplay="true">
                                        <div v-for="item in headline"  v-bind:key="item.id">                            
                                          <Media4 :data="item" :isHeader="true"></Media4>
                                        </div><!-- 
                                        <template slot="prev"><span class="prev-galery"><i class="fa fa-arrow-circle-left"></i></span></template>
                                        <template slot="next"><span class="next-galery"><i class="fa fa-arrow-circle-right"></i></span></template> -->
                                    </carousel>
                                    <!--carousel-inner-->
                                <!--carousel-->
                            </div>
                            <!--feature_news_carousel-->
                        </div>
                    </div>
                    <HomeCategoryLayout v-for="item in category_home" v-if="item.news.length > 0" :data="item" v-bind:key="item.id"></HomeCategoryLayout>
                    <!--
                    <div id="more_news_item" class="more_news_item">
                        <div class="more_news_heading">
                            <h2><a href="#">More News</a></h2>
                        </div>
                        <div class="row">
                            <div class="col-md-4" v-for="item in more_news" >
                              <Media4 :data="item"></Media4>
                            </div>
                        </div>
                    </div>
                    -->
                    <!--more_news_item-->
                </div>
                <!--col-md-9-->
                <div class="col-md-3">
                    <Sidebar></Sidebar>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Sidebar from '../components/Sidebar';
import Media4 from '../components/Media4';
import HomeCategoryLayout from '../components/HomeCategoryLayout';
import carousel from 'vue-owl-carousel';
export default {
    name: 'HomeCategory',
    components: {
        Sidebar,
        HomeCategoryLayout,
        Media4,
        carousel
    },
    created: function() {
        // console.log(this.category_home);
    },
    props: ['category_home', 'headline'],
    data: () => {
        return {
            /*
            category_home: [
              {
                id:'1',
                name:'Jakarta',
                link:'/c/jakarta',
                class:'red',
                news_header:{
                    id:'1',
                    link:'/p/link',
                    date:'2019-05-01 19:00:00',
                    title:'Spain going to made class football',
                    img:'assets/img/img_feature_news.jpg',
                    content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
                    rating:5,
                    comment_count:5,
                    writer:"indi",

                },
                news:[
                  {
                      id:'1',
                      link:'/p/link',
                      date:'2019-05-01 19:00:00',
                      title:'Spain going to made class football',
                      img:'assets/img/img-list.jpg',
                      content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
                      rating:5,
                      comment_count:5,
                      writer:"indi",
                  },
                  {
                      id:'2',
                      link:'/p/link',
                      date:'2019-05-01 19:00:00',
                      title:'Spain going to made class football',
                      img:'assets/img/img-list.jpg',
                      content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
                      rating:5,
                      comment_count:5,
                      writer:"indi",
                  },
                ]
              }
            ],
            */
            more_news: [{
                    id: '1',
                    link: '/p/link',
                    date: '2019-05-01 19:00:00',
                    title: 'Spain going to made class football',
                    img: 'assets/img/img_feature_news.jpg',
                    content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem. Sed perspiciatis unde omnis iste natus voluptatem. Sed perspiciatis unde omnis iste natus voluptatem.',
                    rating: 5,
                    comment_count: 5,
                    writer: "indi",
                },
                {
                    id: '2',
                    link: '/p/link',
                    date: '2019-05-01 19:00:00',
                    title: 'Spain going to made class football',
                    img: 'assets/img/img_feature_news.jpg',
                    content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
                    rating: 5,
                    comment_count: 5,
                    writer: "indi",
                },
            ]
        }
    },
    mounted() {

    }
};

</script>
