<template>
    <div class="container center_div">

        <!-- Email input -->
        <div class="form-outline mb-4">
            <input v-model="email" type="email" id="form3Example3" class="form-control"/>
            <label class="form-label" for="form3Example3">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input v-model="password" type="password" id="form3Example4" class="form-control"/>
            <label class="form-label" for="form3Example4">Password</label>
        </div>

        <!-- Submit button -->
        <button @click.prevent="login" type="submit" class="btn btn-primary btn-block mb-4">Log in</button>
    </div>

</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: null,
            password: null
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                    .then((r => {
                        localStorage.setItem('x_xsrf_token', r.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'users'})
                    }))
                    .catch(err => {
                        console.log(err)
                    })

            });

        }
    }
}
</script>

<style>
.center_div {
    margin: 2rem auto;
    width: 40% /* value of your choice which suits your alignment */
}
</style>
