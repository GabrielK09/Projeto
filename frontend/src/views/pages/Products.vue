<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="bg-gradient-info shadow-success border-radius-lg pt-4 pb-3"
            >
              <h6 class="text-white text-capitalize ps-3">Produtos</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div
              class="d-flex justify-content-end align-items-center mb-4 me-4"
            >
              <input
                type="text"
                class="form-control me-2"
                placeholder="Buscar produto..."
                v-model="searchQuery"
                @input="filterProducts"
                style="width: 300px"
              />
              <material-button 
              class="btn btn-primary" 
              @click="addProduct"
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
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3"
                      style="width: 600px"
                    >
                      Nome
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                      style="width: 15px"
                    >
                      Código de Barras
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                      style="width: 15px"
                    >
                      Preço de Custo
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2"
                      style="width: 15px"
                    >
                      Preço de Venda
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs text-start font-weight-bolder text-center pe-2 opacity-7 ps-2"
                      style="width: 15px"
                    >
                      Quantidade
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs text-start font-weight-bolder text-center opacity-7 ps-2"
                      style="width: 15px"
                    >
                      CFOP
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder text-end opacity-7 ps-50 d-flex justify-content-end"
                      style="width: 15px"
                    >
                      CSOSN
                    </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="produto in filteredProducts" :key="produto.id">
                    <td
                      class="text-sm font-weight-bold mb-0 ps-3"
                      style="width: 500px"
                    >
                      <div>
                        <h6 class="mb-0 text-sm">{{ produto.nome }}</h6>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">
                        {{ produto.cod_gtin }}
                      </p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">{{
                        "R$ " + converValue(produto.preco_custo)
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="me-2 text-xs font-weight-bold">{{
                        "R$ " + converValue(produto.preco_venda)
                      }}</span>
                    </td>
                    <td class="align-middle">
                      <span class="text-xs font-weight-bold">{{
                        produto.qte
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-xs font-weight-bold">{{
                        produto.cfop
                      }}</span>
                    </td>
                    <td class="align-middle text-end">
                      <span class="text-xs font-weight-bold">{{
                        produto.csosn
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
                  !loading &&
                  (!filteredProducts || filteredProducts.length === 0)
                "
                class="text-center my-3"
              >
                <span>Nenhum produto encontrado</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form-register-products
      :is-visible="isAddProductModalVisible"
      @update:isVisible="isAddProductModalVisible = $event"
      @protuct-added="getProducts"
    ></form-register-products>

  <form-view-produc
      :is-visible="isViewProductModalVisible"
      :product="selectedProduct"
      @update:isVisible="isViewClientModalVisible = $event"
  ></form-view-produc>
</template>

<script>
import MaterialButton from "@/components/MaterialButton.vue";
import axios from "axios";

import FormRegisterProducts from "../components/Forms/FormRegisterProducts.vue"
import FormViewProducts from "../components/Forms/FormViewProducts.vue"

export default {
  name: "products",
  components: {
    MaterialButton,
    FormViewProducts,
    FormRegisterProducts

  },
  data() {
    return {
      products: [],
      filteredProducts: [],
      loading: true,
      cacheProducts: null,
      searchQuery: "",
      isAddProductModalVisible: false,
      selectedProduct: {}
      
    };
  },
  methods: {
    converValue(value) {
      return value.toString().replace(".", ",");
    },
    async getProducts() {
      this.loading = true;

      try {
        const response = await axios.get(
          "http://localhost:8000/api/v2/produto"
        );
        console.log(response);
        // Garante que products seja um array
        this.products = Array.isArray(response.data.data)
          ? response.data.data
          : [response.data.data];
      } catch (error) {
        console.error("Erro ao buscar produtos:", error);
        this.products = []; // Em caso de erro, inicializa como array vazio
      } finally {
        this.filteredProducts = [...this.products]; // Atualiza filteredProducts
        this.loading = false;
      }
    },
    filterProducts() {
      if (this.searchQuery) {
        this.filteredProducts = this.products.filter((produto) =>
          produto.nome.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      } else {
        this.filteredProducts = this.products; // Reseta para todos os produtos
      }
    },

    openAddClientModal(){
      this.isAddProductModalVisible = true;
      if (!this.isAddProductModalVisible) {
        this.getProducts();
        
      }
    },

    async addProduct() {
      this.isAddProductModalVisible = true;  // Abre o modal de adicionar produto
      await this.getProducts();  // Atualiza a lista de produtos (se necessário)
      
    },
    formatDate(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleDateString("pt-BR");
    },
  },
  viewProduct(produto){
    this.selectedProduct = produto;
    this.isViewProductModalVisible = true;
    
  },
  mounted() {
    this.getProducts();
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
  background: linear-gradient(to right, #ffbb33, #222222);
}
</style>
