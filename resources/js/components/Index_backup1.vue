<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3><div class="card-header">User List</div> </h3>
                    <div class="card-body">
                        <div id="">
                            <datatable :columns="columns" :data="users"></datatable>
                            <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
                        </div>
                        <!-- <table class="table" id="myTable">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key = "user.id">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td><button @click="showModal=true; setVal(user.id, user.name, user.email)" type="button" class="btn btn-outline-dark">Edit</button></td>
                                    <td><button @click.prevent="deleteUser(user)" type="button" class="btn btn-outline-danger">Delete</button></td>
                                </tr>
                            </tbody>
                        </table> -->
                        <router-view></router-view>
                    </div>
                    <modal v-if="showModal" @close="showModal=false">
                        <h3 slot="header">Edit User</h3>
                        <div slot="body">
                            <input type="hidden" disabled class="form-control" id="e_id" name="id" required  :value="this.e_id">
                            Name: <input type="text" class="form-control" id="e_name" name="name"
                                    required  :value="this.e_name">
                            Email: <input type="email" class="form-control" id="e_email" name="email"
                            required  :value="this.e_email">
                        </div>
                        <div slot="footer">
                            <button class="btn btn-default" @click="showModal = false"> Cancel </button>
                            <button class="btn btn-info" @click="editUser()"> Update </button>
                        </div>
                    </modal>
                    <script type="text/x-template" id="modal-template">
                        <transition name="modal">
                            <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-container">

                                <div class="modal-header">
                                    <slot name="header">
                                    default header
                                    </slot>
                                </div>

                                <div class="modal-body">
                                    <slot name="body">

                                    </slot>
                                </div>

                                <div class="modal-footer">
                                    <slot name="footer">


                                    </slot>
                                </div>
                                </div>
                            </div>
                            </div>
                        </transition>
                    </script>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DatatableFactory from 'vuejs-datatable';
export default {
    components: { DatatableFactory },
    data() {
        return {
            columns: [
                {label: 'ID', field: 'id'},
                {label: 'Name', field: 'name'},
                {label: 'Email', field: 'email'}
            ],
                rows: [],
                page: 1,
                per_page: 10,
            newUser: {'name': '','email':'','password':''},
            users: {},
            showModal: false,
            e_name: '',
            e_email: '',
            e_id: ''
        }
    },

    mounted: function mounted() {
    this.getUser();
  },

    methods: {
        //fetch user and display in table
        getUser() {
            var _this = this;
            axios.get('/getUser').then(function(response){
                _this.users = response.data;
            })
        },
        //for set the values in table
        setVal(val_id, val_name, val_email) {
            this.e_id = val_id;
            this.e_name = val_name;
            this.e_email = val_email;
        },

        deleteUser(user){
            var _this = this;
            axios.post('/deleteUser/' + user.id).then(function(response){
               _this.getUser();
            })
        },

        editUser(){
            var i_val_1 = document.getElementById('e_id');
            var n_val_1 = document.getElementById('e_name');
            var a_val_1 = document.getElementById('e_email');

            axios.post('/editUser/' + i_val_1.value, {val_1: n_val_1.value, val_2: a_val_1.value})
                .then(response => {
                this.getUser();
                this.showModal=false
            });
        },
        create(){
            axios.get('/create');
        }

    },
    created(){
        this.getUser();
    }
}
</script>
