<template>
    <div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="" v-model="form.password">
            <label for="password" class="form-label">Contraseña</label>
            <div id="passwordHelp" class="form-text text-muted">La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula, un número y un símbolo.</div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="" v-model="form.password_confirmation">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        form: Object
    });
</script>