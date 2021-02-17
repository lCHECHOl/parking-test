<template>
    <ValidationObserver ref="form" v-slot="{ invalid, validated, passes }">
        <v-dialog v-model="$store.state.auth.modalPassword" max-width="50%">
            <v-card>
                <v-card-title class="headline"></v-card-title>
                <v-list>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="text-center">¿Olvidaste tú contraseña?</v-list-item-title>
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
                                        v-model="formForgotPassword.email"
                                        :error-messages="errors"
                                        :success="valid"
                                        :loading="$store.state.auth.modalLoading"
                                        :disabled="$store.state.auth.modalLoading"
                                    ></v-text-field>
                                </ValidationProvider>
                            </v-form>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <v-divider></v-divider>
                <v-card-actions class="d-flex justify-center">
                    <v-btn
                        :disabled="$store.state.auth.modalLoading"
                        color="grey darken-1"
                        text
                        @click="hideModal"
                    >Cerrar</v-btn>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="passes(forgotPassword)"
                        :disabled="invalid || !validated || $store.state.auth.modalLoading"
                        :loading="$store.state.auth.modalLoading"
                    >Validar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </ValidationObserver>
</template>

<script>
export default {
    name: "ModalForgotPassword",
    data: () => ({
        formForgotPassword: {
            email: "",
        },
    }),
    methods: {
        async forgotPassword() {
            const response = await this.$store.dispatch(
                "auth/forgotPassword",
                this.formForgotPassword
            );
            if (response.status == 422) {
                this.$refs.form.setErrors(response.data.errors);
                return;
            }
        },
        hideModal() {
            this.$store.dispatch("auth/showModalPassword", false);
        },
    },
};
</script>

<style>
</style>