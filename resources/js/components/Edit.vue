<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                     <h3><div class="card-header">Edit User</div></h3>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="e_name" name="name" required  v-model="user.name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="e_email" name="email"
                            required  v-model="user.email">
                        </div>
                    <button class="btn btn-info" @click="editUser">Update User </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            user: {'name': '','email':'', 'id':''}
        }
    },

    methods: {
        //for set the values in table
        setVal() {
            axios.get('/fetchUser/' + this.user.id).then((result) => {
                if(result.status == 200){
                    this.user = result.data;
                }
            }).catch((err) => {
                console.log(err);
            });
        },
        editUser(){
            axios.post('/editUser/' + this.user.id, this.user).then((result) => {
                console.log(result);
                if(result.status == 200){
                    // this.user = result.data;
                    window.location.href="/home"
                }
            }).catch((err) => {
                console.log(err);
            });
        },
    },
    created(){
        this.user.id = this.$route.params.id;
        this.setVal();
    }
}
</script>
