<template>
    <v-app-bar
        v-if="!this.$store.state.sidebar"
        app
        flat
        color="rgba(148, 148, 148, 0.50)"
        height="100px"
    >
        <v-container class="mx-auto py-0">
            <v-row align="center">
                <v-col cols="2">
                    <v-row justify="center">
                        <v-app-bar-nav-icon class="hidden-sm-and-up" @click="showSideBar" />
                        <v-img
                            src="/images/logo.png"
                            class="hidden-xs-only"
                            contain
                            max-height="70px"
                            max-width="70px"
                        />
                    </v-row>
                </v-col>
                <v-col cols="10" class="hidden-sm-and-up">
                    <v-row justify="center">
                        <v-toolbar-title>
                            <router-link
                                to="/"
                                tag="span"
                                style="cursor: pointer"
                            >{{ this.$store.state.appTitle }}</router-link>
                        </v-toolbar-title>
                    </v-row>
                </v-col>
                <v-col cols="10" class="hidden-xs-only">
                    <v-row justify="space-between">
                        <HorizontalNavMenuItem
                            v-for="(item, i) in navMenuItems"
                            :key="i"
                            :item="item"
                        />
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </v-app-bar>
</template>

<script>
import HorizontalNavMenuItem from "./HorizontalNavMenuItem";
import navMenuItems from "./../../navMenuItems";

export default {
    name: "HNavMenu",
    components: {
        HorizontalNavMenuItem,
        navMenuItems,
    },
    data: () => ({
        navMenuItems: navMenuItems,
    }),
    methods: {
        showSideBar() {
            this.$store.commit("CHANGE_SIDEBAR_STATUS", true);
        },
    },
};
</script>

<style>
</style>