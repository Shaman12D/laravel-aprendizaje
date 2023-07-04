import {createRouter, createWebHistory}  from 'vue-router'

import List from "./components/List.vue"
import Save from "./components/Save.vue"
import Login from "./components/Auth/Login.vue"

// import { useCookies } from 'vue3-cookies'
// const {cookies} = useCookies()

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

// router.beforeEach(async (to, from, next) =>{
//     const auth = cookies.get('auth')

//     if (!auth && to.name != 'login') {
//         return next({name:'login'})
//     }

//     return next()

// })

export default router
