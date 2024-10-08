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
                  <h3 class="font-weight-bolder text-white">Reset Password</h3>
                  <p class="mb-0 text-sm text-white">
                    You will receive an e-mail in maximum 60 seconds
                  </p>
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
                      id="email"
                      v-model:value="userEmail"
                      type="email"
                      label="Email"
                      placeholder="john@email.com"
                      name="email"
                      variant="static"
                    />
                  </div>
                  <div class="text-center">
                    <material-button
                      class="mt-4"
                      variant="gradient"
                      color="warning"
                      full-width
                      >Reset</material-button
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
import * as Yup from "yup";

export default {
  name: "PasswordForgot",
  components: {
    MaterialInputField,
    MaterialButton,
    Form,
  },
  data() {
    return {
      userEmail: "",
      schema: Yup.object().shape({
        email: Yup.string()
          .email("Email has to be a valid email address")
          .required("Email is a required input"),
      }),
    };
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
      try {
        await this.$store.dispatch("auth/passwordForgot", this.userEmail);
        showSwal.methods.showSwal({
          type: "success",
          message: "Email sent!",
          width: 500,
        });
        this.$router.push({ name: "Login" });
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
