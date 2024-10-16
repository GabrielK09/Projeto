<template>
    <h2>Home Page</h2>

    <div v-for="produto in produtos" :key="produto.id">
        Código: {{ produto.id }} |
        Produto: {{ produto.nome }} |
        Preço: {{ produto.preco_venda }} |
        Produto: {{ produto.nome }} 


    </div>
</template>


<script>
    import axios from "axios";

    export default {
        name: "EstoqueView",

        data (){
            return {
                produtos: []

            };
        },

        methods: {
            async fetchProdutos() {
                try {
                    const response = await axios.get('http://127.0.0.1:8000/api/produto');
                    console.log(response)

                    this.produtos = Array.isArray(response.data) ? response.data : []

                } catch (error) {
                    console.error('Erro ao buscar os dados:', error);

                } 
            }
        },

        mounted() {
            this.fetchProdutos()
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