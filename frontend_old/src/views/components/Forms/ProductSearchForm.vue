<template>
  <div
    class="modal fade show d-block"
    tabindex="-1"
    style="background: rgba(0, 0, 0, 0.5)"
  >
    <div class="modal-dialog modal-lg">
      <!-- Classe adicionada aqui -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Buscar Produto</h5>
          <button type="button" @click="$emit('close')" class="btn">
            <i class="material-icons-round opacity-10" aria-hidden="true"
              >close</i
            >
          </button>
        </div>
        <div class="modal-body">
          <input
            type="text"
            class="form-control mb-3"
            placeholder="Digite o nome do produto..."
            v-model="searchQuery"
            @input="filterProducts"
          />
          <table class="table">
            <thead>
              <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="produto in filteredProducts" :key="produto.id">
                <td>{{ produto.nome }}</td>
                <td>R$ {{ produto.preco.toFixed(2) }}</td>
                <td>
                  <button
                    class="btn btn-primary btn-sm"
                    @click="addProduct(produto)"
                  >
                    Adicionar ao Carrinho
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
export default {
  props: ["products"],
  data() {
    return {
      searchQuery: "",
      filteredProducts: [],
    };
  },
  watch: {
    products: {
      immediate: true,
      handler() {
        this.filteredProducts = this.products;
      },
    },
  },
  methods: {
    filterProducts() {
      this.filteredProducts = this.products.filter((produto) =>
        produto.nome.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
    addProduct(produto) {
      this.$emit("add-to-cart", produto);
    },
  },
};
</script>
  
  <style scoped>
.modal {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
  