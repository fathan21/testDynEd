import Vue from 'vue'
import Router from 'vue-router'

// Containers
const DefaultLayout = () => import(/* webpackChunkName: "assets/js/layout" */'../js/layout/DefaultLayout');
const Home = () => import(/* webpackChunkName: "assets/js/home" */'../js/views/Home');
const Page = () => import(/* webpackChunkName: "assets/js/page" */'../js/views/Page');
const Category = () => import(/* webpackChunkName: "assets/js/cat" */'../js/views/Category');
const Error = () => import(/* webpackChunkName: "assets/js/err" */'../js/views/Error');
//import DefaultLayout from './layout/DefaultLayout';
// import Home from './views/Home';

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  // linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      // redirect: '/home',
      name: '',
      component: DefaultLayout,
      children: [
        {
          path: '/',
          name: 'h',
          component: Home
        },
        {
          path: 'c/:link',
          name: 'category',
          component: Category
        },
        {
          path: 'p/:link',
          name: 'page',
          component: Page
        },
        {
          path: '**',
          name: 'error',
          component: Error
        },
      ]
    },
  ],

})
