import { createRouter, createWebHistory } from "vue-router";
import EstoqueView from '../views/EstoqueView.vue'
import LoginPage from "../views/LoginPage.vue";

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
    
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

export default router;
