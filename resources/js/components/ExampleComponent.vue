<template>
  <div id="app">
    <!-- <router-link to="/home" class="btn btn-primary">Home</router-link> -->
    <router-link to="/create" class="btn btn-dark">Add User</router-link>
    <router-view />
  </div>
</template>

<script>
import datatable from "datatables.net-bs4";
    export default {
        methods:{
            getUser() {
                var _this = this;
                axios.get('/getUser').then(function(response){
                    _this.users = response.data;
                })
            },
        },
        created(){
            this.getUser();
        }
    };
</script>

<style></style>
