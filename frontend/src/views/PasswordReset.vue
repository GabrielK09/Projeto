<template>
  <main class="mt-0 main-content">
    <div class="page-header align-items-start min-vh-50 m-3 border-radius-lg">
      <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <section>
      <div class="container mb-4">
        <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card mt-8">
              <div
                class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
              >
                <div
                  class="bg-gradient-warning shadow-warning border-radius-lg py-3 pe-1 text-center py-4"
                >
                  <h3 class="font-weight-bolder text-white">Mudar Senha</h3>
                </div>
              </div>
              <div class="py-4 card-body">
                <Form
                  role="form"
                  :validation-schema="schema"
                  @submit="handleReset"
                >
                  <div class="mb-3">
                    <material-input-field
                      id="newPassword"
                      v-model:value="passwordDTO.newPassword"
                      type="password"
                      label="Nova Senha"
                      name="newPassword"
                      variant="static"
                    />
                  </div>
                  <div class="mb-3">
                    <material-input-field
                      id="confirmPassword"
                      v-model:value="passwordDTO.confirmPassword"
                      type="password"
                      label="Confirmar nova senha"
                      name="confirmPassword"
                      variant="static"
                    />
                  </div>
                  <div class="text-center">
                    <material-button
                      class="mt-4"
                      variant="gradient"
                      color="warning"
                      full-width
                      >Confirmar</material-button
                    >
                  </div>
                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import MaterialButton from "@/components/MaterialButton.vue";
import MaterialInputField from "@/components/MaterialInputField.vue";
import showSwal from "@/mixins/showSwal";
import { mapMutations } from "vuex";
const body = document.getElementsByTagName("body")[0];

import { Form } from "vee-validate";
import { useRoute } from "vue-router";
import * as Yup from "yup";

export default {
  name: "Password Reset",
  components: {
    MaterialInputField,
    MaterialButton,
    Form,
  },
  data() {
    return {
      passwordDTO: {},
      schema: Yup.object().shape({
        newPassword: Yup.string()
          .required("O campo senha é obrigatório")
          .min(8, "Senha deve ter no minimo 8 digitos"),
        confirmPassword: Yup.string()
          .required("O campo confirmar senha é obrigatório")
          .oneOf([Yup.ref("newPassword")], "As senhas não são iguais."),
      }),
    };
  },
  setup() {
    const route = useRoute();
    const query = route.query;
    return { query };
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
    async handleReset() {
      this.passwordDTO.email = this.query.email;
      this.passwordDTO.token = this.query.token;
      try {
        await this.$store.dispatch("auth/passwordReset", this.passwordDTO);
        showSwal.methods.showSwal({
          type: "success",
          message: `Password Changed!`,
          width: 500,
        });
      } catch (error) {
        showSwal.methods.showSwal({
          type: "error",
          message: "Oops, something went wrong!",
          width: 500,
        });
      }
    },
  },
};
</script>
