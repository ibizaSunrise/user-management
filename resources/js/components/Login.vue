<template>
    <div class="container center_div p-5">
        <div class="form-outline mb-4">
            <label class="form-label">Email address</label>
            <input v-model="email" type="email" class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('email')" :errors="errors?.email || []"/>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example4">Password</label>
            <input v-model="password" type="password" id="form3Example4" class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('password')" :errors="errors?.password || []"/>
        </div>
        <button @click.prevent="login" type="submit" class="btn btn-primary btn-block mb-4">Log in</button>
    </div>

</template>

<script>
import ValidationError from "./errors/ValidationError";

export default {
    name: "Login",
    components: {
        ValidationError
    },
    data() {
        return {
            email: null,
            password: null,
            errors: []
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                }).then(r => {
                    if (r.hasOwnProperty('response')) {
                        this.errors = r.response.data.errors;

                        if (r.response.status !== 422) {
                            return;
                        }

                        return;
                    }
                    localStorage.setItem('x_xsrf_token', r.config.headers['X-XSRF-TOKEN'])
                    const url = new URL('/users', window.location.origin)
                    window.location.href = url.toString()
                    console.log('success', r.data);
                });
            });

        }
    }
}
</script>

<style scope>
.center_div {
    margin: 2rem auto;
    width: 30%; /* value of your choice which suits your alignment */
    -webkit-box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1);
    -moz-box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1);
    box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1);
}
</style>
