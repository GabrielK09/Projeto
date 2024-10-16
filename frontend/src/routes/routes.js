import { createRouter, createWebHistory } from "vue-router";
import LoginPage from "@/views/HomePage.vue";

import EstoqueView from "@/views/EstoqueView.vue"
import ClienteView from "@/views/ClienteView.vue";
import FormCadastroUsuario from "@/views/Forms/FormCadastroUsuario.vue";

const routes = [
  {
    path: "/",
    name: "LoginView",
    component: LoginPage
    
  },
  {
    path: "/estoque",
    name: "EstoqueView",
    component: EstoqueView,
    
  },
  {
    path: "/clientes",
    name: "ClienteView",
    component: ClienteView

  },
  {
    path: "/teste",
    name: "CadastroUsuario",
    component: FormCadastroUsuario
  }

];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
  
});

export default router;
