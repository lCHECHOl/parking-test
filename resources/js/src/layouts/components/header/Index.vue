<template>
    <header>
        <v-nav-menu />
        <h-nav-menu />
    </header>
</template>

<script>
import HNavMenu from "@/layouts/components/header/navbar/horizontal-nav-menu/HorizontalNavMenu.vue";
import VNavMenu from "@/layouts/components/header/sidebar/vertical-nav-menu/VerticalNavMenu.vue";
export default {
    name: "MainHeader",
    components: {
        HNavMenu,
        VNavMenu,
    },
};
</script>

<style>
</style>