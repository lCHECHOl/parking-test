<template>
    <v-menu

        rounded="b-xl"
        :offset-y="true"
        :close-on-content-click="item.popover == true ? false : true"
    >
        <template v-slot:activator="{ on: menu, attrs }">
            <v-tooltip bottom>
                <template v-slot:activator="{ on: tooltip }">
                    <v-btn
                        height="100px"
                        color="white"
                        text
                        :to="item.path"
                        v-bind="attrs"
                        v-on="$vuetify.breakpoint.mdAndDown ? {...tooltip, ...menu} : {...menu}"
                    >
                        <v-icon class="mr-3">{{ isAuthIcon }}</v-icon>
                        <span v-text="isAuthTitle" class="hidden-md-and-down"></span>
                    </v-btn>
                </template>
                <span v-text="isAuthTooltip"></span>
            </v-tooltip>
        </template>

        <v-card color="transparent">
            <v-list color="rgba(148, 148, 148, .90)" v-if="item.childrens.length > 0">
                <v-list-item v-for="(childItem, j) in item.childrens" :key="j" :to="childItem.path">
                    <v-list-item-title>
                        <v-icon class="mr-2">{{ childItem.icon }}</v-icon>
                        {{ childItem.title }}
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-card>
        <div v-if="item.popover == true">
            <login-popover v-if="!isAuthPopover" />
            <user-popover v-else />
        </div>
    </v-menu>
</template>

<script>
import LoginPopover from "@/layouts/components/header/LoginPopover";
import UserPopover from "@/layouts/components/header/UserPopover";

export default {
    name: "HorizontalNavMenuItem",
    components: {
        LoginPopover,
        UserPopover,
    },
    props: {
        item: { type: Object, required: true },
    },
    data: () => ({
        childrens: false,
    }),
    computed: {
        hasChildrens() {
            if (this.$vuetify.breakpoint.mdAndDown) {
                return (this.childrens = false);
            }

            if (this.$vuetify.breakpoint.lgAndUp) {
                return (this.childrens = true);
            }
        },
        isAuthIcon() {
            return this.item.component == "Login" &&
                this.$store.state.auth.auth == true
                ? "fas fa-user"
                : this.item.icon;
        },
        isAuthTitle() {
            return this.item.component == "Login" &&
                this.$store.state.auth.auth == true
                ? this.$store.state.auth.user.name
                : this.item.title;
        },
        isAuthTooltip() {
            return this.item.component == "Login" &&
                this.$store.state.auth.auth == true
                ? "Perfil - " + this.$store.state.auth.user.name
                : this.item.title;
        },
        isAuthPopover() {
            return (
                this.item.component == "Login" &&
                this.$store.state.auth.auth == true
            );
        },
    },
};
</script>

<style>
</style>