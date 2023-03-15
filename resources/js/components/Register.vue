<template>
    <div class="container center_div p-5">

        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example5">Name</label>
            <input v-model="form.name" type="text" id="form3Example5" class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('name')" :errors="errors?.name || []"/>

        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Surname</label>
            <input v-model="form.surname" type="text"  class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('surname')" :errors="errors?.surname || []"/>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Email</label>
            <input v-model="form.email" type="email" class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('email')" :errors="errors?.email || []"/>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Password</label>
            <input v-model="form.password" type="password"  class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('password')" :errors="errors?.password || []"/>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label">Password Confirmation</label>
            <input v-model="form.password_confirmation" type="password"  class="form-control"/>
            <ValidationError :if="errors.hasOwnProperty('password_confirmation')" :errors="errors?.password_confirmation || []"/>
        </div>

        <button @click.prevent="register" type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

    </div>
</template>

<script>
import Form from "vform";
import ValidationError from "./errors/ValidationError";

export default {
    name: "Register",
    components: {
        ValidationError
    },
    data() {
        return {
            form: new Form({
                'name': null,
                'surname': null,
                'email': null,
                'password': null,
                'password_confirmation': null
            }),
            errors: []
        }
    },
    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/register', {...this.form})
                        .then(r => {
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
                        });

                })
        }

    }
}
</script>

<style scoped>
.center_div {
    margin: 2rem auto;
    width: 40%; /* value of your choice which suits your alignment */
    -webkit-box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1);
    -moz-box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1);
    box-shadow: 8px 8px 24px 0px rgba(66, 68, 90, 1);
}
</style>
