<!-- =========================================================================================
    File Name: Main.vue
    Description: Main layout
    ----------------------------------------------------------------------------------------
    Item Name: parqueadero
    Author: Sergio Benavides
========================================================================================== -->

<template>
    <div>
        <main-header />
        <main-content />
        <main-footer />
    </div>
</template>

<script>
import MainHeader from "@/layouts/components/header/Index";
import MainContent from "@/layouts/components/content/Index";
import MainFooter from "@/layouts/components/footer/Index"

export default {
    name: "Main",
    components: {
        MainHeader,
        MainContent,
        MainFooter
    },
    data: () => ({
        //
    }),
};
</script>