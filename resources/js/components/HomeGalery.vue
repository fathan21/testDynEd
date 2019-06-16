<template>
    <!-- Feature Video Item -->
    <section id="feature_video_item" class="feature_video_item section_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="feature_video_wrapper">
                        <div class="feature_video_title">
                            <h2>Galeri</h2>
                        </div>
                        <carousel v-if="data.length > 0" id="feature_video_slider" class="" :responsive="{0:{items:1,nav:false},600:{items:2,nav:false},600:{items:3,nav:false}}">
                            <Media5 v-for="item in data" :data="item" v-bind:key="item.id"></Media5>
                        </carousel>
                        <!--feature_video_slider-->
                    </div>
                    <!--col-xs-12-->
                </div>
                <!--row-->
            </div>
            <!--feature_video_wrapper-->
        </div>
        <!--container-->
    </section>
</template>
<script>

import carousel from 'vue-owl-carousel';
import Media5 from '../components/Media5';
import {mapGetters } from 'vuex';
export default {
    name: 'HomeGalery',
    components: {
        Media5,
        carousel
    },
    props: ['data'],
    created() {

    }
};
</script>