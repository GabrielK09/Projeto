<template>
    <div v-if="isVisible">
        <form @submit.prevent="novoCliente">
            <label for="nome_completo" class="form-label">Nome Completo</label>
            <input
                type="text"
                class="form-control border p-2"
                id="nome_completo"
                v-model="nome_completo"
                required
            />

            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input
                type="date"
                class="form-control border p-2"
                id="data_nascimento"
                v-model="data_nascimento"
            />

            <label for="tipo_pessoa">Tipo de pessoa</label>
            <select id="tipo_pessoa" v-model="tipo_pessoa" class="form-control border p-2">
                <option value="" disabled selected>Selecione o tipo</option>
                <option value="1">Física</option>
                <option value="2">Jurídica</option>

            </select>


            <div v-if="tipo_pessoa == '2'">
                <label for="cnpj">CNPJ</label>
                <input 
                    type="text" 
                    id="cnpj"
                    v-model="cnpj"
                
                />
            </div>
            <div v-else>
                <label for="cpf" class="form-label">CPF</label>
                <input
                    type="text"
                    class="form-control border p-2"
                    id="cpf"
                    v-model="cpf"
                    required
                />

            </div>

            <button type="submit" class="btn btn-primary mt-2">Criar Cliente</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "FormCadastroCliente",
    props: {
        isVisible: {
            type: Boolean,
            required: true
        },
    },
    data() {
        return {
            nome_completo: "",
            cpf: "",
            data_nascimento: null,
            tipo_pessoa: "",
            cnpj: "",
            tipo_cadastro: 1,
        };
    },
    methods: {
        formatoCPF(cpf){
            const cpfNovo = cpf.replace(/\D/g, "");
            if (cpfNovo.length === 11) {
                return `${cpfNovo.slice(0, 3)}.${cpfNovo.slice(3, 6)}.${cpfNovo.slice(6, 9)}-${cpfNovo.slice(9)}`
            }
            
            return cpf

        },  

        formatoCNPJ(cnpj) {
            const cnpjNovo = cnpj.replace(/\D/g, "");
            
            if (cnpjNovo.length === 14) {
                return `${cnpjNovo.slice(0, 2)}.${cnpjNovo.slice(2, 5)}.${cnpjNovo.slice(5, 8)}/${cnpjNovo.slice(8, 12)}-${cnpjNovo.slice(12)}`;
            }

            return cnpjNovo; //Retorna o CNPJ sem formatação se não tiver 14 dígitos
        },

        async novoCliente() {
            const formatoCPF = this.formatoCPF(this.cpf)
            const formatoCNPJ = this.formatoCNPJ(this.cnpj)
            console.log("Tipo de pessoa:", this.tipo_pessoa);
            console.log(this.cpf);
            console.log(this.cnpj);

            const novoClienteData = {
                nome_completo: this.nome_completo,
                cpf: this.tipo_pessoa === "1" ? formatoCPF : null,
                cnpj: this.tipo_pessoa === "2" ? formatoCNPJ : null,
                data_nascimento: this.data_nascimento,
                tipo_pessoa: this.tipo_pessoa,
                tipo_cadastro: this.tipo_cadastro,

            };

            console.log("Dados enviados:", novoClienteData)

            try {
                //const response = await axios.post('http://127.0.0.1:8000/api/clientes', novoClienteData);
                //const response = await axios.post('http://192.168.1.101:8081/api/clientes', novoClienteData);
                const response = await axios.post('http://192.168.1.101:8081/api/clientes', novoClienteData);
                console.log("Cliente criado: ", response);

                this.closeForms()
                
            } catch (error) {
                console.error("Erro ao criar: ", error);

            }
        },

        closeForms(){
            this.$emit("update:isVisible", false)
            this.cleanForm()
        },  
        
        cleanForm() {
            this.nome_completo = ""
            this.cpf = "";
            this.cnpj = "";
            this.tipo_pessoa = "";
            this.data_nascimento = "";

        }
    }
    
};
</script>

