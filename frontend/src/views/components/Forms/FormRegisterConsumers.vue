<template>
  <div
    v-if="isVisible"
    class="modal fade show"
    style="display: block"
    tabindex="-1"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Cliente</h5>
          <button type="button" class="btn styledb" @click="closeModal">
            <i class="material-icons-round opacity-10" aria-hidden="true"
              >close</i
            >
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="addClient">
            <div class="mb-3">
              <label for="nomeCompleto" class="form-label">Nome Completo</label>
              <input
                type="text"
                class="form-control border p-2"
                id="nomeCompleto"
                v-model="nomeCompleto"
                required
              />
            </div>
            <div class="mb-3">
              <label for="cpf" class="form-label">CPF</label>
              <input
                type="text"
                class="form-control border p-2"
                id="cpf"
                v-model="cpf"
                required
              />
            </div>
            <div class="mb-3">
              <label for="dataNascimento" class="form-label"
                >Data de Nascimento</label
              >
              <input
                type="date"
                class="form-control border p-2"
                id="dataNascimento"
                v-model="dataNascimento"
                required
              />
            </div>
            <div class="mb-3">
              <label for="tipoPessoa" class="form-label">Tipo de Pessoa</label>
              <select
                class="form-select border p-2"
                v-model="tipoPessoa"
                required
              >
                <option value="1">Física</option>
                <option value="2">Jurídica</option>
              </select>
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
  name: "FormRegisterConsumers",
  props: {
    isVisible: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      nomeCompleto: "",
      cpf: "",
      dataNascimento: "",
      tipoPessoa: 1,
    };
  },
  methods: {
    formatCPF(cpf) {
      const numbers = cpf.replace(/\D/g, "");
      if (numbers.length === 11) {
        return `${numbers.slice(0, 3)}.${numbers.slice(3, 6)}.${numbers.slice(
          6,
          9
        )}-${numbers.slice(9)}`;
      }
      return cpf;
    },

    formatDateOfBirth(date) {
      const parsedDate = new Date(date);
      const year = parsedDate.getFullYear();
      const month = String(parsedDate.getMonth() + 1).padStart(2, "0"); // Adiciona 1 ao mês e preenche com zero
      const day = String(parsedDate.getDate()).padStart(2, "0"); // Preenche com zero
      return `${year}-${month}-${day}`;
    },

    async addClient() {
      const formattedCpf = this.formatCPF(this.cpf);
      const formattedDateOfBirth = this.formatDateOfBirth(this.dataNascimento);

      const newClient = {
        nome_completo: this.nomeCompleto,
        tipo_pessoa: Number(this.tipoPessoa),
        cpf: formattedCpf,
        data_nascimento: formattedDateOfBirth, // Data formatada
        tipo_cadastro: 2,
      };

      try {
        await axios.post("http://localhost:8000/api/v2/clientes", newClient);
        this.closeModal(); // Feche o modal após a operação
      } catch (error) {
        console.error("Erro ao adicionar cliente:", error);
      }
    },

    closeModal() {
      // Emitir evento para o componente pai
      this.$emit("update:isVisible", false);
      this.resetForm(); // Resetar o formulário ao fechar
    },

    resetForm() {
      this.nomeCompleto = "";
      this.cpf = "";
      this.dataNascimento = "";
      this.tipoPessoa = 1;
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
