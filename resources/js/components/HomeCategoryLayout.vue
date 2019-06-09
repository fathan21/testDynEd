<template>
    <div class="category_layout">
        <div class="item_caregory " :class="data.class">
            <h2>
                <router-link :to="data.link">
                    {{data.name}}
                </router-link>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-7">
                <Media4 :data="data.news_header" ></Media4>
            </div>
            <!--col-md-7-->
            <div class="col-md-5">
                <div class="media_wrapper">
                    <Media3 v-for="item in data.news" :data="item" v-bind:key="item.id"></Media3>
                </div>
                <!--media_wrapper-->
            </div>
            <!--col-md-5-->
        </div>
        <!--row-->
    </div>
    <!--category_layout-->
</template>
<script>

import Media3 from '../components/Media3';
import Media4 from '../components/Media4';
export default {
    name: 'HomeCategoryLayout',
    components: {
        Media3,
        Media4,

    },
    props: ['data'],
    mounted() {

    }
};

</script>
