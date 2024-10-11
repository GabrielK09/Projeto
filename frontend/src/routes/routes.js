import { createRouter, createWebHistory } from "vue-router";
import Estoque from "@/views/Estoque.vue";

const routes = [
  {
    path: "/",
    name: "Estoque",
    component: Estoque,
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

export default router;
