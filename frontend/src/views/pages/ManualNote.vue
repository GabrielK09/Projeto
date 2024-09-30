<template>
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-9 m-0">
        <div class="card my-4 border-0 shadow-lg">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3"
            >
              <h6 class="text-white text-capitalize ps-3">Nota Manual</h6>
            </div>
          </div>
          <div class="card-body px-4 pb-2">
            <div class="d-flex justify-content-end align-items-center mb-4">
              <input
                type="text"
                class="form-control me-2"
                placeholder="Buscar produto..."
                v-model="searchQuery"
                @input="filterProducts"
                style="width: 300px"
              />
              <button class="btn btn-dark dark" @click="addProduct">
                Adicionar Produto
              </button>
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
                      Nome do Produto
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                    >
                      Preço
                    </th>
                    <th
                      class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                    >
                      Quantidade
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
                  <tr v-for="produto in filteredProducts" :key="produto.id">
                    <td>
                      <div class="d-flex px-2">
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">{{ produto.nome }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">
                        R$ {{ produto.preco.toFixed(2) }}
                      </p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">{{
                        produto.quantidade
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="me-2 text-xs font-weight-bold">{{
                        formatDate(produto.created_at)
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
      <div class="col-3 m-0">
        <div class="card my-4 border-0 shadow-lg">
          <div class="card-body">
            <div class="mb-3 total-container">
              <h6
                class="text-uppercase text-secondary text-xxs font-weight-bolder mb-3"
              >
                Total da Venda
              </h6>
              <div class="d-flex justify-content-between mb-3">
                <span>Total:</span>
                <span class="font-weight-bold">R$ {{ total.toFixed(2) }}</span>
              </div>
            </div>
            <div class="mb-3">
              <label for="desconto" class="form-label">Desconto:</label>
              <input
                type="number"
                class="form-control"
                id="desconto"
                v-model="desconto"
                @input="calculateTotal"
                placeholder="Valor do desconto"
              />
            </div>
            <div class="mb-3">
              <label for="acrescimo" class="form-label">Acréscimo:</label>
              <input
                type="number"
                class="form-control"
                id="acrescimo"
                v-model="acrescimo"
                @input="calculateTotal"
                placeholder="Valor do acréscimo"
              />
            </div>
            <div class="mb-3">
              <label for="formaPagamento" class="form-label"
                >Forma de Pagamento:</label
              >
              <select
                class="form-control"
                id="formaPagamento"
                v-model="formaPagamento"
              >
                <option value="" disabled selected>Selecione uma forma</option>
                <option value="dinheiro">Dinheiro</option>
                <option value="cartao_credito">Cartão de Crédito</option>
                <option value="cartao_debito">Cartão de Débito</option>
                <option value="transferencia">Transferência</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="funcionario" class="form-label">Funcionário:</label>
              <input
                type="text"
                class="form-control"
                id="funcionario"
                v-model="funcionario"
                placeholder="Nome do funcionário"
              />
            </div>
            <div class="mb-3">
              <label for="cliente" class="form-label">Cliente:</label>
              <input
                type="text"
                class="form-control"
                id="cliente"
                v-model="cliente"
                placeholder="Nome do cliente"
              />
            </div>
            <div class="text-center">
              <button class="btn btn-dark dark" @click="finalizarVenda">
                Finalizar Venda
              </button>
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
  name: "storeCashRegister",
  data() {
    return {
      products: [],
      filteredProducts: [],
      loading: true,
      cacheProducts: null,
      searchQuery: "",
      desconto: 0,
      acrescimo: 0,
      total: 0,
      funcionario: "Funcionario Padrão",
      cpfCnpj: "",
      cliente: "Cliente Padrão",
      formaPagamento: "", // Adicionando a variável para forma de pagamento
    };
  },
  methods: {
    async getProducts() {
      this.loading = true;

      if (this.cacheProducts) {
        this.products = this.cacheProducts;
        this.filteredProducts = this.products;
        this.loading = false;
        return;
      }

      try {
        const response = await axios.get(
          "http://localhost:8000/api/v2/produtos"
        );
        this.products = response.data;
        this.cacheProducts = response.data;
        this.filteredProducts = this.products; // Inicializa os produtos filtrados
      } catch (error) {
        console.error("Erro ao buscar produtos:", error);
      } finally {
        this.loading = false;
        this.calculateTotal(); // Calcula o total inicial após obter os produtos
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
      this.calculateTotal(); // Atualiza o total ao filtrar produtos
    },
    addProduct() {
      console.log("Adicionar produto");
    },
    calculateTotal() {
      // Calcula o total considerando descontos e acréscimos
      const subtotal = this.filteredProducts.reduce((acc, produto) => {
        return acc + produto.preco * produto.quantidade;
      }, 0);
      const descontoTotal = parseFloat(this.desconto) || 0;
      const acrescimoTotal = parseFloat(this.acrescimo) || 0;
      this.total = subtotal - descontoTotal + acrescimoTotal;
    },
    finalizarVenda() {
      // Lógica para finalizar a venda
      console.log("Venda finalizada");
      // Aqui você pode incluir a lógica para salvar a venda com as informações do funcionário, CPF/CNPJ, cliente e forma de pagamento
    },
    formatDate(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleDateString("pt-BR");
    },
  },
  mounted() {
    this.getProducts();
  },
};
</script>

<style scoped lang="scss">
.card {
  border-radius: 10px; /* Arredondar os cantos do cartão */
}

.bg-gradient-info {
  background: linear-gradient(to right, #ffbb33, #222222);
}

.table {
  th {
    background-color: #f8f9fa; /* Cor de fundo para o cabeçalho da tabela */
    border-bottom: 2px solid #dee2e6; /* Borda mais forte na parte inferior do cabeçalho */
  }

  td {
    border-bottom: 1px solid #dee2e6; /* Borda na parte inferior das células da tabela */
  }

  tr:hover {
    background-color: #f1f1f1; /* Cor de fundo ao passar o mouse sobre a linha */
  }
}

.btn-primary {
  border-radius: 5px; /* Botão com cantos arredondados */
  padding: 5px 15px; /* Ajusta o padding do botão */
  height: 36px; /* Define uma altura específica para os botões */
}

input.form-control {
  border-radius: 5px; /* Campos de entrada com cantos arredondados */
  height: 20px; /* Ajusta a altura dos campos de entrada */
}

.card-body {
  padding: 1rem; /* Ajusta o padding do card para um visual mais compacto */
}

.mb-3 {
  margin-bottom: 1rem; /* Reduz o espaço entre os campos */
}

.total-container {
  margin-bottom: 1.5rem; /* Espaço extra em baixo do Total da Venda */
}
</style>
