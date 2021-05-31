<template>
    <div class="item">
        <div class="video_thumb" style="text-align:center">
                <div  class="lazy skeleton item_img_background" style="width:90%;background-size:cover; background-color:rgb(242 241 241);" v-bind:style="{ 'background-image': 'url(' + img + ')' }">

                </div>
        </div>
        <div class="video_info">
            <div class="video_item_title">
                <h3>
                    <router-link :to="data.link">
                        {{data.title}}
                    </router-link>
                </h3>
            </div>
            <!--video_item_title-->
            <div class="item_meta"><a href="#">{{data.date | toDateIndo}}</a></div>
            <!--item_meta-->
        </div>
        <!--video_info-->
    </div>
</template>
<script>
export default {
    name: 'Media4',
    props: ['data'],
    computed: {
        img: function() {
            return this.data.img;
        }
    }
};

</script>
