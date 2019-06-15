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
