import {createRouter, createWebHistory}  from 'vue-router'

import List from "./components/List.vue"
import Save from "./components/Save.vue"
import Login from "./components/Auth/Login.vue"

const routes=[
    {
        name:'list',
        path:'/vue',
        component: List
    },
    {
        name:'save',
        path:'/vue/save/:slug?',
        component: Save
    },
    {
        name:'login',
        path:'/vue/login',
        component: Login
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
