import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/' // Backend URL
// axios.defaults.headers.common['Content-Type'] = 'application/json'
const token = localStorage.getItem('token')
if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

const app = createApp(App)

app.use(router)

app.mount('#app')
