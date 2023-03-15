<template>
    <div class="container">
        <nav class="navbar navbar-light bg-light mb-5">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="app-logo me-3 hv" href="/">User Management</a>
                    <router-link v-if="token" class="nav-link hv" :to="{name: 'users'}">Users</router-link>
                    <a target="_blank" class="nav-link m-lg-2 hv" href="/api/documentation">Swagger</a>

                </div>
                <div class="d-flex align-items-center">
                    <router-link v-if="!token" class="nav-link hv" :to="{name: 'user.login'}">Log in</router-link>
                    <router-link v-if="!token" class="btn btn-primary m-lg-2 bhv" :to="{name: 'user.register'}">Sign up
                    </router-link>
                    <a v-if="token" @click.prevent="logout" class="btn btn-primary m-lg-2 bhv" href="#">Logout</a>

                    <router-link v-if="token" class="nav-link d-flex align-items-center" :to="{name: 'user.image'}">
                        <img :src="src" class="rounded-circle my-img"
                             height="40"
                             width="40"
                             alt="Avatar"
                             loading="lazy"/>
                    </router-link>

                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>

</template>

<script>
export default {
    name: "Index",
    data() {
        return {
            token: null,
            src: 'https://mdbootstrap.com/img/new/avatars/2.jpg',
            authUser: null
        }
    },
    mounted() {
        this.getToken()
        this.getAuthUser()
    },
    updated() {
        this.getToken()
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token')
        },
        logout() {
            localStorage.removeItem('x_xsrf_token')
            axios.post('/logout').then(res => this.$router.push({name: 'user.login'}))
        },
        getAuthUser(){
            if(this.token){
                axios.get('/api/user/auth').then(res => {
                    this.authUser = res.data
                    if(res.data.path){
                        this.src = res.data.path
                    }

                })
            }
        },
    }
}
</script>

<style scoped>
.app-logo {
    color: #0d6efd;
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
}
.my-img{
    object-fit: cover;
}
.hv:hover{
    color: #0c63e4;
}
.bhv:hover{
    background-color: #0c63e4;
}
</style>
