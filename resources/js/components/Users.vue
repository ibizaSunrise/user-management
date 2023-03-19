<template>
    <div class="container">
        <DataTable :value="users"
                   :paginator="true"
                   class="p-datatable-sm"
                   :rows="10"
                   responsiveLayout="scroll"
                   paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                   :rowsPerPageOptions="[10,20]"
                   currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
                   scrollHeight="530px">
            <template #header>
                <button type="button" @click.prevent="open('add')" class="btn btn-success ms-2">Add</button>
            </template>
            <Column field="id" header="ID" sortable></Column>
            <Column field="name" header="Name"></Column>
            <Column field="surname" header="Surname"></Column>
            <Column field="email" header="Email"></Column>
            <Column field="options" header="Options">
                <template #body="{data}">
                    <Button icon="pi pi-pencil" class="p-button-rounded p-button-warning"
                            @click.prevent="open('edit', data.id )"/>
                    <Button icon="pi pi-trash" class="p-button-rounded p-button-danger"
                            @click.prevent="deleteUser($event, data.id)"/>
                </template>

            </Column>
        </DataTable>
        <Dialog header="Header"
                :modal="true"
                :closable="false"
                :visible.sync="display"
                :contentStyle="{
                    width: '30vw',
                    minHeight: '300px',
                 }">
            <template #header>
                <h5 class="modal-title" v-show="!editmode">Create User</h5>
                <h5 class="modal-title" v-show="editmode">Edit User</h5>
            </template>

            <form @submit.prevent="editmode ? updateUser() : createUser()" class="">
                <div class="form-outline mb-4">
                    <label class="form-label">Name</label>
                    <input v-model="form.name" type="text" class="form-control"/>
                    <ValidationError :if="errors.hasOwnProperty('name')" :errors="errors?.name || []"/>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label">Surname</label>
                    <input v-model="form.surname" type="text" class="form-control"/>
                    <ValidationError :if="errors.hasOwnProperty('surname')" :errors="errors?.surname || []"/>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label">Email</label>
                    <input v-model="form.email" type="email" class="form-control"/>
                    <ValidationError :if="errors.hasOwnProperty('email')" :errors="errors?.email || []"/>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label">Password</label>
                    <input v-model="form.password" type="password" class="form-control"/>
                    <ValidationError :if="errors.hasOwnProperty('password')" :errors="errors?.password || []"/>
                </div>

            </form>

            <template #footer>
                <button type="button" class="btn btn-secondary" @click.prevent="close">Close</button>
                <button v-show="!editmode" @click.prevent="createUser" type="button" class="btn btn-primary">
                    Add user
                </button>
                <button v-show="editmode" @click.prevent="updateUser(form.id)" type="button" class="btn btn-primary">
                    Update user
                </button>
            </template>
        </Dialog>
        <ConfirmPopup></ConfirmPopup>

    </div>

</template>

<script>
import Form from 'vform'
import ValidationError from "./errors/ValidationError";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button'
import ConfirmPopup from 'primevue/confirmpopup';


export default {
    name: "Users",
    components: {
        DataTable,
        Column,
        ColumnGroup,
        ValidationError,
        Dialog,
        ConfirmPopup,
        Button
    },

    data() {
        return {
            display: false,
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
                .then(({data}) => this.users = data.data.users);
        },
        createUser() {
            axios.post('/api/user', {...this.form})
                .then(r => {
                    if (r.hasOwnProperty('response')) {
                        this.errors = r.response.data.errors;

                        if (r.response.status !== 422) {
                            return;
                        }

                        return;
                    }
                    this.display = false
                    this.errors = []
                    this.getUsers()
                });
        },

        updateUser(id) {
            axios.put(`/api/user/${id}`, {...this.form})
                .then(r => {
                    if (r.hasOwnProperty('response')) {
                        this.errors = r.response.data.errors;

                        if (r.response.status !== 422) {
                            return;
                        }

                        return;
                    }
                    this.display = false
                    this.errors = []
                    this.getUsers()
                });

        },
        deleteUser(event, id) {

            this.$confirm.require({
                target: event.currentTarget,
                message: 'Do you want to delete this record?',
                icon: 'pi pi-info-circle',
                acceptClass: 'p-button-danger',
                accept: () => {
                    axios.delete(`/api/user/${id}`)
                        .then(res => {
                            this.getUsers()
                        })
                },
                reject: () => {
                    this.$confirm.close();
                }
            });

        },

        open(mode, id = null) {
            if (mode === 'add') {
                this.form.reset()
                this.editmode = false

            }
            if (mode === 'edit') {
                this.editmode = true
                let user = [...this.users].find(el => el.id === id)
                this.form.fill(user)
            }

            this.display = true

        },
        hide() {
            this.display = false
            this.form.reset()
            this.errors = []
        },
        close() {
            this.display = false
            this.form.reset()
            this.errors = []
        }
    }
}
</script>

<style scoped>
.custom-dialog {

}
</style>
