<template>
    <span>
        <v-navigation-drawer
            app
            v-model="drawer"
            class="brown lighten-2"
            dark
            disable-resize-watcher
        >
        </v-navigation-drawer>
        <v-toolbar app color="brown darken-4" dark>
            <v-toolbar-side-icon
                class="hidden-md-and-up"
                @click="drawer = !drawer"
            ></v-toolbar-side-icon>
            <router-link to="/">
                <v-toolbar-title data-cy="titleBtn">{{
                    appTitle
                }}</v-toolbar-title>
            </router-link>
            <v-btn
                flat
                class="hidden-sm-and-down nav-menu"
                to="/menu"
                data-cy="menuBtn"
                >Menu</v-btn
            >
            <v-btn v-if="isAuthenticated&&isCustomer"
                flat
                class="hidden-sm-and-down nav-menu"
                to="/createorder"
                data-cy="menuBtn"
                >Create Order</v-btn
            >
             <v-btn v-if="isAuthenticated"
                flat
                class="hidden-sm-and-down nav-menu"
                to="/orders"
                data-cy="menuBtn"
                >Orders</v-btn
            >

            <v-spacer class="hidden-sm-and-down"></v-spacer>
            <div v-if="!isAuthenticated" class="hidden-sm-and-down">
                <v-btn flat to="/sign-in" data-cy="signinBtn">sign in</v-btn>   
                <v-btn
                    color="brown lighten-3"
                    to="/join"
                    class="nav-join"
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
                { title: 'Menu', url: '/menu' },
                { title: 'Profile', url: '/about' },
                { title: 'Sign In', url: '/sign-in' },
                { title: 'Join', url: '/join' },
                { title: 'createorder', url: '/createorder' },
                { title: 'orders', url: '/orders' }
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
