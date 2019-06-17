<template>
    <div>
        <div id="overlay" v-if="isOpen" v-on:click="openMenu($event)"></div>
        <!-- Header Section -->
        <header>
            <!-- /.container -->
            <nav class="navbar main-menu navbar-inverse navbar-static-top" role="navigation">
                <div class="container">
                    <router-link to="/" class="site-logo"> 
                        <img class="img-responsive" :src="getSetting.logo" alt="" />
                    </router-link>
                    <div id="navbar" class="collapse navbar-collapse sidebar-offcanvas " v-bind:class="{'active':isOpen}">
                        <ul class="nav navbar-nav">
                            <li class="hidden"><a href="#page-top"></a></li>
                            <li v-for="item in getSetting.menu"  
                                @mouseover="item.open = true"
                                @mouseleave="item.open = false"
                                v-bind:class="{'dropdown':(item.child).length > 0, 'open': item.open }"
                                >
                                <router-link class="page-scroll" :to="item.link">
                                  {{item.name}}
                                  {{item.hover}}
                                  <i v-on:click="openChild($event,item)" v-if="(item.child).length > 0" class="fa fa-angle-right child-nav-arrow"></i>
                                </router-link>
                                <ul class="dropdown-menu" v-if="(item.child).length > 0">
                                    <li v-for="child in item.child">
                                        <router-link class="page-scroll" :to="child.link">
                                          {{child.name}}
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <!--
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
                                <button class="btn btn-search" type="button" v-if="!searchOpen" v-on:click="openSearch($event)">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-search" type="button" v-if="searchOpen" v-on:click="openSearch($event)">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>

                                <button type="button" class="navbar-toggle btn-search" v-bind:class="{'collapsed':!isOpen}" v-on:click="openMenu($event)">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                        </div>
                    </div>
                    <div class="pull-right">
                            <button class="btn btn-search-mobile" type="button" v-if="!searchOpen" v-on:click="openSearch($event)">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                                <button class="btn btn-search-mobile" type="button" v-if="searchOpen" v-on:click="openSearch($event)">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            <button type="button" class="navbar-toggle btn-search" v-bind:class="{'collapsed':!isOpen}" v-on:click="openMenu($event)">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                    </div>
                    <div id="search" class="active" v-if="searchOpen">
                        <div class="search-content">
                            <form method="get" id="searchform" action="" v-on:submit="search">
                                <input class="form-control search-input" type="text" placeholder="Search.." name="s" id="s" value="" autocomplete="off" v-model="q">
                            </form>
                            <div class="search-suggest" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- .navbar -->
        </header>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
export default {
    name: 'Header',
    created() {

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
            searchOpen: false,
            data:{},
            q:''
        }
    },
    watch:{
        $route (to, from){
            this.isOpen = false;
        }
    },
    methods: {
        openMenu: function(event) {
            if (this.isOpen) {
                this.isOpen = false;
            } else {
                this.isOpen = true;
            }
        },
        openSearch: function(event) {
            if (this.searchOpen) {
                this.searchOpen = false;
            } else {
                this.searchOpen = true;
            }
        },
        search: function(event){
            event.preventDefault();
            if(this.q === ''){
                return false;
            }
            this.searchOpen = false;
            this.$router.push({name: 'search', query: { q: this.q } });
        },
        openChild: function(event,item){
            event.preventDefault();
            if(item.open){
                item.open = false;
            }else{
                item.open = true;
            }
        },

    },
    mounted() {
        
    }
};

</script>
