<template>
    <div v-if="isVisible">
        <h3>Todos os produtos</h3>
    
        <div v-if="produtos.length > 0">            
            <div v-for="produto in produtos" :key="produto.id">
                <p>{{ produto.nome }}</p>
                <button @click="selecionarProduto(produto)">Adicionar</button>
            </div>
        </div>
        <div v-else>
            <h4>Sem produtos</h4>
        </div>

        <div v-if="produtosSelecionados.length > 0">
            <div v-for="produto in produtosSelecionados" :key="produto.id">
                <p>ID: {{ produto.id }}</p>
                <p>Nome: {{ produto.nome }}</p>
                <p>Quantidade: {{ produto.qte }}</p>
            </div>
        </div>
        <div v-else>
            <h4>Carrinho Vazio</h4>
        </div>        

        <h2>Total: R$ {{ calcularTotal }} </h2>

        <button @click="finalizarVenda()">Finalizar venda</button>
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
     
    data() {
        return {
            produtos: [],
            produtosSelecionados: [],
            faturarProdutos: []
        }
    },
    
    computed: {
        calcularTotal() {
            return this.produtosSelecionados.reduce((total, produto) => {
                return total + (produto.preco_venda * produto.qte);
            }, 0).toFixed(2);
        }
    },

    methods: {
        async todosProdutos() {
            try {
                const response = await axios.get('http://192.168.98.51:8081/api/nfce/adicionar');
                this.produtos = Array.isArray(response.data.data) ? response.data.data : [];
            } catch (error) {
                console.error('Erro ao buscar os dados:', error);
            } 
        },

        async selecionarProduto(produto) {
            const jaSelecionado = this.produtosSelecionados.find(p => p.id === produto.id);

            if (jaSelecionado) {
                jaSelecionado.qte += 1;
            } else {
                produto.qte = 1;
                this.produtosSelecionados.push({...produto}); // Copia o produto para manter a referência correta
            }

            await this.attCarrinho();
        },

        async attCarrinho() {
            try {
                await axios.post('http://192.168.98.51:8081/api/nfce/carrinho', { 
                    produtosSelecionados: this.produtosSelecionados
                });
            } catch (error) {
                console.error('Erro ao atualizar o carrinho:', error);
            }
        },

        async finalizarVenda() {
            try {
                this.faturarProdutos = [...this.produtosSelecionados]; // Copia os produtos selecionados

                const response = await axios.post('http://192.168.98.51:8081/api/nfce/finalizar', {
                    faturarProdutos: this.faturarProdutos
                });

                console.log(response);
                // Adicione uma mensagem de sucesso
                alert('Venda finalizada com sucesso!');
                
                // Limpa os produtos selecionados após a venda
                this.produtosSelecionados = [];
            } catch (error) {
                console.error('Erro ao finalizar a venda:', error);
            }
        }
    },

    mounted() {
        this.todosProdutos();
    }
}
</script>
