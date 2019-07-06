<template>
    <div class="media">
        
        <div class="media-left">
            <router-link :to="data.link">
                <img :alt="data.title" style="width:80px;" :src="data.img">
                
            </router-link>
        </div>
        <!--media-left-->
        <div class="media-body">
            <h4 class="media-heading">
                <router-link :to="data.link">
                            {{data.title}}
                        </router-link>
            </h4>
            <div class="media_meta"><a href="#">{{data.date | toDateIndo}},</a> by:<a href="#">{{data.writer}}</a></div>
            <div class="media_content">

                <div class="prev">
                    {{data.content_prev}}
                </div>
            </div>
            <!--media_content-->
        </div>
        <!--media-body-->
    </div>
    <!--media-->
</template>
<script>
export default {
    name: 'Media6',
    props: ['data'],
    created: function() {

    },
};

</script>
