import { createRouter, createWebHistory } from "vue-router";
<<<<<<< HEAD
import Estoque from "@/views/Estoque.vue";
=======
import EstoqueView from '../views/EstoqueView.vue'
import LoginPage from "../views/LoginPage.vue";
>>>>>>> 3caea59f4a4d199b12bc2ed48b8995b9608be79c

const routes = [
  {
    path: "/",
<<<<<<< HEAD
    name: "Estoque",
    component: Estoque,
=======
    name: "LoginView",
    component: LoginPage
    
  },
  {
    path: "/estoque",
    name: "EstoqueView",
    component: EstoqueView,
    
>>>>>>> 3caea59f4a4d199b12bc2ed48b8995b9608be79c
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

export default router;
