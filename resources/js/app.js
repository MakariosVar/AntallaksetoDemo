/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import '../css/app.css';

import Ads from 'vue-google-adsense'
Vue.use(require('vue-script2'))
Vue.use(Ads.Adsense)


import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

window.Vue = require('vue').default;

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

        

const routes = [
        { path: '/home', component: require('./components/page/Home.vue').default},
        { path: '/info', component: require('./components/page/Info.vue').default},
        { path: '/contact', component: require('./components/page/Contact.vue').default},
        { path: '/terms', component: require('./components/page/Terms.vue').default},
        { path: '/login', component: require('./components/page/Auth/Login.vue').default},
        { path: '/register', component: require('./components/page/Auth/Register.vue').default},
        { path: '/p', component: require('./components/page/Posts/postIndex.vue').default},
        { path: '/p/create', component: require('./components/page/Posts/postCreate.vue').default},
        { path: '/p/:id/imageEdit', component: require('./components/page/Posts/postImagesEdit.vue').default},
        { path: '/p/:id/edit', component: require('./components/page/Posts/postEdit.vue').default},
        { path: '/p/:id', component: require('./components/page/Posts/postShow.vue').default},
        { path: '/profile/:id', component: require('./components/page/profile/Profile.vue').default},
        { path: '/EditProfile/:id', component: require('./components/page/profile/EditProfile.vue').default},
        { path: '/myposts/:id', component: require('./components/page/Posts/MyPost.vue').default},
        { path: '/verificateposts', component: require('./components/page/Verification.vue').default},
        { path: '/messages', component: require('./components/page/Messages.vue').default},
        { path: '/:pathMatch(.*)*', name: 'NotFound', component: require('./components/page/redirect.vue').default },
] 

const router = new VueRouter({
        routes: routes,
        mode: "history"
})




 /**
 
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
                       
 
 
                        /* ADS COMPONENT */
Vue.component('ads', require('./components/ADS.vue').default);                     
 
        /* MAIN COMPONENT */
 Vue.component('app', require('./app.vue').default);

        /* LAYOUT COMPONENTS */
 Vue.component('HeaderVue', require('./components/layout/HeaderVue.vue').default);
 Vue.component('FooterVue', require('./components/layout/FooterVue.vue').default);
  Vue.component('scrollup', require('./components/layout/ScrollUp.vue').default);
 Vue.component('PreLoader', require('./components/layout/PreLoader.vue').default);
         /* PAGE COMPONENTS */

 Vue.component('Login', require('./components/page/Auth/Login.vue').default);

         /* PROFILE COMPONENTs */
 Vue.component('follow-button', require('./components/page/profile/FollowButton.vue').default);
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     router
 }).$mount('#app');
 