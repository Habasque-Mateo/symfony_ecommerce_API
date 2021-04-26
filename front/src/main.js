import { createApp } from 'vue'
//import Vue from 'vue'
import App from '@/App.vue'
//import VueRouter from 'vue-router'
import router from '@/router.js'

//createApp(App).mount('#app')

//Vue.config.productionTip = false

//Vue.use(VueRouter);

console.log("BEFORE ");

let app = createApp(App);

//app.mount('#app');

app.use(router).mount('#app');
//app.use(VueRouter);

console.log("AFTER  ");

