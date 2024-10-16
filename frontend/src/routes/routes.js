import { createRouter, createWebHistory } from "vue-router";
import LoginPage from "@/views/LoginPage.vue";

import EstoqueView from "@/views/EstoqueView.vue"
import ClienteView from "@/views/ClienteView.vue";

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

  }

];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
  
});

export default router;
