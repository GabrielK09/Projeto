import { createApp } from 'vue'
import App from './App.vue'
import router from "./routes/routes";

const appInstance = createApp(App);
appInstance.use(router)
appInstance.mount('#app')
