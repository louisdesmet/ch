<template>
   <v-container>
      <v-toolbar flat color="white">
         <v-toolbar-title>Winkelmandje</v-toolbar-title>
         <v-spacer></v-spacer>
      </v-toolbar>
      <v-data-table :items="items" class="elevation-1" hide-actions hide-headers>
         <template slot="items" slot-scope="props">
            <td>{{ props.item.name }}</td>
            <td v-for="option in props.item.options">{{ option }}</td>

            <td>59.45€</td>
            <td class="justify-center layout px-0">
               <v-icon small @click="deleteItem(props.item)">delete</v-icon>
            </td>
         </template>
      </v-data-table>
      <v-btn block @click="checkout">Afrekenen</v-btn>
   </v-container>
</template>
<script>
   export default {
      data: () => ({
         items: [],
      }),
      props: ['product', 'options'],
      mounted() {
         if(this.product) {
            this.add();
         }
         this.cart();
      },
      methods: {
         add() {
            let cart = JSON.parse(localStorage.getItem('cart'));
            if(cart == null) {
               localStorage.setItem("cart", JSON.stringify([{id: 1, name: this.product.name, options: this.options}]));
            } else {
               cart.push({id: cart.length + 1, name: this.product.name, options: this.options});
               localStorage.setItem("cart", JSON.stringify(cart));
            }
         },
         cart() {
            let string = localStorage.getItem('cart');
            this.items = JSON.parse(string);
         },
         checkout() {
            this.$router.push('/checkout');
         }

      }
   }
</script>
