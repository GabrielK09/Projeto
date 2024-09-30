<template>
  <div
    v-if="isVisible"
    class="modal fade show"
    style="display: block"
    tabindex="-1"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Produto</h5>
          <button type="button" class="btn styledb" @click="closeModal">
            <i class="material-icons-round opacity-10" aria-hidden="true"
              >close</i
            >
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="addProduct">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input
                type="text"
                class="form-control border p-2"
                id="nome"
                v-model="nome"
                required
              />
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="qte" class="form-label">Quantidade</label>
                <input
                  type="number"
                  class="form-control border p-2"
                  id="qte"
                  v-model="qte"
                  required
                />
              </div>
              <div class="col-md-6 mb-3">
                <label for="codGtin" class="form-label">Código GTIN</label>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control border p-2"
                    id="codGtin"
                    v-model="codGtin"
                    @input="validateCodGtin"
                    required
                    maxlength="13"
                  />
                  <button
                    type="button"
                    class="btn btn-secondary"
                    @click="generateRandomGtin"
                  >
                    Gerar
                  </button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="precoCusto" class="form-label"
                  >Preço de Custo</label
                >
                <input
                  type="number"
                  class="form-control border p-2"
                  id="precoCusto"
                  v-model="precoCusto"
                  @input="calculateValues('custo')"
                  required
                />
              </div>
              <div class="col-md-6 mb-3">
                <label for="precoVenda" class="form-label"
                  >Preço de Venda</label
                >
                <input
                  type="number"
                  class="form-control border p-2"
                  id="precoVenda"
                  v-model="precoVenda"
                  @input="calculateValues('venda')"
                  required
                />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="percLucro" class="form-label"
                  >Percentual de Lucro</label
                >
                <input
                  type="number"
                  class="form-control border p-2"
                  id="percLucro"
                  v-model="percLucro"
                  @input="calculateValues('lucro')"
                  required
                />
              </div>
              <div class="col-md-6 mb-3">
                <label for="cfop" class="form-label">CFOP</label>
                <input
                  type="number"
                  class="form-control border p-2"
                  id="cfop"
                  v-model="cfop"
                  required
                />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="csosn" class="form-label">CSOSN</label>
                <input
                  type="number"
                  class="form-control border p-2"
                  id="csosn"
                  v-model="csosn"
                  required
                />
              </div>
              <div class="col-md-6 mb-3">
                <label for="ncm" class="form-label">NCM</label>
                <input
                  type="number"
                  class="form-control border p-2"
                  id="ncm"
                  v-model="ncm"
                  required
                />
              </div>
            </div>
            <button type="submit" class="btn btn-dark">Salvar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div v-if="isVisible" class="modal-backdrop fade show"></div>
</template>

<script>
import axios from "axios";

export default {
  name: "FormRegisterProducts",
  props: {
    isVisible: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      nome: "",
      qte: null,
      codGtin: "",
      precoVenda: null,
      precoCusto: null,
      percLucro: null,
      cfop: null,
      csosn: null,
      ncm: null,
    };
  },
  methods: {
    validateCodGtin() {
      // Remove todos os caracteres não numéricos e garante que o valor tenha exatamente 13 dígitos
      const cleanGtin = this.codGtin.replace(/\D/g, "");
      if (cleanGtin.length > 13) {
        this.codGtin = cleanGtin.slice(0, 13); // Truncar se exceder 13 dígitos
      } else {
        this.codGtin = cleanGtin; // Apenas limpar
      }
    },

    generateRandomGtin() {
      // Gera um GTIN aleatório de 13 dígitos
      this.codGtin = String(
        Math.floor(1000000000000 + Math.random() * 9000000000000)
      );
    },

    calculateValues(changedField) {
      if (
        changedField === "custo" &&
        this.precoCusto &&
        this.percLucro !== null
      ) {
        // Se o preço de custo foi alterado, calcula o preço de venda
        this.precoVenda = this.precoCusto * (1 + this.percLucro / 100);
      } else if (
        changedField === "venda" &&
        this.precoVenda &&
        this.precoCusto !== null
      ) {
        // Se o preço de venda foi alterado, calcula o percentual de lucro
        this.percLucro =
          ((this.precoVenda - this.precoCusto) / this.precoCusto) * 100;
      } else if (
        changedField === "lucro" &&
        this.percLucro !== null &&
        this.precoCusto
      ) {
        // Se o percentual de lucro foi alterado, calcula o preço de venda
        this.precoVenda = this.precoCusto * (1 + this.percLucro / 100);
      }
    },

    async addProduct() {
      const newProduct = {
        nome: this.nome,
        qte: parseFloat(this.qte),
        cod_gtin: this.codGtin,
        preco_venda: parseFloat(this.precoVenda),
        preco_custo: parseFloat(this.precoCusto),
        perc_lucro: parseFloat(this.percLucro),
        cfop: parseFloat(this.cfop),
        csosn: parseFloat(this.csosn),
        ncm: parseFloat(this.ncm),
      };

      try {
        await axios.post("http://localhost:8000/api/v2/produto", newProduct);
        this.closeModal();
      } catch (error) {
        console.error("Erro ao adicionar produto:", error);
      }
    },

    closeModal() {
      this.$emit("update:isVisible", false);
      this.resetForm();
    },

    resetForm() {
      this.nome = "";
      this.qte = null;
      this.codGtin = "";
      this.precoVenda = null;
      this.precoCusto = null;
      this.percLucro = null;
      this.cfop = null;
      this.csosn = null;
      this.ncm = null;
    },
  },
};
</script>

<style scoped>
.modal-backdrop {
  opacity: 0.5;
}

.styledb {
  margin: 0;
  padding: 0;
}
</style>
