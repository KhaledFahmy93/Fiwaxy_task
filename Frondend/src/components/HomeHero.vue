<template>
    <v-container fluid fill-height class="home-hero" style="max-height: 100vh;">
        <v-layout justify-center align-center column pa-5>
            <div class="display-4 font-weight-black white--text text-xs-center">
               help You 
            </div>
            <div
                class="display-4 font-weight-black white--text text-xs-center mb-3"
            >
                Fix anything
            </div>
            <div class="display-1 font-weight-bold white--text text-xs-center">
               Fixawy helps people repair their homes by providing them with skilled repairmen to install
                and maintain all necessary fixtures.
            </div>
            <v-btn fab class="mt-5 brown darken-4">
                <v-icon large color="white">expand_more</v-icon>
            </v-btn>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    name: 'HomeHero'
};
</script>

<style scoped>
.home-hero {
    background: url('https://source.unsplash.com/user/erondu');
    background-size: cover;
    width: 100%;
    height: 100%;
}
</style>
