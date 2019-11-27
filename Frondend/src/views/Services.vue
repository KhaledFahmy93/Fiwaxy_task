<template >
  <v-container grid-list-md >
    <v-btn v-if="isRepaiman" 
      to="/createorder"
      data-cy="menuBtn" 
      color="primary">
      create Service
    </v-btn>
   <v-data-table
    :headers="headers"
    :items="services"
    :single-expand="true"
    class="elevation-1"
    show-expand
  >
  <template v-slot:items="props">
        <td class="text-xs-left">{{ props.index+1 }}</td>
        <td class="text-xs-left">{{ props.item.service.name }}</td>
        <td class="text-xs-left">{{ props.item.area.name }}</td>
        <td class="text-xs-left">{{ props.item.price}}</td>
    </template>
</v-data-table>
  </v-container>
</template>
<script>
import axios from 'axios';
export default {
    name: 'services',
    data () {
      return {
        headers: [
         {
            text: '#',
            align: 'left',
            sortable: false,
            value: 'Index',
          },
          { text: 'Name', value: 'Description' },
          { text: 'Area', value: 'Description' },
          { text: 'price', value: 'Description' },
        ],
        services: [],
      }
    },
    methods: {
    },
    created: function() {
      axios.get(`${process.env.VUE_APP_BACKEND_URL}`+`/api/services`)
      .then(res => {
        this.services = res.data.success;
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
