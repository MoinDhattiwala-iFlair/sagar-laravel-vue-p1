<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input
                type="text"
                v-model="newUser.name"
                id="name"
                placeholder="Add Your Name Here..."
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                v-model="newUser.email"
                id="email"
                placeholder="Add Your E-mail Here..."
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="email">Password</label>
              <input
                type="password"
                v-model="newUser.password"
                id="password"
                placeholder="Add Your Password Here..."
                class="form-control"
              />
            </div>

            <button
              type="button"
              @click.prevent="createUser()"
              class="btn btn-outline-dark"
            >
              Add User
            </button>
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
      newUser: { name: "", email: "", password: "" },
    };
  },

  methods: {
    createUser() {
      var input = this.newUser;
      var _this = this;
      if (input["name"] == "" || input["email"] == "" || input["password"] == "") {
        alert("Please fill all the fields");
      } else {
        axios.post("/storeUser", input).then(function (response) {
          _this.newUser = { name: "", email: "", password: "" };
        });
      }
    },
  },
};
</script>
