<template>
    <v-container fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-110">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Order detail</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form ref="form">
                            <!-- <div v-for="service in numservices" v-bind:key="service">
                                 <select v-model="selectedService[service]" v-on:input="changed">
                                    <option disabled value="">Please select one</option>
                                    <option v-for="ser in services" v-bind:key="ser.id" v-bind:value="ser.id">{{ser.name}}</option>
                                </select>

                                <select v-model="selectedService[service]">
                                    <option disabled value="">Please select one</option>
                                    <option v-for="repairman in repairmen" v-bind:key="repairman.id" v-bind:value="repairman.id">{{repairman.name}}</option>
                                </select><br>

                                <label>price</label>
                                <input type='number' v-model="price">
                            </div>  -->
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
    name: 'orderdetails',
    data() {
        return {
            services:'',
            repairmen: '',
            numservices:4,
            price:"",
            selectedService:[],
            selectedRepairman:[],
        };
    },
    methods: {
         changed: function() {
            console.log(this.selectedService);
        },
        submit() {
            console.log(this.selectedRepairman ,this.selectedRepairman );
            // axios.post("http://localhost:8000/api/createorder",{
                
            // })
            // .then(res => {
            //     router.push('/orderdetails');
            //     //this.services = res.data.success;
            // });
        }
    },
    created: function() {
        alert("sss");
        
          console.log('The id is: ' + this.$route.params.id);
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
