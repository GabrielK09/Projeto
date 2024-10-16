<template>
    <div>
        <h1>Todos os clientes</h1>
        
        <div v-for="cliente in clientes" :key="cliente.id">
            Nome: {{ cliente.nome_completo }}
            <div class="client-info">
                <span v-if="cliente.tipo_pessoa == '1'" class="cpf">CPF: {{ cliente.cpf }}</span>
                <span v-else class="cnpj">CNPJ: {{ cliente.cnpj }}</span>
            </div>
            <br>

        </div>

        <button @click="openAddClienteModal">Novo cliente</button>
    </div>

    <form-novo-cliente
        :is-visible="isNovoClienteVisible"
        @update:isVisible="isNovoClienteVisible = $event" 
        @clienteAdicionado=""

    ></form-novo-cliente>

</template>


<script>
    import NovoClinete from './Forms/NovoClinete.vue';
    import axios from 'axios';

    export default {
        name: "ClientesView",
        components: {
            NovoClinete

        },

        data(){ 
            return {
                clientes: []

            }

        },

        methods: {
            async todosClientes() {
                try {
                    const response = await axios.get('http://127.0.0.1:8000/api/clientes');
                    console.log(response)

                    this.clientes = Array.isArray(response.data) ? response.data : []

                } catch (error) {
                    console.error('Erro na busca dos clientes', error)
                
                }
            }
            
        },

        mounted( ) {
            this.todosClientes()
            
        }
    }
</script>
