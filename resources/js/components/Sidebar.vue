<template>
  <div>
    <div class="tab sitebar">
        <ul class="nav nav-tabs">
            <li class="active"><a >Latest</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active">
                <Media1 v-for="item in getSidebar.latest" :data="item" v-bind:key="item.id"></Media1>
            </div>
            <!--tab-pane-->
        </div>
        <!--tab-content-->
    </div>
    <!--tab-->
    
    <div class="tab sitebar">
        <ul class="nav nav-tabs">
            <li class="active"><a >Populer</a></li>
        </ul>
        <div class="tab-content">
            <!--tab-pane-->
            <div class="tab-pane active">
              <Media1 v-for="item in getSidebar.populer" :data="item" v-bind:key="item.id"></Media1>
            </div>
            <!--tab-pane-->
        </div>
        <!--tab-content-->
    </div>
    <!--tab-->

    <div class="ad">
        <div class="adswrapper"> 

        </div>
    </div>

    
    <div class="ad">
    </div>
  </div>
</template>
<script>

import { mapActions, mapGetters } from 'vuex';
import Media1 from '../components/Media1';
import Media2 from '../components/Media2';
export default {
    name: 'Sidebar',
    components:{
      Media1,
      Media2
    },
    mounted () {
        //this.loadAdsen();
    },
    computed: {
        // mix the getters into computed with object spread operator
        ...mapGetters([
          'getSidebar',
          // ...
        ])
    },
    data: () => {
      return {
        tab_v: '#1',
        /*
        latest:[
          {
            id:'1',
            link:'/p/link',
            date:'2019-05-01 19:00:00',
            title:'Spain going to made class football',
            img:'assets/img/img-list.jpg',
            content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
            rating:5,
            comment_count:5,
          }
        ],
        populer:[
          {
            id:'1',
            link:'/p/link',
            date:'2019-05-01 19:00:00',
            title:'Spain going to made class football P',
            img:'assets/img/img-list.jpg',
            content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
            rating:5,
            comment_count:5,
          }
        ],
        most_comment:[
          {
            id:'1',
            link:'/p/link',
            date:'2019-05-01 19:00:00',
            title:'Spain going to made class football P',
            img:'assets/img/img-list.jpg',
            content_prev: 'Sed perspiciatis unde omnis iste natus voluptatem.',
            rating:5,
            comment_count:5,
          }
        ]
        */
      }
    },
    methods: {
      tab: function (param,event) {
        this.tab_v = param;
      },
      loadAdsen(){
        let adsbygoogle=(adsbygoogle = window.adsbygoogle || []);
        document.querySelectorAll('.adsbygoogle').forEach(function(ad) {
            console.log(ad);
            adsbygoogle.push(ad);
        });
      }
    }
};

</script>
