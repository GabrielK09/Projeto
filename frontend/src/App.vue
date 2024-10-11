<<<<<<< HEAD
<script setup>
import Estoque from './views/Estoque.vue'
=======
<template>
  <div ip="app">
    <router-view></router-view>

  </div>
</template>

<script>
export default {
  name: 'App',
  
}

>>>>>>> 3caea59f4a4d199b12bc2ed48b8995b9608be79c

</script>

<<<<<<< HEAD
  <h2>Produtos</h2>
  <div v-for="produto in produtos" :key="produto.id">
    Produto: {{ produto.nome }}
  </div>
</template>
-->



<template>
  <Estoque />
  
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
=======
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
>>>>>>> 3caea59f4a4d199b12bc2ed48b8995b9608be79c
}
</style>

