<template>
    <v-card>
        <v-overlay :absolute="isAuth" :value="isAuth">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
        <v-list>
            <v-list-item class="d-flex justify-center">
                <v-list-item-avatar>
                    <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>{{ $store.state.auth.user.name }}</v-list-item-title>
                    <v-list-item-subtitle>{{ $store.state.auth.user.email }} - Admin</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-card-actions class="d-flex justify-center">
            <v-btn color="primary" text>Mi Perfil</v-btn>
            <v-btn text @click="logout">Cerrar Sesión</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    data: () => ({
        fav: true,
        menu: false,
        message: false,
        hints: true,
    }),
    methods: {
        logout() {
            this.$store.dispatch("auth/logout");
            if (this.$router.currentRoute.path != "/") {
                return this.$router.replace("/");
            }
        },
    },
    computed: {
        isAuth() {
            return this.$store.state.loading;
        },
    },
};
</script>

<style>
</style>