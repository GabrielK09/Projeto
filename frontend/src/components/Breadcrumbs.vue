<template>
  <nav aria-label="breadcrumb">
    <ol
      class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb"
      :class="{ 'me-sm-6': !isRTL }"
    >
      <li
        v-if="isRTL"
        class="text-sm breadcrumb-item"
        :class="color || 'text-dark'"
      >
        <a :class="color || 'text-dark'" class="opacity-5 ps-2" role="button">
          لوحات القيادة
        </a>
      </li>
    </ol>
    <h6 class="mb-0 font-weight-bolder" :class="color || 'text-dark'">
      {{ currentPage }}
    </h6>
  </nav>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "Breadcrumbs",
  props: {
    currentPage: {
      type: String,
      required: true, // Garante que a prop seja passada como string
    },
    color: {
      type: String,
      default: "text-dark", // Define um valor padrão seguro para a prop 'color'
    },
  },
  computed: {
    ...mapState(["isRTL"]),
  },
};
</script>
