<template >
  <v-container grid-list-md >
    <v-alert
      :value="false"
      type="success"
    >
      This is a success alert.
    </v-alert>
    <v-alert
      :value="false"
      type="error"
    >
      This is a error alert.
    </v-alert>
    <v-btn v-if="!isRepaiman" 
      to="/createorder"
      data-cy="menuBtn" 
      color="primary">
      create order
    </v-btn>
   <v-data-table
    :headers="headers"
    :items="orders"
    :single-expand="true"
    class="elevation-1"
    show-expand
  >
  <template v-slot:items="props">
        <td class="text-xs-left">{{ props.index+1 }}</td>
        <td class="text-xs-left">{{ props.item.description }}</td>
        <td class="text-xs-left">{{ props.item.customer.name }}</td>
        <td class="text-xs-left">{{ props.item.area.name }}</td>
        <td class="text-xs-left">{{ props.item.totalprice }}</td>
        <td class="text-xs-left">
             <v-btn v-if="isRepaiman"
                class="primary" 
                :to="`orderdetails/${props.item.id}`"
                >price
            </v-btn>
        </td>
    </template>
</v-data-table>
  </v-container>
</template>
<script>
import axios from 'axios';
export default {
    name: 'orders',
    data () {
      return {
        headers: [
         {
            text: '#',
            align: 'left',
            sortable: false,
            value: 'Index',
          },
          { text: 'Description', value: 'Description' },
          { text: 'customer', value: 'customer' },
          { text: 'Area', value: 'Area' },
          { text: 'Total Price', value: 'Price' },
          { text: 'Action', value: 'iron', align:''},
        ],
        orders: [],
      }
    },
    methods: {
    },
    created: function() {
      axios.get(`${process.env.VUE_APP_BACKEND_URL}`+`/api/orders`)
      .then(res => {
        this.orders = res.data.success;
      });
    },
     computed: {
        isAuthenticated() { 
            return this.$store.getters.isAuthenticated;
        },
        isRepaiman() {
            return this.$store.getters.isRepaiman;
        },
    },

  }
</script>

<style scoped></style>
