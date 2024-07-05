<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <b style="text-transform: uppercase;">Editar datos</b>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateNameEmail">
                        
                        <FieldsNameEmail :form="formFieldsNameEmail" />

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <b style="text-transform: uppercase;">Editar clave</b>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updatePassword">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="current_password" id="current_password" placeholder="" v-model="formFieldsPassword.current_password">
                            <label for="current_password" class="form-label">Contraseña actual</label>
                        </div>
                        
                        <FieldsPassword :form="formFieldsPassword" />

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useAuthStore } from '../../stores/auth'
    import { sendRequest } from '@/functions';
    import FieldsNameEmail from '@/components/FieldsNameEmail.vue';
    import FieldsPassword from '@/components/FieldsPassword.vue';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + authStore.authToken;
    
    //Definimos variables dinamicas
    const id            = authStore.user.id
    const formFieldsNameEmail = ref({ name: '', email: '' });
    const formFieldsPassword  = ref({ current_password: '', password: '', password_confirmation: '' });

    //Trae la lista de usuarios despues de montar el componente
    onMounted(() => {
        getUser()
    });

    //Funciones para obtener y actualizar datos del perfil de usuario
    const getUser = async () => {
        await axios.get('/api/users/show/'+id).then(response => {
            formFieldsNameEmail.value.name  = response.data.user.name
            formFieldsNameEmail.value.email = response.data.user.email
        });
    }

    const updateNameEmail = () => {
        sendRequest('PATCH', formFieldsNameEmail.value, '/api/users/profile/update', '/user-profile');
    }
    
    const updatePassword = () => {
        sendRequest('PATCH', formFieldsPassword.value, '/api/users/profile/update/password', '/user-profile');
    }

</script>
