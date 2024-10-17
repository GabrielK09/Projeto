import { createRouter, createWebHistory } from "vue-router";
import LoginPage from "@/views/LoginPage.vue";

import EstoqueView from "@/views/EstoqueView.vue"
import ClienteView from "@/views/ClienteView.vue";
import FormCadastroUsuario from "@/views/Forms/FormCadastroUsuario.vue";
import NFCeView from "@/views/SalePages/NFCeView.vue";
import NotaManual from "@/views/SalePages/NotaManual.vue";

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
  },

  {
    path: "/nfce",
    name: "VendasNFCe",
    component: NFCeView

  },
  {
    path: "/nota-manual",
    name: "VendasNotaManual",
    component: NotaManual

  }


];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
  
});

export default router;
