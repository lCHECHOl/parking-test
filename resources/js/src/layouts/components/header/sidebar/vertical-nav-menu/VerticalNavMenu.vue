<template>
    <v-navigation-drawer app v-model="$store.state.sidebar" absolute dark>

        <v-overlay :absolute="isAuth" :value="isAuth">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>

        <v-list dense nav class="py-0">
            <v-list-item v-if="$store.state.auth.auth" two-line>
                <v-list-item-avatar>
                    <img src="https://randomuser.me/api/portraits/men/81.jpg" />
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>{{ $store.state.auth.user.name }}</v-list-item-title>
                    <v-list-item-subtitle>{{ $store.state.auth.user.email }} - Ciclista</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
            <v-list-item v-else>
                <v-list-item-content>
                    <v-list-item-title class="text-center">{{ $store.state.appTitle }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list-group prepend-icon="fas fa-door-open" no-action v-if="!$store.state.auth.auth">
                <template v-slot:activator>
                    <v-list-item-content>
                        <v-list-item-title>Login / Registro</v-list-item-title>
                    </v-list-item-content>
                </template>

                <v-list-item to="/login">
                    <v-list-item-content>
                        <v-list-item-title>
                            <v-icon small class="mr-1">fas fa-unlock-alt</v-icon>Inicia Sesión
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item to="/registro">
                    <v-list-item-content>
                        <v-list-item-title>
                            <v-icon small class="mr-1">fas fa-bicycle</v-icon>Registrate
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-group>

            <v-list-item v-else @click="logout">
                <v-list-item-icon>
                    <v-icon>fas fa-sign-out-alt</v-icon>
                </v-list-item-icon>

                <v-list-item-title>Cerrar Sesión</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import VerticalNavMenuItem from "./VerticalNavMenuItem";
import navMenuItems from "./../../navMenuItems";

export default {
    name: "VNavMenu",
    components: {
        VerticalNavMenuItem,
        navMenuItems,
    },
    data: () => ({
        navMenuItems: navMenuItems,
    }),
    methods: {
        hasChildrens() {
            return item.childrens.length > 0;
        },
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