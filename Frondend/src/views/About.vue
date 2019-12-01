<template>
    <v-container>
        <v-layout column>
            <h1 class="title my-3">Name : {{ this.getAuthenticatedUser.name }} </h1>
            <h1 class="title my-3">Email : {{ this.getAuthenticatedUser.email }} </h1>
            <h1 class="title my-3">User Type : {{ this.getAuthenticatedUser.user_type}}</h1>
            <v-flex mt-4>
                <v-btn color="primary" to="/orders">Go To orders</v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    name: 'About',
    computed: {
         getAuthenticatedUser() { 
            return this.$store.getters.getAuthenticatedUser;
        },
    },
    mounted() {
	console.log(this.getAuthenticatedUser);
    },
    methods: {
    }
};
</script>

<style scoped></style>
