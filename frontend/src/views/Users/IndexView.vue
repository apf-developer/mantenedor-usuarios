<template>
    <div>
        <div class="mb-3 mt-3">
            <router-link class="btn btn-success" aria-current="page" to="/create">
                <i class="bi bi-person-plus m-2"></i>
                Crear usuarios
            </router-link>
        </div>

        <div class="info">
            <section v-if="errored">
                <p>Lo sentimos, no es posible obtener la información en este momento, por favor intente nuevamente mas tarde...</p>
            </section>

            <section v-else-if="loading">
                <h4>Cargando...</h4>
            </section>

            <section v-else>

                <table class="table table-hover table-bordered">
                    <thead class="">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr v-for="user in listUser" :key="user.id">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <div v-if="user.id != authStore.user.id">
                                    <router-link :to="{path:'edit/'+user.id}" class="btn btn-primary">
                                        <i class="bi bi-pencil text-white"></i>
                                        <span class="p-1 text-white">Editar</span>
                                    </router-link>
                                    <button class="btn btn-danger m-1" v-on:click="destroy(user.id, user.name)">
                                        <i class="bi bi-person-x-fill"></i>
                                        <span class="p-2">Eliminar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </section>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';
    import { confirmed } from '../../functions';
    import { useAuthStore } from '../../stores/auth';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + authStore.authToken;

    //Trae la lista de usuarios despues de montar el componente
    onMounted(() => {
        getUsers();
    });

    //Definimos variables dinamicas
    const listUser = ref(null);
    const loading = ref(true);
    const errored = ref(false);

    //Funciones para obtener y eliminar usuarios
    const getUsers = async () => {
        await axios.get('/api/users')
        .then(response => listUser.value = response.data.users)
        .catch(error => errored.value = true)
        .finally(() => loading.value = false)
    }

    const destroy = (id, name) => {
        confirmed(id, name);
    }

</script>