<template>
    <div class="media">
        <div class="media-left">
            <router-link :to="data.link">
                <img :alt="data.title" style="width:80px" v-lazy="data.img" src="/assets/img/img-def-min.png ">
            </router-link>
        </div>
        <!--media-left-->
        <div class="media-body">
            <h3 class="media-heading">
                <router-link :to="data.link">
                    {{data.title}}
                </router-link>
            </h3>
            <p>{{data.content_prev}}</p>
        </div>
        <!--media-body-->
    </div>
    <!--media-->
</template>
<script>
export default {
    name: 'Media3',
    props: ['data'],
    created: function() {

    },
};

</script>
