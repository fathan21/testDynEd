<template>
  <div>
    <div class="tab sitebar">
        <ul class="nav nav-tabs">
            <li v-bind:class="{'active':(tab_v === '#1')}"><a v-on:click="tab('#1', $event)">Latest</a></li>
            <li v-bind:class="{'active':(tab_v === '#2')}"><a v-on:click="tab('#2', $event)" >Populer</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" v-bind:class="{'active':(tab_v === '#1')}" id="1">
                <Media1 v-for="item in latest" :data="item" v-bind:key="item.id"></Media1>
            </div>
            <!--tab-pane-->
            <div class="tab-pane" id="2" v-bind:class="{'active':(tab_v === '#2')}">
              <Media1 v-for="item in populer" :data="item" v-bind:key="item.id"></Media1>
            </div>
            <!--tab-pane-->
        </div>
        <!--tab-content-->
    </div>
    <!--tab-->
    <!--
    <div class="ad">
        <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
        <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
        <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
        <img class="img-responsive" src="assets/img/img-sitebar.jpg" alt="img" />
    </div>
    <!--ad-->
    <!--
    <div class="ad">
        <img class="img-responsive" src="assets/img/img-ad.jpg" alt="img" />
    </div>
    <div class="ad">
        <img class="img-responsive" src="assets/img/img-ad2.jpg" alt="img" />
    </div>
    -->
    <div class="most_comment">
        <div class="sidebar_title">
            <h2>Most Commented</h2>
        </div>
        <Media2 v-for="item in most_comment" :data="item" v-bind:key="item.id"></Media2>
    </div>
    <!--most_comment-->
  </div>
</template>
<script>
import Media1 from '../components/Media1';
import Media2 from '../components/Media2';
export default {
    name: 'Sidebar',
    components:{
      Media1,
      Media2
    },
    data: () => {
      return {
        tab_v: '#1',
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
      }
    },
    methods: {
      tab: function (param,event) {
        this.tab_v = param;
      }
    }
};

</script>
