<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <b style="text-transform: uppercase;">Editar usuario</b>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateNameEmail">
                        
                        <FieldsNameEmail :form="form" />

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-success">Guardar cambios</button>
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
    import { useRoute } from 'vue-router';
    import { sendRequest } from '@/functions';
    import { useAuthStore } from '../../stores/auth'
    import FieldsNameEmail from '@/components/FieldsNameEmail.vue';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + authStore.authToken;
    
    //Definimos variables dinamicas
    const route = useRoute();
    const id    = ref(route.params.id);
    const form  = ref({name: '', email: ''});

    onMounted(() => {
        getUser()
    });

    //Funciones para obtener y actualizar los datos del usuario
    const getUser = async () => {
        await axios.get('/api/users/show/'+id.value).then(response => {
            form.value.name  = response.data.user.name
            form.value.email = response.data.user.email
        });
    }

    const updateNameEmail = () => {
        sendRequest('PATCH', form.value, '/api/users/update/'+id.value, '/dashboard');
    }
    
</script>
