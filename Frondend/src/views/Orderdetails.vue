<template>
  <v-container grid-list-md text-xs-center>
    <v-data-table
        :headers="headers"
        :items="services"
        :single-expand="true"
        class="elevation-1"
        show-expand
    >
    <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.service.name }}</td>
        <td class="text-xs-left">{{ props.item.order.area.name }}</td>
        <td>
            <v-edit-dialog
            :return-value.sync="props.item.price"
            large
            persistent
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
            >
                <div> {{ props.item.hours }}</div>
                <v-icon small class="mr-3">edit</v-icon>
                <template v-slot:input>
                    <div class="mt-4 title">Update Price</div>
                </template>
                <template v-slot:input>
                    <v-text-field
                    v-model="props.item.hours"
                    label="Edit"
                    single-line
                    counter
                    autofocus
                    ></v-text-field>
                </template>
            </v-edit-dialog>
        </td>
    </template>
    </v-data-table>
    <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
      {{ snackText }}
      <v-btn text @click="snack = false">Close</v-btn>
    </v-snackbar>
    <v-btn  icon class="hidden-xs-only" to="/orders">
      <v-icon>arrow_back</v-icon>
    </v-btn>
  </v-container>
</template>

<script>
import axios from 'axios';
import router from '@/router';
export default {
    name: 'orderdetails',
    data() {
        return {
            headers: [
                { text: 'Name', value: 'Name' },
                { text: 'Area', value: 'Area' },
                { text: 'Hours', value: 'Hours' },
            ],
            services:[],
            snack: false,
            snackColor: '',
            snackText: '',
        };
    },
    methods: {
        save () {
	    this.snack = true;
            this.snackColor = 'success';
            this.snackText = 'Data saved';	
            let data ={
                "services" : JSON.parse(JSON.stringify(this.services)),
                "order_id" : this.$route.params.id,
            }
            axios.post(`${process.env.VUE_APP_BACKEND_URL}`+`/api/ordersdetails/`+this.$route.params.id , data).then(res => {
             console.log("AaaA");
         });
        },
        cancel () {
            this.snack = true
            this.snackColor = 'error'
            this.snackText = 'Canceled'
        },
        open () {
            this.snack = true
            this.snackColor = 'info'
            this.snackText = 'Dialog opened'
        },
        close () {
            console.log('Dialog closed')
        },
        submit() {
        },
    },
    created: function() {
        axios.get(`${process.env.VUE_APP_BACKEND_URL}`+`/api/ordersdetails/` +  this.$route.params.id)
        .then(res => {
             this.services = res.data.success;
         });
    }
};
</script>

<style scoped></style>
