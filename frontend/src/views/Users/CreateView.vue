<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <b style="text-transform: uppercase;">Crear usuario</b>
                </div>
                <div class="card-body">
                    <FormRegister />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useAuthStore } from '../../stores/auth';
    import FormRegister from '../../components/FormRegister.vue';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + authStore.authToken;
</script>
