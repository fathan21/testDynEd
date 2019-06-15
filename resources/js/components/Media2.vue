<template>
    <div class="media">
        <div class="media-left">
            <router-link :to="data.link">
                
                <div  class="skeleton" style="width:80px;height:80px;background-size:cover" v-bind:style="{ 'background-image': 'url(' + data.img + ')' }">

                </div>
            </router-link>
        </div>
        <!--media-left-->
        <div class="media-body">
            <h3 class="media-heading">
                <router-link :to="data.link">
                    {{data.title}}
                </router-link>
            </h3>
            <div class="comment_box">
                <div class="comments_icon"> <i class="fa fa-comments" aria-hidden="true"></i></div>
                <div class="comments">
                    <router-link :to="data.link">{{data.comment_count}} Comments</router-link>
                </div>
            </div>
        </div>
        <!--media-body-->
    </div>
    <!--media-->
</template>
<script>
export default {
    name: 'Media2',
    props: ['data'],
    created: function() {

    },
};

</script>
