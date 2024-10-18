<template>
    <div v-if="isVisible">
        <h3>Todos os produtos</h3>
    
        <div v-if="produtos.length >= 0">            
            <div v-for="produto in produtos" :key="produto.id">
                <p> {{ produto.nome }}</p>
                <button @click="selecionarProduto(produto)">Adicionar</button>
            </div>
        
        </div>
        <div v-else>
            <h4>Sem produtos</h4>
        </div>


        <div v-if="produtosSelecionados.length >= 0">
            <div v-for="produto in produtosSelecionados" :key="produto.id">
                <p> {{  produto.id }}</p>
                <p> {{  produto.nome }}</p>
                
            </div>
        </div>
        <div v-else>
            <h4>Carrinho Vazio</h4>

        </div>
        
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "todosProdutos",
        props: {
            isVisible: {
                type: Boolean,
                required: true

            }
        },
     
        data () {
            return {
                produtos: [],
                produtosSelecionados: []

            }
        },
    
        methods: {
            async todosProdutos() {
                try {
                    //const response = await axios.get('http://127.0.0.1:8000/api/produto'); //LOCAL
                    const response = await axios.get('http://192.168.98.51:8081/api/nfce/adicionar'); // REDE
                    console.log(response)
                    this.produtos = Array.isArray(response.data.data) ? response.data.data : []
                

                } catch (error) {
                    console.error('Erro ao buscar os dados:', error);

                } 
            },

            async selecionarProduto(produto) {
                console.log("Produto selecionado: ", produto)

                const jaSelecionado = this.produtosSelecionados.some(p => p.id === produto.id )

                if(!jaSelecionado) {
                    this.produtosSelecionados.push(produto)

                }

                console.log('Produtos: ', this.produtosSelecionados)

                await this.attCarrinho()
            },

            async attCarrinho() {
                try {
                    const response = await axios.post('http://192.168.98.51:8081/api/nfce/carrinho', {
                        produtos: this.produtosSelecionados

                    });

                    console.log('Carrinho atualizado', response.data)
                } catch (error) {
                    console.error('Erro ao atualizar o carrinho:', error);

                }

            }
        },
        mounted() {
            this.todosProdutos()
            //this.selecionarProduto()

        }
    }
</script>