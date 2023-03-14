<template>
    <div class="container" v-if="users">
        <button type="button" @click.prevent="open('add')" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary mb-5">Add
            user
        </button>
        <table class="table" v-if="users">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.surname }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <button  @click.prevent="open('edit', user.id )" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                            class="btn btn-warning">Update
                    </button>
                    <button @click.prevent="deleteUser(user.id)" type="button" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <!--    modal-->
        <div  class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode">Create User</h5>
                        <h5 class="modal-title" v-show="editmode">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editmode ? updateUser() : createUser()" class="p-5">
                            <div class="form-outline mb-4">
                                <input v-model="form.name" type="text"  class="form-control"/>
                                <label class="form-label">Name</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="form.surname" type="text" class="form-control"/>
                                <label class="form-label">Surname</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="form.email" type="email"  class="form-control"/>
                                <label class="form-label" >Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input v-model="form.password" type="password"  class="form-control"/>
                                <label class="form-label">Password</label>
                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-show="!editmode" @click.prevent="createUser" type="button" class="btn btn-primary">Add user</button>
                        <button v-show="editmode"  @click.prevent="updateUser(form.id)" type="button" class="btn btn-primary">Update user</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
// import { Modal } from 'bootstrap'
export default {
    name: "Users",
    // comments:{
    //     Modal
    // },
    data() {
        return {
            users: [],
            errors: [],
            isShowModal: false,
            editmode: false,
            form: new Form({
                'id': null,
                'name': null,
                'surname': null,
                'email': null,
                'password': null,

            })
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            axios.get('/api/user')
                .then(({data}) => {
                    this.users = data.data

                })
        },
        // formHandler(){
        //     if(!this.editmode){
        //         this.createUser()
        //     }else{
        //         this.updateUser()
        //     }
        // },
        createUser() {
            axios.post('/api/user', {...this.form})
                .then(res => {
                    console.log(res)
                    // new Modal('#staticBackdrop', {}).hide()
                    this.getUsers()
                })
            .catch(e => {
                // if(e.status == 422){
                    console.log(e)
                    // this.errors = e.response.data.errors
                // }
            })
        },

        updateUser(id) {

            axios.put(`/api/user/${id}`, {...this.form})
                .then(res => {
                    this.getUsers()
                })
                .catch(e => {
                    // if(e.status == 422){
                    console.log(e)
                    // this.errors = e.response.data.errors
                    // }
                })

        },
        deleteUser(id) {
            axios.delete(`/api/user/${id}`)
                .then(res=>{
                    this.getUsers()
                })
        },

        open(mode, id=null){
            if(mode === 'add'){
                this.editmode = false
                console.log('add')

            }
            if(mode === 'edit'){
                this.editmode = true
                let user = [...this.users].find(el => el.id === id)
                this.form.fill(user)
            }

        }
    }
}
</script>

<style scoped>

</style>
