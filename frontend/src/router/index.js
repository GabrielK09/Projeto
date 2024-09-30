import CashRegister from "@/views/pages/CashRegister.vue";
import Consumers from "@/views/pages/Consumers.vue";
import ManualNote from "@/views/pages/ManualNote.vue";
import Products from "@/views/pages/Products.vue";
import Providers from "@/views/pages/Providers.vue";
import SaleNoteNfce from "@/views/pages/SaleNoteNfce.vue";
import Users from "@/views/pages/Users.vue";
import PasswordForgot from "@/views/PasswordForgot.vue";
import PasswordReset from "@/views/PasswordReset.vue";
import SignIn from "@/views/SignIn.vue";
import SignUp from "@/views/SignUp.vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "/",
    redirect: "/salenote",
  },
  {
    path: "/cashregister",
    name: "Caixa",
    component: CashRegister,
  },
  {
    path: "/products",
    name: "Estoque",
    component: Products,
  },
  {
    path: "/login",
    name: "SignIn",
    component: SignIn,
  },
  {
    path: "/logout",
    name: "SignUp",
    component: SignUp,
  },
  {
    path: "/consumers",
    name: "Clientes",
    component: Consumers,
  },
  {
    path: "/passwordforgot",
    name: "Password Forgot",
    component: PasswordForgot,
  },
  {
    path: "/password-reset",
    name: "Password Reset",
    component: PasswordReset,
  },
  {
    path: "/providers",
    name: "Fornecedores",
    component: Providers,
  },
  {
    path: "/users",
    name: "Users",
    component: Users,
  },
  //Rotas PDV
  {
    path: "/manualnote",
    name: "Nota Manual",
    component: ManualNote,
  },
  {
    path: "/salenote",
    name: "NFC-e",
    component: SaleNoteNfce,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

export default router;
