<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <RouterLink class="navbar-brand" aria-current="page" to="/">Mantenedor</RouterLink>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" v-if="authStore.user">
                    <li class="nav-item">
                        <RouterLink class="nav-link" aria-current="page" to="/" activeClass="active" exactActiveClass="border-indigo-700">Inicio</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" aria-current="page" to="/dashboard">Usuarios</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" aria-current="page" to="/contact">Contacto</RouterLink>
                    </li>
                </ul>

                <div class="dropdown" v-if="authStore.user">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ authStore.user.email }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="">
                        <li><RouterLink class="dropdown-item" aria-current="page" to="/user-profile">Perfil</RouterLink></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button class="dropdown-item" @click="authStore.logout">Cerrar sesión</button></li>
                    </ul>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end" v-else>
                    <RouterLink class="btn btn-outline-primary text-white" aria-current="page" to="/login">Iniciar Sesión</RouterLink>
                    <RouterLink class="btn btn-outline-light" aria-current="page" to="/register">Registrarme</RouterLink>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { useAuthStore } from '../stores/auth'

    const authStore = useAuthStore();

</script>
