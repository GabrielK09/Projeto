module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    "plugin:vue/vue3-essential",
    "plugin:vue/recommended",
    "eslint:recommended",
    "@vue/prettier",
  ],
  parser: '@babel/eslint-parser',
  parserOptions: {
    requireConfigFile: false,
  },
  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "warn" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "warn" : "off",
    "prettier/prettier": "off",
    "vue/attribute-hyphenation": "off",
    "vue/no-unused-vars": "off",
    "vue/max-attributes-per-line": [
      "error",
      {
        singleline: 3,
        multiline: 1, // Permite 1 atributo por linha em múltiplas linhas
      },
    ],
    "vue/singleline-html-element-content-newline": "off",
    "vue/multiline-html-element-content-newline": "off",
    "vue/require-v-for-key": "off", // Desativação opcional
  },
};

