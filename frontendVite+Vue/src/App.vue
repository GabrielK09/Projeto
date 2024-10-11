<script setup>

import HelloWorld from './components/HelloWorld.vue'
import HomePage from './views/HomePage.vue'

import axios from "axios";
import { ref } from 'vue';

const produtos = ref([]);

// Faz a requisição à API
axios.get('http://127.0.0.1:8000/api/produto')
  .then((response) => {
    console.log('Resposta da API:', response.data);
    // Acesse o array de produtos corretamente
    produtos.value = response.data.data; // Ajuste aqui
  })
  .catch((error) => {
    console.error('Erro ao buscar os dados:', error);
  });

</script>
<!--
<template>
  <div>
    <a href="https://vitejs.dev" target="_blank">
      <img src="/vite.svg" class="logo" alt="Vite logo" />
    </a>
    <a href="https://vuejs.org/" target="_blank">
      <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
    </a>
  </div>
  <HelloWorld msg="Vite + Vue" />

  <h2>Produtos</h2>
  <div v-for="produto in produtos" :key="produto.id">
    Produto: {{ produto.nome }}
  </div>
</template>
-->



<template>
  <HomePage />
  
</template>



<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
