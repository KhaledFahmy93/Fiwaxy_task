<template>
    <v-container class="grey lighten-5">
        <v-layout >
            <v-flex>
                <v-card class="elevation-110">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>create Order</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form ref="form" v-model="valid">
                             <v-select v-on:change="changeArea"
                                :items="areas"
                                item-text="name"
                                item-value="id"
                                label="Area"
                                :rules="AreaRules"
                                 required
                            ></v-select>
                            <v-text-field
                                v-model="description"
                                label="description"
                                required
                            ></v-text-field>
                            <v-select v-on:change="changeServices"
                            :items="services"
                             item-text="service.name"
                             item-value="service_id"
                            :menu-props="{ maxHeight: '400' }"
                            multiple
                            hint="Select Services of the order"
                            persistent-hint
                             :rules="ServiesRules"
                             required
                            ></v-select>
                            <v-select v-on:change="changeRepairman"
                            :items="repairmen"
                            item-text="name"
                            item-value="id"
                            :menu-props="{ maxHeight: '400' }"
                            multiple
                            hint="Select Repairmen of the order"
                            persistent-hint
                            :rules="RepairmenRules"
                            required=""
                            ></v-select>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="submit"
                            >create</v-btn
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
            valid: false,
            areas:null,
            services:null,
            repairmen:null,
            AreaRules: [v => !!v || 'Area is required'],
            ServiesRules: [v => !!v || 'Service is required'],
            RepairmenRules: [v => !!v || 'Repairman is required'],
            description:"",
            selectedArea:"",
            selectedServices:[],
            selectedRepairman :[],
        };
    },
    methods: {
       changeArea(area) {
        this.selectedArea = area;
      },
      changeServices(services) {
        this.selectedServices= services;
      },
      changeRepairman(repairman){
          this.selectedRepairman= repairman;
      },
        submit() {
            let data ={
                "description" : this.description,
                "area_id" : this.selectedArea,
                "customer_id": this.getAuthenticatedId,
                "services" : JSON.parse(JSON.stringify(this.selectedServices)),
                "repairman_ids": JSON.stringify(JSON.parse(JSON.stringify(this.selectedRepairman))),
            }
            if (this.$refs.form.validate()) {
                axios.post(`${process.env.VUE_APP_BACKEND_URL}`+`/api/createorder`,data)
                .then(res => {
                    router.push('/orders');
                });
            }
        },
        
    },
    computed: {
        getAuthenticatedId() { 
            return this.$store.getters.getAuthenticatedId;
        },
        id(){
            return (this.selectedArea && this.selectedArea.id)?this.selectedArea.id:'';
        }
    },
    created: function() {
      axios.get(`${process.env.VUE_APP_BACKEND_URL}`+`/api/areas`)
      .then(res => {
        this.areas = res.data.success;
      });
       axios.get(`${process.env.VUE_APP_BACKEND_URL}`+`/api/services`)
      .then(res => {
        this.services = res.data.success;
      });
       axios.get(`${process.env.VUE_APP_BACKEND_URL}`+`/api/repairmen`)
      .then(res => {
        this.repairmen = res.data.success;
      });
    }
};
</script>

<style scoped></style>
