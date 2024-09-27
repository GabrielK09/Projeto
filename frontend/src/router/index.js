import { createRouter, createWebHistory } from "vue-router";
import CashRegister from "../views/CashRegister.vue";
import Consumers from "../views/Consumers.vue";
import Dashboard from "../views/Dashboard.vue";
import PasswordForgot from "../views/examples-api/PasswordForgot.vue";
import PasswordReset from "../views/examples-api/PasswordReset.vue";
import Users from "../views/examples-api/users/UsersList.vue";
import ManualNote from "../views/ManualNote.vue";
import Products from "../views/Products.vue";
import Providers from "../views/Providers.vue";
import SaleNoteNfce from "../views/SaleNoteNfce.vue";
import SignIn from "../views/SignIn.vue";
import SignUp from "../views/SignUp.vue";

const routes = [
  {
    path: "/",
    name: "/",
    redirect: "/sign-in",
  },
  {
    path: "/dashboard",
    name: "Dashboard",
    component: Dashboard,
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
    path: "/sign-in",
    name: "SignIn",
    component: SignIn,
  },
  {
    path: "/sign-up",
    name: "SignUp",
    component: SignUp,
  },
  {
    path: "/consumers",
    name: "Clientes",
    component: Consumers,
  },
  {
    path: "/password-forgot",
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
    path: "/manual-note",
    name: "Nota Manual",
    component: ManualNote,
  },
  {
    path: "/sale-note",
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
