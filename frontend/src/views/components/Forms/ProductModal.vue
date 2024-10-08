<template>
  <div class="modal" tabindex="-1" role="dialog" v-if="show">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Produto</h5>
          <button
            type="button"
            class="btn styledb"
            @click="closeModal"
            aria-label="Fechar"
          >
            <i class="material-icons-round opacity-10" aria-hidden="true"
              >close</i
            >
          </button>
        </div>
        <div class="modal-body">
          <input
            type="text"
            class="form-control mb-3"
            placeholder="Buscar produto..."
            v-model="searchQuery"
            @input="filterProducts"
          />
          <div v-if="loading" class="text-center my-3">
            <span
              class="spinner-border spinner-border-sm"
              role="status"
              aria-hidden="true"
            ></span>
            <span> Carregando...</span>
          </div>
          <div v-else>
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>Nome do Produto</th>
                  <th>Preço</th>
                  <th>Ação</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="produto in filteredProducts" :key="produto.id">
                  <td>{{ produto.nome }}</td>
                  <td>R$ {{ produto.preco_venda }}</td>
                  <td>
                    <button
                      class="btn btn-primary"
                      @click="selectProduct(produto)"
                    >
                      Adicionar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div v-if="filteredProducts.length === 0" class="text-center my-3">
              <span>Nenhum produto encontrado</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    show: Boolean,
  },
  data() {
    return {
      products: [],
      filteredProducts: [],
      loading: true,
      searchQuery: "",
    };
  },
  computed: {
    filteredProducts() {
      if (this.searchQuery) {
        return this.products.filter((produto) =>
          produto.nome.toLowerCase().includes(this.searchQuery.toLowerCase())

        );
      }
      return this.products || [];
    },
  },
  methods: {
    async getProducts() {
      this.loading = true;
      try {
        const response = await axios.get(
          //"http://localhost:8000/api/v2/produto"
          // É esse
          "http://localhost:8000/api/v2/busca",

          { params: { selectProduct: this.productId }}

        );
        
        this.products = response.data.data;

      } catch (error) {
        console.error("Erro ao buscar produtos:", error);

      } finally {
        this.loading = false;

      }
    },
    async selectProduct(produto) {
    this.$emit("add-product", produto);

      try {
          const response = await axios.get(`http://localhost:8000/api/v2/busca/${produto.id}`, {
              params: {
                  productId: produto.id // Envia o ID do produto selecionado como parâmetro de consulta

              }
          });

          const itemResponse = await axios.get(`http://localhost:8000/api/v2/itemSelecionado`, {
              params: { id: produto.id }

          })

          console.log("Produto buscado pela rota: http://localhost:8000/api/v2/busca/${produto.id}:", response.data );

          console.log("Produto buscado pela rota: http://localhost:8000/api/v2/itemSelecionado:", JSON.stringify(itemResponse.data, null, 2));

      } catch (error) {
          console.error("Erro ao buscar produto:", error);
      }

      this.closeModal();
  },
    closeModal() {
      this.$emit("close");

    },
  },
  mounted() {
    this.getProducts();
  },
};
</script>

<style scoped>
.modal {
  display: block;
  background: rgba(0, 0, 0, 0.5);
}
.modal-dialog {
  margin-top: 10%;
}
.btn-primary {
  background-color: #ffbb33;
}

.btn-primary:hover {
  background-color: #222222;
}

</style>1