<template>
  <div v-if="isVisible" class="overlay modal fade show">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalhes do Cliente</h5>
        <button type="button" @click="closeModal" class="btn">
          <i class="material-icons-round opacity-10" aria-hidden="true"
            >close</i
          >
        </button>
      </div>
      <div class="modal-body">
        <p><strong></strong> {{ cliente.nome_completo }}</p>
        <p><strong>CPF:</strong> {{ cliente.cpf }}</p>
        <p>
          <strong>Tipo de Pessoa:</strong>
          {{ cliente.tipo_pessoa === 1 ? "Física" : "Jurídica" }}
        </p>
        <p>
          <strong>Data de Nascimento:</strong>
          {{ formatDate(cliente.data_nascimento) }}
        </p>
        <p><strong>Criado em:</strong> {{ formatDate(cliente.created_at) }}</p>
      </div>
    </div>
  </div>
</template>
    
    <script>
export default {
  name: "FormViewProducts",
  props: {
    isVisible: {
      type: Boolean,
      required: true,
    },
    cliente: {
      type: Object,
      required: true,
    },
  },
  methods: {
    closeModal() {
      this.$emit("update:isVisible", false);
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("pt-BR");
    },
  },
};
</script>
    
    <style scoped>
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: white;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
  position: relative;
}
.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px; /* Diminui o espaço abaixo do cabeçalho */
}
.modal-body {
  margin-top: 0; /* Remove o espaço acima do corpo, se necessário */
}
.btn {
  border: none;
  background: transparent;
  cursor: pointer;
  font-size: 1.5rem; /* Ajusta o tamanho do botão de fechar */
}
</style>
    