<template>
    <h1>Nota Manual</h1>   

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
        name: "NotaManualView",
        components: {
            FormTodosProdutos

        },

        data () {
            return {
                produtos: [],
                isTodosProdutosVisible: false

            }
        },

        methods: {
            openTodosProdutosModal() {
                this.isTodosProdutosVisible = !this.isTodosProdutosVisible
            }
            
        }
    }

</script>