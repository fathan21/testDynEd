<template>
    <div >
        <div class="item feature_news_item" v-if="!isHeader">
            <div class="item_wrapper">
                <div class="item_img">

                    <router-link :to="data.link">
                        <img class="img-responsive" src="/assets/img/img-def-min.png " v-lazy="data.img" :alt="data.title" style="width:100%" v-if="!isHeader">
                    </router-link>
                </div>
                <!--item_img-->
                <div class="item_title_date">
                    <div class="news_item_title">
                        <h2>
                            <router-link :to="data.link">
                                {{data.title}}
                            </router-link>

                        </h2>
                    </div>
                    <!--news_item_title-->
                    <div class="item_meta"><a href="#">{{data.date | toDateIndo }},</a> 
                        <router-link class="page-scroll" :to="'/search?writer='+data.writer">{{data.writer}}</router-link>
                    </div>
                </div>
                <!--item_title_date-->
            </div>
            <!--item_wrapper-->
            <div class="item_content">
                <div class="prev">
                    {{data.content_prev}}
                </div>
            </div>
            <!--item_content-->
        </div>

        <div class="" v-if="isHeader">
            <!-- <div class="item_wrapper">
                <div class="item_img">
                    <router-link :to="data.link" style="color:#FFF">
                        <img class="img-responsive" :src="data.img" :alt="data.title" style="width:100%" >
                    </router-link>
                </div>
                <div class="item_title_date title-headline">
                    <div class="news_item_title" style="text-align:center;margin-bottom:20px;">
                            <router-link :to="data.link" style="color:#FFF">
                               <span style="font-size:2.6rem;font-weight:bold;"> {{data.title}}</span>
                            </router-link>
                    </div>
                </div>
            </div> -->
            <!--item_content-->

            <div class="item_wrapper">
                <div class="item_img">

                    <router-link :to="data.link">
                        <img class="img-responsive img"  v-lazy="getImgSrc()" :alt="data.title" style="width:100%"  src="/assets/img/img-def-min.png ">
                    </router-link>
                </div>
                <!--item_img-->
                <div class="item_title_date" style="padding:10px 20px 0px;">
                    <div class="news_item_title" >
                        <h2>
                            <router-link :to="data.link">
                                {{data.title}}
                            </router-link>

                        </h2>
                    </div>
                    <!--news_item_title-->
                    <div class="item_meta"><a href="#">{{data.date | toDateIndo }},</a> 
                        <router-link class="page-scroll" :to="'/search?writer='+data.writer">{{data.writer}}</router-link>
                    </div>
                </div>
                <!--item_title_date-->
            </div>
            <!--item_wrapper-->
        </div>
    </div>
    <!--feature_news_item-->
</template>
<script>
export default {
    name: 'Media4',
    props: ['data','isHeader'],
    created: function() {

    },
    methods: {
        getImgSrc(){
            var x = window.matchMedia("(max-width: 992px)").matches;
            console.log(x);
            if(x){
                return this.data.img_m;
            }else{
                return this.data.img;
            }
        }
    }
};

</script>
