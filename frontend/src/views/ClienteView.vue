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
        <a href="/"><button>Voltar</button></a>
    </div>

    <form-cadastro-cliente
        :is-visible="isCadastroClienteVisible"
        @update:isVisible="isCadastroClienteVisible = $event" 
        @clienteAdicionado="todosClientes"

    ></form-cadastro-cliente>


</template>


<script>
    import FormCadastroCliente from '@/views/Forms/FormCadastroCliente.vue';
    import axios from 'axios';

    export default {
        name: "ClientesView",
        components: {
            FormCadastroCliente

        },

        data(){ 
            return {
                clientes: [],
                isCadastroClienteVisible: false

            }

        },

        methods: {
            async todosClientes() {
                try {
                    //const response = await axios.get('http://127.0.0.1:8000/api/clientes'); // LOCAL 
                    const response = await axios.get('http://192.168.98.51:8081/api/clientes'); // REDE
                    console.log(response)

                    this.clientes = Array.isArray(response.data) ? response.data : []

                } catch (error) {
                    console.error('Erro na busca dos clientes', error)
                
                }
            },

            openAddClienteModal(){
                //this.isCadastroClienteVisible = true;
                this.isCadastroClienteVisible = !this.isCadastroClienteVisible;
                
            }
            
        },

        mounted( ) {
            this.todosClientes()
            
        }
    }
</script>
 