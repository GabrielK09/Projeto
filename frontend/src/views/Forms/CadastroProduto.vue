<template>
    <header>Cadastro</header>

    <form @submit.prevent="addProduto">

        <label for="nome" class="form-label">Nome</label>
        <input
            type="text"
            class="form-control border p-2"
            id="nome"
            v-model="nome"
            required
        />

        <label for="qte" class="form-label">Quantia</label>
        <input
            type="number"
            class="form-control border p-2"
            id="qte"
            v-model="qte"
            required
        />

        <label for="codGtin" class="form-label">codGtin</label>
        <input
            type="number"
            class="form-control border p-2"
            id="codGtin"
            v-model="codGtin"
            required
        />

        <label for="precoVenda" class="form-label">Preço Venda</label>
        <input
            type="number"
            class="form-control border p-2"
            id="precoVenda"
            v-model="precoVenda"
            required
        />

        <label for="precoCusto" class="form-label">Preço Custo</label>
        <input
            type="number"
            class="form-control border p-2"
            id="precoCusto"
            v-model="precoCusto"
            required
        />
        
        <label for="percLucro" class="form-label">Percentual de Lucro</label>
        <input
            type="number"
            class="form-control border p-2"
            id="percLucro"
            v-model="percLucro"
            required
        />

        <label for="cfop" class="form-label">CFOP</label>
        <input
            type="number"
            class="form-control border p-2"
            id="cfop"
            v-model="cfop"
            required
        />

        <label for="csosn" class="form-label">CSOSN</label>
        <input
            type="number"
            class="form-control border p-2"
            id="csosn"
            v-model="csosn"
            required
        />

        <label for="ncm" class="form-label">NCM</label>
        <input
            type="number"
            class="form-control border p-2"
            id="ncm"
            v-model="ncm"
            required
        />
        <button type="submit" class="btn btn-dark">Salvar</button>
    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "CadastroProduto",
    
        data () {
            return {
                nome: "",
                qte: null,
                codGtin: null,
                precoVenda: null,
                precoCusto: null,
                percLucro: null,
                cfop: null,
                csosn: null,
                ncm: null,
            } 
        },
        methods: {
            async addProduto() {
                const novoProduto = {
                    nome: this.nome,
                    qte: parseFloat(this.qte),
                    cod_gtin: this.codGtin,
                    preco_venda: parseFloat(this.precoVenda),
                    preco_custo: parseFloat(this.precoCusto),
                    perc_lucro: parseFloat(this.percLucro),
                    cfop: this.cfop,
                    csosn: this.csosn,
                    ncm: this.ncm
                };

                try {
                    await axios.post('http://127.0.0.1:8000/api/produto', novoProduto);
                    console.log("Produto adicionado com sucesso!");

                } catch (error) {
                    console.error("Erro ao adicionar produto:", error);
                }
            },

            finallyForm(){

            },


        }
    }
</script>
