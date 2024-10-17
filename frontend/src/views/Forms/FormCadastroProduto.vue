<template>
    <div v-if="isVisible">
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

            <div>
                <label for="codGtin" class="form-label">codGtin</label>
                    <input
                    type="number"
                    class="form-control border p-2"
                    id="codGtin"
                    v-model="codGtin"
                    required
                />
                <button
                    type="button"
                    @click="codGTINgenerate"
                >
                    Gerar    
                </button>
            </div>
            <label for="precoCusto" class="form-label">Preço Custo</label>
            <input
                type="number"
                class="form-control border p-2"
                id="precoCusto"
                @input="calculateValues('custo')"
                v-model="precoCusto"
                required
            />

            <label for="percLucro" class="form-label">Percentual de Lucro</label>
            <input
                type="number"
                class="form-control border p-2"
                id="percLucro"
                @input="calculateValues('lucro')"
                v-model="percLucro"
                required
            />

            <label for="precoVenda" class="form-label">Preço Venda</label>
            <input
                type="number"
                class="form-control border p-2"
                id="precoVenda"
                @input="calculateValues('venda')"
                v-model="precoVenda"
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
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "CadastroProduto",
        props: {
            isVisible: {
                type: Boolean,
                required: true

            },
        },
    
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
                    preco_custo: parseFloat(this.precoCusto),
                    perc_lucro: parseFloat(this.percLucro),
                    preco_venda: parseFloat(this.precoVenda),
                    cfop: this.cfop,
                    csosn: this.csosn,
                    ncm: this.ncm
                };

                try {
                    const response = await axios.post('http://127.0.0.1:8000/api/produto', novoProduto); // LOCAL 
                    //const response = await axios.post('http://192.168.98.51:8081/api/produto', novoProduto); // REDE
                    
                    console.log("Produto adicionado com sucesso!", response);
        
                    
                } catch (error) {
                    console.error("Erro ao adicionar produto:", error);
                }
            },

            codGTINgenerate(){
                this.codGtin = String(
                    Math.floor(1000000000000 + Math.random() * 9000000000000)

                )
            },

            calculateValues(changedField) {
                if ( changedField === "custo" && this.precoCusto && this.percLucro !== null ) {
                    // Se o preço de custo foi alterado, calcula o preço de venda
                    this.precoVenda = Math.trunc(this.precoCusto * (1 + this.percLucro / 100) * 100) / 100;
                } else if ( changedField === "venda" && this.precoVenda && this.precoCusto !== null ) {
                    // Se o preço de venda foi alterado, calcula o percentual de lucro
                    this.percLucro = Math.trunc(((this.precoVenda - this.precoCusto) / this.precoCusto) * 100);
                } else if ( changedField === "lucro" && this.percLucro !== null && this.precoCusto ) {
                    // Se o percentual de lucro foi alterado, calcula o preço de venda
                    this.precoVenda = Math.trunc(this.precoCusto * (1 + this.percLucro / 100) * 100) / 100;
                }
            },
            // cleanForm() {
            //     this.nome = "";
            //     this.qte = "";
            //     this.codGtin = "";
            //     this.preco_custo = "";
            //     this.perc_lucro = "";
            //     this.preco_venda = "";
            //     this.cfop = ""
            //     this.csosn = ""
            //     this.ncm = ""
                
            // }

        }
    }
</script>
