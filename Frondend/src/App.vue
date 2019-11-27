<template>
    <v-app id="app">
        <app-navigation></app-navigation>

        <v-content transition="slide-x-transition">
            <router-view></router-view>
            <loader></loader>
        </v-content>
        
    </v-app>
</template>

<script>
import AppNavigation from '@/components/AppNavigation';
import Loader from '@/components/Loader'
export default {
    name: 'App',
    data(){
        return{
            loader:true
        }
    },
    created(){
    },
    components: {
        AppNavigation,
        Loader
    }
};
</script>

<style></style>
