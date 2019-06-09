<template>
  <div id="main-wrapper">
    <Header>
    </Header>
      <router-view></router-view>
    <Footer>

    </Footer>
  </div>
<!--main-wrapper-->
</template>

<script>
import Header from '../components/Header';
import Footer from '../components/Footer';

export default {
  name: 'DefaultLayout',
  components: {
    Header,
    Footer
  },
  data () {
    return {
      //nav: nav.items
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched.filter((route) => route.name || route.meta.label )
    }
  }
}
</script>
