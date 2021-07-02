import Vue from 'vue'
require('./bootstrap');
import VueRouter from 'vue-router'
import vuetify from './plugins/vuetify'
import Vuetify from 'vuetify'
import router from './router/index'

import Toaster from 'v-toaster'

// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'

// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})

Vue.use(Vuetify)
Vue.use(VueRouter)



// Vue.component('header-component', require('./components/HeaderComponent.vue').default);
// Vue.component('footer-component', require('./components/FooterComponent.vue').default);
// Vue.component('sidebar-component', require('./components/SidebarComponent.vue').default);
//

Vue.component('index-component', require('./Index.vue').default);


const app = new Vue({
    router,
    vuetify,
    el: '#app',
});
