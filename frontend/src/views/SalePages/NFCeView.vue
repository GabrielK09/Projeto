<template>
    <h1>NFCe</h1>   

    <a href="/"><button>Voltar</button></a>


    <button @click="openTodosProdutosModal">Buscar</button>

    <form-todos-produtos
        :is-visible="isTodosProdutosVisible"
        @update:isVisible="isTodosProdutosVisible = $event"
        
    ></form-todos-produtos>

    
</template>

<script>
    import FormTodosProdutos from "@/views/components/todosProdutos.vue";

    export default {
        name: "NFCeView",
        components: {
            FormTodosProdutos

        },

        data () {
            return {
                produtos: [],
                isTodosProdutosVisible: false,
                produtosSelecionados: []

            }
        },

        methods: {
            openTodosProdutosModal() {
                this.isTodosProdutosVisible = !this.isTodosProdutosVisible
            }
            
        }
    }

</script>