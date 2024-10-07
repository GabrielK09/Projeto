<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-9">
        <div class="card my-4 border-0 shadow-lg">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div
              class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3"
            >
              <h6 class="text-white text-capitalize ps-3">Venda Nfce</h6>
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
              <button class="btn btn-dark" @click="openModal">
                Adicionar Produto
              </button>
              <ProductModal
                v-if="showModal"
                :show="showModal"
                @close="showModal = false"
                @add-product="addProductToCart"
              />
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
                  <tr v-for="produto in productsInCart" :key="produto.id">
                    <td>
                      <div class="d-flex px-2">
                        <div class="my-auto">
                          <h6 class="mb-0 text-sm">{{ produto.nome }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-sm font-weight-bold mb-0">
                        R$ {{ parseFloat(produto.preco_venda).toFixed(2) }}
                      </p>
                    </td>
                    <td>
                      <span class="text-xs font-weight-bold">{{
                        produto.qte
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
                v-if="!loading && productsInCart.length === 0"
                class="text-center my-3"
              >
                <span>Nenhum produto no carrinho</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
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
              <button class="btn btn-dark" @click="finalizarVenda">
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
import ProductModal from "../components/Forms/ProductModal.vue";

export default {
  name: "storeCashRegister",
  components: {
    ProductModal,

  },
  data() {
    return {
      products: [],
      filteredProducts: [],
      loading: true,
      searchQuery: "",
      desconto: 0,
      acrescimo: 0,
      total: 0,
      funcionario: "Funcionario Padrão",
      cliente: "Cliente Padrão",
      formaPagamento: "",
      showModal: false,
      productsInCart: [],

    };
  },
  methods: {
    async getProducts() {
      this.loading = true;

      try {
        const response = await axios.get(
          "http://localhost:8000/api/v2/pdv/busca"

        );
        this.products = response.data.data;
        this.filteredProducts = this.products;

      } catch (error) {
        console.error("Erro ao buscar produtos:", error);

      } finally {
        this.loading = false;

      }
    },
    filterProducts() {
      if (this.searchQuery) {
        this.filteredProducts = this.products.filter((produto) =>
          produto.nome.toLowerCase().includes(this.searchQuery.toLowerCase()),
          
        );

      } else {
        this.filteredProducts = this.products;

      }
    },
    addProductToCart(product) {
      const existingProduct = this.productsInCart.find(
        (p) => p.id === product.id,

        console.log(`ID produto selecionado: ${product.id}, ${product.nome}`)

      );
      if (existingProduct) {
        existingProduct.qte += 1;

      } else {
        product.qte = 1;
        this.productsInCart.push(product);

      }
      this.calculateTotal();

    },
    calculateTotal() {
      const subtotal = this.productsInCart.reduce((acc, produto) => {
        return acc + parseFloat(produto.preco_venda) * produto.qte;
        
      }, 0);

      const descontoTotal = parseFloat(this.desconto) || 0;
      const acrescimoTotal = parseFloat(this.acrescimo) || 0;
      this.total = subtotal - descontoTotal + acrescimoTotal;

    },
    async finalizarVenda() {
      const sale = {
        forma_pagamento: this.formaPagamento,
        acrescimo: this.acrescimo,
        desconto: this.desconto,
        produtos: this.productsInCart.map((produto) => ({
          id: produto.id,
          nome: produto.nome,
          preco_venda: parseFloat(produto.preco_venda),
          quantidade: produto.qte,

        })),

      };

      if (!sale.forma_pagamento) {
        alert("Preencha todas as informações da venda.");
        return;
      }

      try {
        const response = await axios.post(
          "http://localhost:8000/api/v2/pdv/finalizar",
          sale

        );
        console.log(response);
        alert("Venda finalizada com sucesso!");
        //this.resetSale(); // Método para reiniciar os dados da venda
        console.log(response.data);

      } catch (error) {
        console.error("Erro ao finalizar a venda:", error);

        if (error.response && error.response.data) {
          alert(
            error.response.data.detail ||
              "Erro ao finalizar a venda. Tente novamente."

          );

        } else {
          alert("Erro ao finalizar a venda. Tente novamente.");

        }
      }
    },
    formatDate(dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(dateString).toLocaleDateString(undefined, options);

    },
    openModal() {
      this.showModal = true;

    },
  },
  created() {
    this.getProducts();

  },
};
</script>