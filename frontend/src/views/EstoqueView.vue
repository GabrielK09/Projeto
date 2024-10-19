<template>
    <h2>Estoque</h2>

    <div v-for="produto in produtos" :key="produto.id">
        Código: {{ produto.id }} |
        Produto: {{ produto.nome }} |
        Preço: {{ produto.preco_venda }} |
        

    </div>

    <button @click="openAddProdutoModal">Adicionar produto</button>
    <a href="/"><button>Voltar</button></a>

    <form-cadastro-produto
        :is-visible="isCadastroProdutoVisible"
        @update:isVisible="isCadastroProdutoVisible = $event"
        @produtoAdicionado="todosProdutos"

    ></form-cadastro-produto>
</template>


<script>
    import FormCadastroProduto from "./Forms/FormCadastroProduto.vue";
    import axios from "axios";

    export default {
        name: "EstoqueView",
        components: {
            FormCadastroProduto

        },

        data (){
            return {
                produtos: [],
                isCadastroProdutoVisible: false

            };
        },

        methods: {
            async todosProdutos() {
                try {
                    //const response = await axios.get('http://127.0.0.1:8000/api/produto'); //LOCAL
                    const response = await axios.get('http://192.168.1.101:8081/api/produto'); // REDE
                    console.log(response)

                    this.produtos = Array.isArray(response.data.data) ? response.data.data : []
                

                } catch (error) {
                    console.error('Erro ao buscar os dados:', error);

                } 
            },

            openAddProdutoModal() {
                this.isCadastroProdutoVisible = !this.isCadastroProdutoVisible

            },
           
        },

        mounted() {
            this.todosProdutos()
        },
    }
</script>

<!--
        setup () {         
            onMounted(() => {
                const produtos = ref([]);

                const response = await axios.get('http://127.0.0.1:8000/api/produto')

                try {
                    console.log('Resposta da API:', response.data);
                    
                    produtos.value = response.data.data; 

                } catch (error) {
                    console.error('Erro ao buscar os dados:', error);
                }     
            }),
        }
    }

-->