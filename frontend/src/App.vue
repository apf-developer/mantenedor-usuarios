<script setup>
    import { RouterView } from 'vue-router'
    import Nav from './components/Nav.vue';
</script>

<template>
    <Nav></Nav>

    <div class="container mt-3">
        <RouterView />
    </div>
</template>