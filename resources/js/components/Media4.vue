<template>
    <div class="item feature_news_item">
        <div class="item_wrapper">
            <div class="item_img_background 
            " v-bind:style="{ 'background-image': 'url(' + data.img + ')' }">

            </div>
            <!--item_img-->
            <div class="item_title_date">
                <div class="news_item_title">
                    <h2>
                        <router-link :to="data.link">
                            {{data.title}}
                        </router-link>

                    </h2>
                </div>
                <!--news_item_title-->
                <div class="item_meta"><a href="#">{{data.date | toDateIndo }},</a> <a href="#">{{data.writer}}</a></div>
            </div>
            <!--item_title_date-->
        </div>
        <!--item_wrapper-->
        <div class="item_content">
            <div class="prev">
                {{data.content_prev}}
            </div>
        </div>
        <!--item_content-->
    </div>
    <!--feature_news_item-->
</template>
<script>
export default {
    name: 'Media4',
    props: ['data'],
    created: function() {

    },
};

</script>
