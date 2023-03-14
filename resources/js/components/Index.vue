<template>
    <div class="container">
        <nav class="navbar navbar-light bg-light mb-5">
            <div class="container-fluid">
                <div class="app-logo">User Management</div>
                <div class="d-flex align-items-center">
                    <router-link v-if="!token" class="nav-link" :to="{name: 'user.login'}">Log in</router-link>
                    <router-link v-if="!token" class="nav-link m-lg-2" :to="{name: 'user.register'}">Sign up
                    </router-link>
                    <a v-if="token" @click.prevent="logout" class="btn btn-primary m-lg-2 btn btn-primary" href="#">Logout</a>

                    <router-link v-if="token" class="nav-link d-flex align-items-center" :to="{name: 'user.image'}">
                        <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" class="rounded-circle" height="40"
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
            token: null
        }
    },
    mounted() {
        this.getToken()
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
        }
    }
}
</script>

<style scoped>
.app-logo {
    color: #0d6efd;
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
}
</style>
