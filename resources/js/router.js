import Vue from 'vue'
import Router from 'vue-router'

// Containers
const DefaultLayout = () => import(/* webpackChunkName: "assets/js/layout" */'../js/layout/DefaultLayout');
const Home = () => import(/* webpackChunkName: "assets/js/home" */'../js/views/Home');
const Page = () => import(/* webpackChunkName: "assets/js/page" */'../js/views/Page');
const Category = () => import(/* webpackChunkName: "assets/js/cat" */'../js/views/Category');
const Error = () => import(/* webpackChunkName: "assets/js/err" */'../js/views/Error');
const Search = () => import(/* webpackChunkName: "assets/js/err" */'../js/views/Search');
//import DefaultLayout from './layout/DefaultLayout';
// import Home from './views/Home';

Vue.use(Router);

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  // linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      // redirect: '/home',
      // base: '/laravel/portal/public/',
      name: '',
      component: DefaultLayout,
      children: [
        {
          path: '/',
          name: 'beranda',
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
          path: 'search',
          name: 'search',
          component: Search
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
