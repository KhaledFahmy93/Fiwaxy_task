<template>
    <span>
        <v-navigation-drawer
            app
            v-model="drawer"
            class="indigo"
            dark
            disable-resize-watcher
        >
        <v-list>
                <template v-for="(item, index) in items">
                    <v-list-tile :key="index" :to="item.url">
                        <v-list-tile-content>
                            {{ item.title }}
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-divider :key="`divider-${index}`"></v-divider>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app color="indigo" dark>
             <v-toolbar-side-icon @click.stop="drawer = !drawer" dark></v-toolbar-side-icon>
            <v-toolbar-side-icon
                class="hidden-md-and-up"
                @click="drawer = !drawer"
            ></v-toolbar-side-icon>
            <router-link to="/">
                <v-toolbar-title data-cy="titleBtn">{{
                    appTitle
                }}</v-toolbar-title>
            </router-link>
            <v-btn v-if="isAuthenticated"
                flat
                class="hidden-sm-and-down nav-menu"
                to="/orders"
                data-cy="menuBtn"
                >Orders</v-btn
            >
            <v-btn v-if="isAuthenticated"
                flat
                class="hidden-sm-and-down nav-menu"
                to="/services"
                data-cy="menuBtn"
                >Services</v-btn
            >

            <v-spacer class="hidden-sm-and-down"></v-spacer>
            <div v-if="!isAuthenticated" class="hidden-sm-and-down">
                <v-btn flat class="hidden-sm-and-down nav-menu" to="/sign-in" data-cy="signinBtn">sign in</v-btn>   
                <v-btn
                    flat
                    class="hidden-sm-and-down nav-menu"
                    to="/join"
                    data-cy="joinBtn"
                    >Sign up</v-btn
                >
            </div>
            <div v-else>
                <v-btn flat to="/about">PROFILE</v-btn>
                <v-btn outline color="white" @click="logout" data-cy="logout"
                    >Logout</v-btn
                >
            </div>
        </v-toolbar>
    </span>
</template>

<script>
export default {
    name: 'AppNavigation',
    data() {
        return {
            appTitle: 'Fixawy',
            drawer: false,
            items: [
                { title: 'Profile', url: '/about' },
                { title: 'Sign In', url: '/sign-in' },
                { title: 'Sign up', url: '/join'},
                { title: 'orders', url: '/orders' },
                 { title: 'services', url: '/services' },
            ]
        };
    },
    computed: {
        isAuthenticated() { 
            return this.$store.getters.isAuthenticated;
        },
        isCustomer() {
            return this.$store.getters.isCustomer;
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('userSignOut');
        }
    }
};
</script>

<style scoped>
a {
    color: white;
    text-decoration: none;
}
</style>
