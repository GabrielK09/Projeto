<template>
  <div v-for="produto in produtos" :key="produto.id">
      <p> {{ produto.nome }}</p>
  </div>
</template>

<script>
    //import TodosProdutos from "@/views/components/todosProdutos.vue";
    import axios from "axios";

    export default {
        name: "todosProdutos",
     
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