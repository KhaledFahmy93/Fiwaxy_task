<template >
   <v-data-table
    :headers="headers"
    :items="desserts"
  >
  <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.fat }}</td>
        <td class="text-xs-left">{{ props.item.fat }}</td>
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
          { text: 'Edit', value: 'iron' },
        ],
        desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%',
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%',
          },
          {
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%',
          },
          {
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%',
          },
          {
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%',
          },
        ],
      }
    },
    methods: {
      // save () {
      //   this.snack = true
      //   this.snackColor = 'success'
      //   this.snackText = 'Data saved'
      // },
      // cancel () {
      //   this.snack = true
      //   this.snackColor = 'error'
      //   this.snackText = 'Canceled'
      // },
      // open () {
      //   this.snack = true
      //   this.snackColor = 'info'
      //   this.snackText = 'Dialog opened'
      // },
      // close () {
      //   console.log('Dialog closed')
      // },
    },
    created: function() {
      axios.get("http://localhost:8000/api/areas")
      .then(res => {
        this.desserts = res.data.success;
      });
    }
  }
</script>

<style scoped></style>
