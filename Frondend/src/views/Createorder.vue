<template>
    <v-container class="grey lighten-5">
        <v-layout >
            <v-flex>
                <v-card class="elevation-110">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>create Order</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form ref="form" >
                             <v-select
                                v-model="selectedArea"
                                :items="areas"
                                item-text="name"
                                label="Area"
                                required
                            ></v-select>

                            <v-text-field
                                v-model="description"
                                label="description"
                                required
                            ></v-text-field>

                             <v-text-field
                                v-model="numservices"
                                label="Number Of services"
                                required
                            ></v-text-field>   
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="submit"
                            >create Order</v-btn
                        >
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import axios from 'axios';
import router from '@/router';
export default {
    name: 'createorder',
    data() {
        return {
            areas:null,
            description:"",
            selectedArea:"",
            numservices:null
        };
    },
    methods: {
        submit() {
            axios.post("http://localhost:8000/api/createorder",{
                "description" : this.description,
                "numservices" : this.numservices,
                "area_id" : 1,
                "customer_id" : this.getAuthenticatedId,
                'totalprice' : 1
            })
            .then(res => {
                router.push('/orders');
            });
        },
        
    },
    computed: {
        getAuthenticatedId() { 
            return this.$store.getters.getAuthenticatedId;
        }
    },
    created: function() {
      axios.get("http://localhost:8000/api/areas")
      .then(res => {
        this.areas = res.data.success;
      });
    }
};
</script>

<style scoped></style>
