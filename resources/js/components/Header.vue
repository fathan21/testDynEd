<template>
    <!-- Header Section -->
    <header>
        <div class="container">
            <!--top_ber-->
            <div class="header-section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <router-link to="/">
                                <img class="img-responsive" :src="getSetting.logo" alt="" />
                            </router-link>
                        </div>
                        <!--logo-->
                    </div>
                    <!--col-md-3-->
                    <div class="col-md-6">

                    </div>
                    <!--col-md-6-->
                    <div class="col-md-3">
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
                    <!--col-md-3-->
                </div>
                <!--row-->
            </div>
            <!--header-section-->
        </div>
        <!-- /.container -->
        <nav class="navbar main-menu navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle  pull-left" data-toggle="offcanvas" v-bind:class="{'collapsed':!isOpen}" v-on:click="openMenu($event)">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="collapse navbar-collapse sidebar-offcanvas " v-bind:class="{'active':isOpen}">
                    <ul class="nav navbar-nav">
                        <li class="hidden"><a href="#page-top"></a></li>
                        <li v-for="item in getSetting.menu">
                            <router-link class="page-scroll" :to="item.link">
                              {{item.name}}
                            </router-link>
                        </li>
                        <!--
                        <li>
                            <a class="page-scroll" href="category.html">Track & Field</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                            </ul>
                        </li>
                        -->
                    </ul>
                    <div class="pull-right">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input class="form-control" placeholder="Search" name="q" type="text" />
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- .navbar -->
    </header>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
export default {
    name: 'Header',
    created() {
      console.log('sadsa');
    },
    computed: {
        // mix the getters into computed with object spread operator
        ...mapGetters([
            'getSetting'
            // ...
        ])
    },
    data: () => {
        return {
            isOpen: false,
            data:{}
        }
    },
    methods: {
        openMenu: function(event) {
            if (this.isOpen) {
                this.isOpen = false;
            } else {
                this.isOpen = true;
            }
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};

</script>
