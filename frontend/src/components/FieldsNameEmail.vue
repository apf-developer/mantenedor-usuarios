<template>
    <div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="name" placeholder="NombreUsuario" v-model="form.name">
            <label for="name">Nombre</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="nombre@example.cl" v-model="form.email">
            <label for="email">Correo electrónico</label>
            <div id="emailHelp" class="form-text">Ej. nombre@example.cl</div>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        form: Object
    })
</script>