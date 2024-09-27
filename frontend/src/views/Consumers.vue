<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="bg-gradient-info shadow-success border-radius-lg pt-4 pb-3"
            >
              <h6 class="text-white text-capitalize ps-3">Clientes</h6>
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
              <material-button
                class="btn btn-primary"
                @click="openAddClientModal"
              >
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
                      <button
                        class="btn btn-link text-secondary mb-0"
                        @click="viewClient(cliente)"
                      >
                        <i class="fa fa-eye text-xs" aria-hidden="true"></i>
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

    <!-- Modal de Adicionar Cliente -->
    <form-register-consumers
      :is-visible="isAddClientModalVisible"
      @update:isVisible="isAddClientModalVisible = $event"
      @client-added="getClients"
    ></form-register-consumers>

    <!-- Modal de Visualização do Cliente -->
    <form-view-consumers
      :is-visible="isViewClientModalVisible"
      :cliente="selectedClient"
      @update:isVisible="isViewClientModalVisible = $event"
    ></form-view-consumers>
  </div>
</template>

<script>
import MaterialButton from "@/components/MaterialButton.vue";
import axios from "axios";
import FormRegisterConsumers from "./components/Forms/FormRegisterConsumers.vue";
import FormViewConsumers from "./components/Forms/FormViewConsumers.vue"; // Atualize a importação

export default {
  name: "clients",
  components: {
    MaterialButton,
    FormRegisterConsumers,
    FormViewConsumers, // Adiciona o novo componente
  },
  data() {
    return {
      clients: [],
      filteredClients: [],
      loading: true,
      cacheClients: null,
      searchQuery: "",
      isAddClientModalVisible: false,
      isViewClientModalVisible: false,
      selectedClient: {}, // Armazena o cliente selecionado
    };
  },
  methods: {
    async getClients() {
      this.loading = true;

      if (this.cacheClients) {
        this.clients = this.cacheClients;
        this.filteredClients = this.clients;
        this.loading = false;
        return;
      }

      try {
        const response = await axios.get(
          "http://localhost:8000/api/v2/clientes"
        );
        this.clients = response.data;
        this.cacheClients = response.data;
        this.filteredClients = this.clients;
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
        this.filteredClients = this.clients;
      }
    },
    openAddClientModal() {
      this.isAddClientModalVisible = true;
    },
    viewClient(cliente) {
      this.selectedClient = cliente; // Armazena o cliente selecionado
      this.isViewClientModalVisible = true; // Abre o modal de visualização
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
.bg-gradient-info {
  background: linear-gradient(to right, #ffbb33, #222222);
}
.btn-primary {
  background: #ffbb33;
}
.btn-primary:hover {
  background-color: #222222;
}
</style>
