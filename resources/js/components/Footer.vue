<template>
    <!-- Footer Section -->
    <footer class="footer_section section_wrapper section_wrapper">
        <!--footer_top_section-->
        <a href="#" class="crunchify-top"><i class="fa fa-angle-up" ></i></a>
        <div class="copyright-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 copy-footer">
                        <router-link class="page-scroll" to="/p/tentang-kami">
                           Tentang Kami
                        </router-link>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <router-link class="page-scroll" to="/p/hubungi-kami">
                           Hubungi Kami
                        </router-link>
                    </div>
                    <!--col-xs-3-->
                    <div class="col-md-6">
                        <div class="copyright">
                            © 2015 - {{year}} jacatranet
                        </div>
                    </div>
                    <!--col-xs-6-->
                    <div class="col-md-3 copy-footer">
                        <div class="copyright">
                            <div class="social_icon1">
                                <a class="icons-sm fb-ic" target="_blank" :href="getSetting.facebook_link" v-if="getSetting.facebook_link!==''">
                                  <i class="fa fa-facebook"></i>
                                </a>
                                <!--Twitter-->
                                <a class="icons-sm tw-ic" target="_blank" :href="getSetting.twitter_link" v-if="getSetting.twitter_link!==''">
                                  <i class="fa fa-twitter"></i>
                                </a>
                                <!--Pinterest-->
                                <a class="icons-sm pin-ic" target="_blank" :href="getSetting.ig_link" v-if="getSetting.ig_link!==''"><i class="fa fa-instagram"> </i></a>
                            </div>
                            <!--social_icon1-->
                        </div>
                    </div>
                    <!--col-xs-3-->
                </div>
                <!--row-->
            </div>
            <!--container-->
        </div>
        <!--copyright-section-->
    </footer>
</template>
<script>

  import { mapActions, mapGetters } from 'vuex';
  export default {
    name: 'Footer',
    computed: {
        // mix the getters into computed with object spread operator
        ...mapGetters([
            'getSetting'
            // ...
        ])
    },
    data(){
        return{
            year: (new Date()).getFullYear() 
        }
    },
    created() {
    }
  };

</script>
