<template>
  <div class="bg-white">
    <main class="mt-0 main-content">
      <section>
        <div
          class="page-header min-vh-100 d-flex align-items-center justify-content-center"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-xl-4 col-lg-5 col-md-7">
                <div class="card card-plain">
                  <div class="pb-0 card-header bg-transparent mb-4 text-center">
                    <h4 class="font-weight-bolder">Entrar</h4>
                    <p class="mb-0">
                      Insira seu email e senha para se registrar
                    </p>
                  </div>
                  <div class="card-body">
                    <form role="form">
                      <div class="mb-3">
                        <material-input
                          id="name"
                          type="text"
                          label="Nome"
                          name="name"
                          size="lg"
                        />
                      </div>
                      <div class="mb-3">
                        <material-input
                          id="email"
                          type="email"
                          label="Email"
                          name="email"
                          size="lg"
                        />
                      </div>
                      <div class="mb-3">
                        <material-input
                          id="password"
                          type="password"
                          label="Senha"
                          name="password"
                          size="lg"
                        />
                      </div>
                      <material-checkbox
                        id="flexCheckDefault"
                        class="font-weight-light"
                        checked
                      >
                        Eu concordo com os
                        <a
                          href="../../../pages/privacy.html"
                          class="text-dark font-weight-bolder"
                          >Termos e Condições</a
                        >
                      </material-checkbox>
                      <div class="text-center">
                        <material-button
                          class="mt-4"
                          variant="gradient"
                          color="success"
                          fullWidth
                          size="lg"
                          >Registrar</material-button
                        >
                      </div>
                    </form>
                  </div>
                  <div class="px-1 pt-0 text-center card-footer px-lg-2">
                    <p class="mx-auto mb-4 text-sm">
                      Já tem uma conta?
                      <router-link
                        :to="{ name: 'SignIn' }"
                        class="text-success text-gradient font-weight-bold"
                        >Entrar</router-link
                      >
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import MaterialButton from "@/components/MaterialButton.vue";
import MaterialCheckbox from "@/components/MaterialCheckbox.vue";
import MaterialInput from "@/components/MaterialInput.vue";
import { mapMutations } from "vuex";
const body = document.getElementsByTagName("body")[0];

export default {
  name: "sign-up",
  components: {
    MaterialInput,
    MaterialCheckbox,
    MaterialButton,
  },
  beforeMount() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
    body.classList.remove("bg-gray-100");
  },
  beforeUnmount() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
    body.classList.add("bg-gray-100");
  },
  methods: {
    ...mapMutations(["toggleEveryDisplay", "toggleHideConfig"]),
  },
};
</script>
