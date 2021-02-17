<template>
    <v-container>
        <v-row>
            <v-col>
                <p v-if="$store.state.auth.auth" class="text-h4">Bienvenido {{ $store.state.auth.user.name }}</p>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "home"
};
</script>

<style>
</style>