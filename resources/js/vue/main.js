//importación de terceros
import { createApp } from 'vue';
import '../../css/vue.css'
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import "@mdi/font/css/materialdesignicons.min.css"
import axios from 'axios';
//importación creadas por nosotros
import App from './App.vue';
import router from './router';

const app = createApp(App).use(Oruga).use(router)

app.config.globalProperties.$axios=axios
window.axios=axios

app.mount('#app')
