import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router =  new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/users', component: () => import('./components/Users'),
            name: 'users'
        },
        {
            path: '/user/login', component: () => import('./components/Login'),
            name: 'user.login'
        },
        {
            path: '/user/registration', component: () => import('./components/Register'),
            name: 'user.register'
        },
        {
            path: '/user/image', component: () => import('./components/LoadImage'),
            name: 'user.image'
        }
    ]
})

router.beforeEach((to, from, next)=> {
    const token = localStorage.getItem('x_xsrf_token')
    if(!token){
        if(to.name === 'user.login' || to.name === 'user.register'){
            return next()
        }else{
            return next({
                name: 'user.login'
            })
        }
    }

    if((to.name === 'user.login' || to.name === 'user.registration') && token){
        return next ({
            name: 'users'
        })
    }

    next()
})

export default router
