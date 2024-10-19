<template>
    <div>
        <form @submit.prevent="addUsuario">
            <label for="login">Login</label>
            <input 
                type="text"
                id="login"
                v-model="login"
                required

            />

            <label for="senha">Senha</label>
            <input 
                type="password"
                id="senha"
                v-model="senha"
                required

            />

            <button type="submit">Criar</button>
        </form>
    
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "CadastroUsuario",
    
        data (){
            return {
                login: "",
                senha: ""

            }
        },

        methods: {
            async addUsuario() {
                const novoUsuario = {
                    login: this.login,
                    senha: this.senha

                };

                try {
                    //const response = await axios.post('http://127.0.0.1:8000/api/produto', novoUsuario); // LOCAL 
                    //const response = await axios.post('http://192.168.1.101:8081/api/usuarios' , novoUsuario); // REDE
                    const response = await axios.post('http://192.168.1.101:8081/api/usuarios' , novoUsuario); // REDE
                    console.log('Usuario adicionado com sucesso', response.data)

                } catch (error) {
                    console.error('ERRO: ', error)

                }
            }
        }
    }

</script>