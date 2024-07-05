<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h4>Bienvenido/a</h4>
                <b>Usuario </b> {{ authStore.user.name }} - {{ authStore.user.email }}
            </div>
        </div>
    </div>
</template>

<script setup>
    import { useAuthStore } from '@/stores/auth';

    const authStore = useAuthStore();
</script>
