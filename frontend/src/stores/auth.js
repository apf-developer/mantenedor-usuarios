import { show_alert } from "@/functions";
import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({ authUser: null, authToken: null }),
    getters: {
        user: (state) => state.authUser,
        token: (state) => state-authToken,
    },
    actions: {
        async getToken()
        {
            await axios.get('/sanctum/csrf-cookie');
        },
        async login(form)
        {
            await this.getToken();
            await axios.post('/api/login', form).then(
                (response) => {
                    this.authToken = response.data.token;
                    this.authUser = response.data.userData;
                    this.router.push('/dashboard');
                }
            ).catch(
                (errors) => {
                    let obj  = errors.response.data.errors
                    let desc = ''

                    for (const prop in obj) {
                        desc = desc + '<br>' + obj[prop][0]
                    }

                    show_alert('Error!', 'error', desc);
                }
            )
        },
        async register(form)
        {
            await this.getToken();
            await axios.post('/api/register', form).then(
                (response) => {
                    show_alert('Exitoso', 'success', response.data.msg);
                    setTimeout(() => this.router.push('/login'), 1000);
                }
            ).catch(
                (errors) => {
                    let obj  = errors.response.data.errors;
                    let desc = ''

                    for (const prop in obj) {
                        desc = desc + '<br>' + obj[prop][0]
                    }

                    show_alert('Error!', 'error', desc);
                }
            )
        },
        async logout()
        {
            await axios.post('/api/logout', this.authToken);
            this.authToken = null;
            this.authUser = null;
            this.router.push('/login');
        }
    },
    persist: true //Ayuda a mantener la sesion cuando refrescamos el navegador
})