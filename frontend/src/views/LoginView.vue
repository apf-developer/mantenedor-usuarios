<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
            <div class="card-header">
                <b style="text-transform: uppercase;">Iniciar sesión</b>
            </div>
            <div class="card-body">
                <form @submit.prevent="authStore.login(form)">
                    <div class="card mb-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Usuario prueba</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Email: admin@prueba.cl</h6>
                            <h6 class="card-subtitle mb-2 text-muted">Clave: Usuario.admin1</h6>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="nombre@example.cl" autofocus v-model="form.email">
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="" v-model="form.password">
                        <label for="password" class="form-label">Clave</label>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Acceder</button>
                        <router-link to="/register" class="btn btn-light">Registrarme</router-link>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useAuthStore } from '../stores/auth';

    const authStore = useAuthStore();
    const form      = ref({ email: '', password: ''});
</script>
