<template>
    <v-container class="login d-flex align-center">
        <v-row justify="center">
            <v-col cols="12" md="6" class="image-login">
                <ValidationObserver ref="form" v-slot="{ invalid, validated, passes }">
                    <v-card>
                        <v-overlay :absolute="isAuth" :value="isAuth">
                            <v-progress-circular indeterminate size="64"></v-progress-circular>
                        </v-overlay>
                        <v-list>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title
                                        class="text-center"
                                    >{{ $store.state.appTitle }}</v-list-item-title>
                                    <v-list-item-subtitle class="text-center">¡Registrate Gratis!</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-form>
                                        <ValidationProvider
                                            vid="document"
                                            name="DOCUMENTO"
                                            rules="required|max:10"
                                            v-slot="{ errors, valid }"
                                        >
                                            <v-text-field
                                                outlined
                                                rounded
                                                dense
                                                label="DOCUMENTO"
                                                v-model="form.document"
                                                :error-messages="errors"
                                                :success="valid"
                                                :disabled="$store.state.loading"
                                            ></v-text-field>
                                        </ValidationProvider>
                                        <ValidationProvider
                                            vid="name"
                                            name="NOMBRE COMPLETO"
                                            rules="required"
                                            v-slot="{ errors, valid }"
                                        >
                                            <v-text-field
                                                outlined
                                                rounded
                                                dense
                                                label="NOMBRE COMPLETO"
                                                v-model="form.name"
                                                :error-messages="errors"
                                                :success="valid"
                                                :disabled="$store.state.loading"
                                            ></v-text-field>
                                        </ValidationProvider>
                                        <ValidationProvider
                                            vid="email"
                                            name="CORREO ELECTRONICO"
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
                                        <ValidationProvider
                                            vid="password_confirmation"
                                            name="CONFIRMAR CONTRASEÑA"
                                            rules="required|min:8|confirmed:password"
                                            v-slot="{ errors, valid }"
                                        >
                                            <v-text-field
                                                outlined
                                                rounded
                                                dense
                                                label="CONFIRMAR CONTRASEÑA"
                                                v-model="form.password_confirmation"
                                                :append-icon="show_confirm ? 'fas fa-eye' : 'fas fa-eye-slash'"
                                                :type="show_confirm ? 'text' : 'password'"
                                                :counter="8"
                                                @click:append="show_confirm = !show_confirm"
                                                :error-messages="errors"
                                                :success="valid"
                                                :disabled="$store.state.loading"
                                            ></v-text-field>
                                        </ValidationProvider>
                                    </v-form>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>

                        <v-divider></v-divider>

                        <v-card-actions class="d-flex justify-center">
                            <v-btn to="/" color="primary" text>Cancelar</v-btn>
                            <v-btn
                                :disabled="invalid || !validated"
                                @click="passes(register)"
                                color="primary"
                                text
                            >Registrate</v-btn>
                        </v-card-actions>
                    </v-card>
                </ValidationObserver>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Register",
    data: () => ({
        show: false,
        show_confirm: false,
        form: {
            document: "",
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
        },
    }),
    methods: {
        async register() {
            const response = await this.$store.dispatch("auth/register", this.form);
            if (response.status == 422) {
                this.$refs.form.setErrors(response.data.errors);
                return;
            }
            return this.$router.replace("/");
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
.login {
    height: 100%;
}
.imagen-login {
    background: burlywood;
}
</style>