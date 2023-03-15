<template>
    <div class="container center_div">

        <div class="form-outline mb-4">
            <input v-model="name" type="text" id="form3Example5" class="form-control"/>
            <label class="form-label" for="form3Example5">Name</label>
        </div>

        <div class="form-outline mb-4">
            <input v-model="surname" type="text" id="form3Example6" class="form-control"/>
            <label class="form-label" for="form3Example6">Surname</label>
        </div>

        <div class="form-outline mb-4">
            <input v-model="email" type="email" id="form3Example7" class="form-control"/>
            <label class="form-label" for="form3Example7">Email</label>
        </div>

        <div class="form-outline mb-4">
            <input v-model="password" type="password" id="form3Example8" class="form-control"/>
            <label class="form-label" for="form3Example8">Password</label>
        </div>

        <div class="form-outline mb-4">
            <input v-model="password_confirmation" type="password" id="form3Example9" class="form-control"/>
            <label class="form-label" for="form3Example9">Password</label>
        </div>

        <button @click.prevent="register" type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            'name': null,
            'surname': null,
            'email': null,
            'password': null,
            'password_confirmation': null
        }
    },
    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/register', {
                        name: this.name,
                        surname: this.surname,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    }).then(res => {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                        const url = new URL('/users', window.location.origin)
                        window.location.href = url.toString()
                    }).catch(er => {
                        console.log(er)
                    })

                })
        }

    }
}
</script>

<style scoped>

</style>
