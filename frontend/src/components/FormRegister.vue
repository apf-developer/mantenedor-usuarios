<template>


    <form @submit.prevent="authStore.register(form)">
        <FieldsNameEmail :form="form" />
        <FieldsPassword :form="form" />

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-success">Guardar</button>
            <router-link v-if="!authStore.user" class="btn btn-light" to="/">Iniciar Sesión</router-link>
        </div>
    </form>
</template>

<script setup>
    import { ref } from 'vue';
    import { useAuthStore } from '../stores/auth';
    import FieldsNameEmail from '../components/FieldsNameEmail.vue';
    import FieldsPassword from '../components/FieldsPassword.vue';

    const authStore = useAuthStore();
    const form = ref({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    });

</script>
