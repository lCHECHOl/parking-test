<template>
    <v-snackbar
        v-model="$store.state.auth.success"
        :bottom="y === 'bottom'"
        :color="color"
        :left="x === 'left'"
        :multi-line="mode === 'multi-line'"
        :right="x === 'right'"
        :timeout="timeout"
        :top="y === 'top'"
        :vertical="mode === 'vertical'"
    >
        {{ $store.state.auth.successMessage }}
        <template v-slot:action="{ attrs }">
            <v-btn dark text v-bind="attrs" icon @click="closeMessage"><v-icon>far fa-times-circle</v-icon></v-btn>
        </template>
    </v-snackbar>
</template>

<script>
export default {
    name: "SuccessMessage",
    data: () => ({
        color: "success",
        mode: "",
        timeout: 6000,
        x: null,
        y: "top",
    }),
    methods: {
        closeMessage() {
            return this.$store.commit("auth/SET_SUCCESS_STATUS", false)
        }
    }
};
</script>

<style>
</style>