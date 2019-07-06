<template>
    <div class="media">
        <div class="media-left">
            <router-link :to="data.link">
                <img :alt="data.title" style="width:80px" src="/assets/img/img-def-min.png" v-lazy="data.img">
            </router-link>
        </div>
        <!--media-left-->
        <div class="media-body">
            <h3 class="media-heading">
                <router-link :to="data.link">
                    {{data.title}}
                </router-link>
            </h3>
            <!--
            <span class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-full"></i>
            </span>
            -->
        </div>
        <!--media-body-->
    </div>
    <!--media-->
</template>
<script>
export default {
    name: 'Media1',
    props: ['data'],
    created: function () {

    },
};

</script>
