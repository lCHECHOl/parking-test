<template>
    <v-container class="login d-flex align-center">
        <v-row justify="center">
            <v-col cols="12" md="6" class="image-login hidden-sm-and-down">
            </v-col>
            <v-col cols="12" md="6">
                <login-form />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import LoginForm from "@/layouts/components/header/LoginPopover";

export default {
    name: "Login",
    components: {
        LoginForm,
    },
    data: () => ({
        //
    }),
};
</script>

<style>
.login {
    height: 100%;
}

.image-login {
    background: url("/images/_DSC3628.jpg") no-repeat top center;
    background-size: cover;
}
</style>