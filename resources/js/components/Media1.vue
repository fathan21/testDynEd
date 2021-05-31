<template>
  <div class="media">
    <router-link :to="data.link">
      <div class="media-left">
        <router-link :to="data.link">
          <img
            :alt="data.title"
            style="width: 80px"
            src="/assets/img/img-def-min.png"
            v-lazy="data.img"
          />
        </router-link>
      </div>
      <!--media-left-->
      <div class="media-body">
        <h3 class="media-heading">
          {{ data.title }}
        </h3>
      </div>
    </router-link>
    <!--media-body-->
  </div>
  <!--media-->
</template>
<script>
export default {
  name: "Media1",
  props: ["data"],
  created: function () {},
};
</script>
