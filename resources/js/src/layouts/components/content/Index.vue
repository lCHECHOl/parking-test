<template>
    <v-main class="main-content">
        <!-- <success-message></success-message> -->
        <v-fade-transition>
            <router-view />
        </v-fade-transition>
    </v-main>
</template>

<script>
export default {};
</script>

<style>
.main-content {
    height: 100%;
    width: 100%;
    position: absolute;
    background: url( '/images/_DSC3680.jpg') no-repeat top center;
    background-size: cover;
    /* background-color: red; */
}
</style>