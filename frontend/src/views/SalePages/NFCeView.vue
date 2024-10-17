<template>
    <h1>NFCe</h1>   
    
    <div v-for="produto	 in produtos" :key="produto.id">
        {{ produto }}
        
    </div>
    

















    <a href="/"><button>Voltar</button></a>
</template>

<script>
    import axios from "axios";

    export default {
        name: "VendasNFCe",
     
        data () {
            return {
                produtos: [],
                produtosSelecionados: []

            }
        },
        methods: {
            async todosProdutos() {
                try {
                     const response = await axios.get('http://127.0.0.1:8000/api/produto'); //LOCAL
                    //const response = await axios.get('http://192.168.98.51:8081/api/produto'); // REDE
                    console.log(response)
                    console.log("AAAAAAAAA")

                    this.produtos = Array.isArray(response.data.data) ? response.data.data : []
                

                } catch (error) {
                    console.error('Erro ao buscar os dados:', error);

                } 
            }
        },
        mounted() {
            this.todosProdutos()
        }
    }
</script>