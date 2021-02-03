<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 mt-3">
        <div class="card">
          <h3><div class="card-header">User List</div></h3>
          <div class="card-body">
            <table id="example" class="display" style="width: 100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
            <router-view></router-view>
          </div>
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
import datatable from "datatables.net-bs4";
export default {
  mounted() {
    this.table();
  },
  methods: {
    table() {
      $("#example").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/getUser",
        order: [[0, "asc"]],
        columns: [
          {
            data: "id",
            name: "id",
          },
          {
            data: "name",
            name: "name",
          },
          {
            data: "email",
            name: "email",
          },
          { data: "action", name: "action", orderable: false, searchable: false },
        ],
      });
    },
  },
};
</script>
