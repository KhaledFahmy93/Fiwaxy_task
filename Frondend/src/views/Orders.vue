<template >

   <v-data-table
    :headers="headers"
    :items="orders"
  >
  <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.id }}</td>
        <td class="text-xs-left">{{ props.item.description }}</td>
        <td class="text-xs-left">{{ props.item.customer.name }}</td>
        <td class="text-xs-left">{{ props.item.area.name }}</td>
        <td class="text-xs-left">Pending</td>
        <td class="text-xs-left">
             <v-btn 
                class="primary" 
                :to="`orderdetails/:${props.item.id}`"
                >price
            </v-btn>
        </td>
    </template>
</v-data-table>
</template>
<script>
import axios from 'axios';
export default {
    name: 'orders',
    data () {
      return {
        headers: [
         {
            text: 'ID',
            align: 'left',
            sortable: false,
            value: 'ID',
          },
          { text: 'Description', value: 'Description' },
          { text: 'customer', value: 'customer' },
          { text: 'Area', value: 'Area' },
          { text: 'Price', value: 'Price' },
          { text: 'Action', value: 'iron' },
        ],
        orders: [],
      }
    },
    methods: {
    },
    created: function() {
      axios.get("http://localhost:8000/api/orders")
      .then(res => {
        this.orders = res.data.success;
        console.log(this.orders);
      });
    }
  }
</script>

<style scoped></style>
