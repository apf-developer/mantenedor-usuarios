import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { markRaw } from 'vue'
import createPersistedState from 'pinia-plugin-persistedstate'

import './assets/main.css'

import App from './App.vue'
import axios from 'axios'
import router from './router'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-icons/font/bootstrap-icons.css'

window.axios = axios

window.axios.defaults.baseURL = 'http://localhost:8000/'
window.axios.defaults.headers.common['Acept'] = 'application/json'
window.axios.defaults.headers.common['Content-Type'] = 'application/json'
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.withCredentials = true

const pinia = createPinia()
pinia.use(({store}) => {
    store.router = markRaw(router)
})
pinia.use(createPersistedState)

const app = createApp(App)

app.use(pinia)
app.use(router)

app.mount('#app')

import 'bootstrap/dist/js/bootstrap.js'
