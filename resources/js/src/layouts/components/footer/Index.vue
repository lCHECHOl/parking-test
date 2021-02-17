<template>
    <v-footer color="rgba(148, 148, 148, 0.50)" padless absolute class="mt-5">
        <v-row align="center" justify="center" no-gutters class="py-3">
            <v-col class="rgba(148, 148, 148, 0.50) py-4 text-center black--text" cols="12">
                {{ new Date().getFullYear() }} —
                <strong>{{ appTitle }}</strong>
            </v-col>
        </v-row>
    </v-footer>
</template>

<script>
export default {
    name: "page-footer",
    data: () => ({
        appTitle: process.env.MIX_APP_NAME
    })
};
</script>

<style>
</style>