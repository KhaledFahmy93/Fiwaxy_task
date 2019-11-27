<template>
    <v-container fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-alert
                    :value="isValidLogin"
                    type="error"
                    >
                     Invalid email and/or password.
                </v-alert>
                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Join Form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form ref="form" v-model="valid" lazy-validation>
                            <v-text-field
                                prepend-icon="person"
                                name="email"
                                label="Email"
                                type="email"
                                v-model="email"
                                :rules="emailRules"
                                data-cy="joinEmailField"
                                required
                            >
                            </v-text-field>
                            <v-text-field
                                prepend-icon="lock"
                                name="password"
                                label="Password"
                                type="password"
                                required
                                v-model="password"
                                :rules="passwordRules"
                                data-cy="joinPasswordField"
                            >
                            </v-text-field>
                          
                            <v-radio-group v-model="user_type" column  :rules="userTypeRules">
                                <v-radio label="customer" value="customer" ></v-radio>
                                <v-radio label="repairman" value="repairman"></v-radio>
                            </v-radio-group>
       
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary"
                            :disabled="!valid"
                            @click="submit"
                            data-cy="joinSubmitBtn"
                            >Join</v-btn
                        >
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    name: 'Join',
    created(){
    },
    data() {
        return {
            valid: false,
            email: '',
            password: '',
            user_type :"",
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            passwordRules: [
                v => !!v || 'Password is required',
                v =>
                    v.length >= 6 ||
                    'Password must be greater than 6 characters'
            ],
            userTypeRules:[
                v => !!v || 'Type is required',
            ]
        };
    },
    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                this.$store.dispatch('userJoin', {
                    email: this.email,
                    password: this.password,
                    user_type : this.user_type
                });
            }
        }
    },
     computed: {
        isValidLogin(){
            return this.$store.getters.getLoginError;
        }
    }
};
</script>

<style scoped></style>
