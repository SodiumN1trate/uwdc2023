import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

let token = localStorage.getItem('token')

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'local',
    wsHost: import.meta.env.VITE_WEBSOCKETS_SERVER,
    encrypted: false,
    wsPort: 6001,
    cluster: 'mt1',
    enable_client_messages: true,
    forceTLS: false,
    disableStats: true,
    authEndpoint: import.meta.env.VITE_API_ADDRESS + '/broadcasting/auth',
    auth: {
        headers: {
            Authorization: 'Bearer ' + token
        }
    }
});

const app = createApp(App)

axios.defaults.baseURL = import.meta.env.VITE_API_ADDRESS
axios.defaults.headers = {
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + token
}
app.use(router)
app.use(VueAxios, axios)

app.mount('#app')
