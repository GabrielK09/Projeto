<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="bg-gradient-info shadow-success border-radius-lg pt-4 pb-3"
            >
              <h6 class="text-white text-capitalize ps-3">Fornecedores</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div
              class="d-flex justify-content-end align-items-center mb-4 me-4"
            >
              <input
                type="text"
                class="form-control me-2"
                placeholder="Buscar cliente..."
                v-model="searchQuery"
                @input="filterClients"
                style="width: 300px"
              />
              <material-button class="btn btn-primary" @click="addClient">
                Adicionar
              </material-button>
            </div>
            <div class="table-responsive p-0">
              <div v-if="loading" class="text-center my-3">
                <span
                  class="spinner-border spinner-border-sm"
                  role="status"
                  aria-hidden="true"
                ></span>
                <span> Carregando...</span>
              </div>
              <table
                v-else
                class="table align-items-center justify-content-center mb-0"
              >
                <thead>
                  <tr>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                    >
                      Nome
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                    >
                      Cpf
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                    >
                      Tipo Pessoa
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2"
                    >
                      Criado em
                    </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cliente in filteredClients" :key="cliente.id">
                    <td>
                      <div class="d-flex px-2">
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">
                            {{ cliente.nome_completo }}
                          </h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">
                        {{ cliente.cpf }}
                      </p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">{{
                        cliente.tipo_cadastro
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="me-2 text-xs font-weight-bold">{{
                        formatDate(cliente.created_at)
                      }}</span>
                    </td>
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0">
                        <i
                          class="fa fa-ellipsis-v text-xs"
                          aria-hidden="true"
                        ></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div
                v-if="
                  !loading && (!filteredClients || filteredClients.length === 0)
                "
                class="text-center my-3"
              >
                <span>Nenhum cliente encontrado</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import MaterialButton from "@/components/MaterialButton.vue";
import axios from "axios";

export default {
  name: "clients",
  data() {
    return {
      clients: [],
      filteredClients: [],
      loading: true,
      cacheClients: null,
      searchQuery: "",
    };
  },
  components: {
    MaterialButton,
  },
  methods: {
    async getClients() {
      this.loading = true;

      if (this.cacheClients) {
        this.clients = this.cacheClients;
        this.filteredClients = this.clients; // Inicializa os clientes filtrados
        this.loading = false;
        return;
      }

      try {
        const response = await axios.get(
          "http://localhost:8000/api/v2/clientes"
        );
        this.clients = response.data;
        this.cacheClients = response.data;
        this.filteredClients = this.clients; // Inicializa os clientes filtrados
      } catch (error) {
        console.error("Erro ao buscar clientes:", error);
      } finally {
        this.loading = false;
      }
    },
    filterClients() {
      if (this.searchQuery) {
        this.filteredClients = this.clients.filter((cliente) =>
          cliente.nome_completo
            .toLowerCase()
            .includes(this.searchQuery.toLowerCase())
        );
      } else {
        this.filteredClients = this.clients; // Reseta para todos os clientes
      }
    },
    addClient() {
      // Lógica para adicionar um novo cliente
      console.log("Adicionar cliente");
    },
    formatDate(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleDateString("pt-BR");
    },
  },
  mounted() {
    this.getClients();
  },
};
</script>
<style scoped>
.btn-primary {
  background: #ffbb33;
}
.btn-primary:hover {
  background-color: #222222;
}

.bg-gradient-info {
  background: linear-gradient(
    to right,
    #ffbb33,
    #222222
  ); /* Gradiente para o cabeçalho */
}
</style>