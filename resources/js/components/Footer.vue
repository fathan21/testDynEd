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
                    </div>
                    <!--col-xs-3-->
                    <div class="col-md-6">
                        <div class="copyright">
                            © 2015 - {{year}} jacatranet
                        </div>
                    </div>
                    <!--col-xs-6-->
                    <div class="col-md-3 copy-footer">

                        
                        <router-link class="page-scroll" to="/p/hubungi-kami">
                           Hubungi Kami
                        </router-link>
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
  export default {
    name: 'Footer',
    data(){
        return{
            year: (new Date()).getFullYear() 
        }
    },
    created() {
    }
  };

</script>
