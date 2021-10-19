import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../ToDoAppViews/Home.vue'

Vue.use(VueRouter)

let routes = [
    {
        path: '/dashboard',
        name: 'dashboard.home',
        component: Home,
    }


]

const router = new VueRouter({
    mode: 'history',
    routes
})


export default  router
