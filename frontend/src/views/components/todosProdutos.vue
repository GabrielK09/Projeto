<template>
    <div v-if="isVisible">
        <h3>Todos os produtos</h3>
    
        <input 
            type="text" 
            placeholder="Selecionar cliente"
            v-model="clienteSelecionado"
            aria-label="Selecionar cliente"
        
        />

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
            faturarProdutos: [],
            clienteSelecionado: ''
            
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
                this.produtosSelecionados.push({...produto}); 
            }

        },

        async finalizarVenda() {
            try {
                this.faturarProdutos = [...this.produtosSelecionados];
                console.log('Cliente: ', this.clienteSelecionado);
                
                
                if (!this.clienteSelecionado) {
                    alert('Selecione o cliente por favor')    
                    return

                } 

                const response = await axios.post('http://192.168.98.51:8081/api/nfce/finalizar', {
                    faturarProdutos: this.faturarProdutos,
                    clienteSelecionado: this.clienteSelecionado

                });

                console.log(response);

                alert('Venda finalizada com sucesso!');
                
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
