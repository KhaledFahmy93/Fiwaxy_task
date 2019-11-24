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
                             <v-select v-on:change="changeArea"
                                :items="areas"
                                item-text="name"
                                item-value="id"
                                label="Area"
                                required
                            ></v-select>
                            <v-text-field
                                v-model="description"
                                label="description"
                                required
                            ></v-text-field>
                            <v-select v-on:change="changeServices"
                            :items="services"
                             item-text="name"
                             item-value="id"
                            :menu-props="{ maxHeight: '400' }"
                            multiple
                            hint="Select Services of the order"
                            persistent-hint
                            ></v-select>
                            <v-select v-on:change="changeRepairman"
                            :items="repairmen"
                            item-text="name"
                            item-value="id"
                            :menu-props="{ maxHeight: '400' }"
                            multiple
                            hint="Select Repairmen of the order"
                            persistent-hint
                            ></v-select>
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
            services:null,
            repairmen:null,
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
        this.selectedServices= JSON.parse(JSON.stringify(services));
      },
      changeRepairman(repairman){
          this.selectedRepairman= JSON.parse(JSON.stringify(repairman));
      },
        submit() {
            let data ={
                "description" : this.description,
                "area_id" : this.selectedArea,
                "services" : this.selectedServices,
                "repairmen": this.selectedRepairman,
                'totalprice' : 1,
                "customer_id": 1
            }
            axios.post("http://localhost:8000/api/createorder",data)
            .then(res => {
                router.push('/orders');
            });
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
      axios.get("http://localhost:8000/api/areas")
      .then(res => {
        this.areas = res.data.success;
      });
       axios.get("http://localhost:8000/api/services")
      .then(res => {
        this.services = res.data.success;
      });
       axios.get("http://localhost:8000/api/repairmen")
      .then(res => {
        this.repairmen = res.data.success;
      });
    }
};
</script>

<style scoped></style>
