<template>
    <div>
        <ValidationObserver ref="form" v-slot="{ invalid, validated, passes }">
            <v-card>
                <v-overlay :absolute="isAuth" :value="isAuth">
                    <v-progress-circular indeterminate size="64"></v-progress-circular>
                </v-overlay>
                <v-list>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="text-center">{{ $store.state.appTitle }}</v-list-item-title>
                            <v-list-item-subtitle class="text-center">Iniciar sesión</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            <v-form>
                                <ValidationProvider
                                    vid="email"
                                    name="CORREO ELECTRONICO"
                                    rules="required|email"
                                    v-slot="{ errors, valid }"
                                >
                                    <v-text-field
                                        outlined
                                        rounded
                                        dense
                                        label="CORREO ELECTRONICO"
                                        v-model="form.email"
                                        :error-messages="errors"
                                        :success="valid"
                                        :disabled="$store.state.loading"
                                    ></v-text-field>
                                </ValidationProvider>
                                <ValidationProvider
                                    vid="password"
                                    name="CONTRASEÑA"
                                    rules="required|min:8"
                                    v-slot="{ errors, valid }"
                                >
                                    <v-text-field
                                        outlined
                                        rounded
                                        dense
                                        label="CONTRASEÑA"
                                        v-model="form.password"
                                        :append-icon="show ? 'fas fa-eye' : 'fas fa-eye-slash'"
                                        :type="show ? 'text' : 'password'"
                                        :counter="8"
                                        @click:append="show = !show"
                                        :error-messages="errors"
                                        :success="valid"
                                        :disabled="$store.state.loading"
                                    ></v-text-field>
                                </ValidationProvider>
                                <div class="d-flex align-center justify-center">
                                    <v-checkbox
                                        v-model="form.remember"
                                        label="Rercuerdame"
                                        value="true"
                                        :disabled="$store.state.loading"
                                    ></v-checkbox>
                                    <v-btn
                                        class="ml-1"
                                        :disabled="$store.state.loading"
                                        text
                                        small
                                        @click.stop="showModalPassword"
                                    >¿Olvidaste tú contraseña?</v-btn>
                                </div>
                            </v-form>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-divider></v-divider>

                <v-card-actions class="d-flex justify-center">
                    <v-btn to="/registro" color="primary" text>¡Registrate Gratis!</v-btn>
                    <v-btn
                        :disabled="invalid || !validated"
                        @click="passes(login)"
                        color="primary"
                        text
                    >Login</v-btn>
                </v-card-actions>
            </v-card>
        </ValidationObserver>
        <modal-forgot-password />
    </div>
</template>

<script>
import ModalForgotPassword from "@/components/ModalForgotPassword";

export default {
    name: "LoginForm",
    components: {
        ModalForgotPassword,
    },
    data: () => ({
        show: false,
        form: {
            email: "",
            password: "",
            remember: false,
        },
    }),
    methods: {
        async login() {
            const response = await this.$store.dispatch(
                "auth/login",
                this.form
            );
            if (response.status == 422) {
                this.$refs.form.setErrors(response.data.errors);
                return;
            }
            if (this.$router.currentRoute.path == "/login") {
                return this.$router.replace("/");
            }
        },
        showModalPassword() {
            this.$store.dispatch("auth/showModalPassword", true);
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