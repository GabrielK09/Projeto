<template>
  <div class="py-4 container-fluid">
    <div class="mt-4 user">
      <div class="col-12">
        <div class="card">
          <div class="card-header border-bottom">
            <div class="user d-flex align-items-center">
              <div class="col-6">
                <h5 class="mb-0 ms-0">Usuários</h5>
              </div>
              <div class="col-6 text-end">
                <material-button class="float-right btn btm-sm">
                  <i class="fas fa-user-plus me-2"></i>
                  Cadastrar Usuário
                </material-button>
              </div>
            </div>
          </div>
          <div class="px-0 pb-0 card-body">
            <table class="table table-flush mt-3">
              <thead class="thead-light">
                <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Criado em</th>
                  <th class="text-end">Ações</th>
                </tr>
              </thead>
              <tbody>
                <user-item-list
                  :name="me.name"
                  :email="me.email"
                  :created="me.created_at"
                ></user-item-list>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MaterialButton from "@/components/MaterialButton.vue";
import showSwal from "@/mixins/showSwal";
import UserItemList from "../components/tables/UserItemList.vue";

export default {
  name: "Users",
  components: {
    MaterialButton,
    UserItemList,
  },
  data() {
    return {
      me: {},
    };
  },
  async mounted() {},
  methods: {
    showProMessage() {
      showSwal.methods.showSwal({
        type: "error",
        message: "This is a PRO feature.",
        width: 500,
      });
    },
  },
};
</script>
<style scoped>
table thead tr th {
  padding-left: 1.5 rem !important;
}
.btn-success {
  background: #ffbb33;
}
.btn-success:hover {
  background-color: #222222;
}
</style>
