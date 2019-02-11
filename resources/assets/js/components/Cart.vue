<template>
   <div>
      <v-toolbar flat color="white">
         <v-toolbar-title>My CRUD</v-toolbar-title>
         <v-divider
                 class="mx-2"
                 inset
                 vertical
         ></v-divider>
         <v-spacer></v-spacer>
      </v-toolbar>
      <v-data-table
              :items="items"
              class="elevation-1"
      >
         <template slot="items" slot-scope="props">
            <td>{{ props.item }}</td>
            <td class="justify-center layout px-0">
               <!--<v-icon-->
                       <!--small-->
                       <!--class="mr-2"-->
                       <!--@click="editItem(props.item)"-->
               <!--&gt;-->
                  <!--edit-->
               <!--</v-icon>-->
               <!--<v-icon-->
                       <!--small-->
                       <!--@click="deleteItem(props.item)"-->
               <!--&gt;-->
                  <!--delete-->
               <!--</v-icon>-->
            </td>
         </template>
      </v-data-table>
   </div>
</template>
<script>
   export default {
      data: () => ({
         items: [],
      }),
      props: ['product'],
      mounted() {
         this.add();
         this.cart();
      },
      methods: {
         add() {
            let cart = JSON.parse(localStorage.getItem('cart'));
            if(cart == null) {
               localStorage.setItem("cart", JSON.stringify([this.product.name]));
            } else {
               cart.push(this.product.name);
               localStorage.setItem("cart", JSON.stringify(cart));
            }
         },
         cart() {
            let string = localStorage.getItem('cart');
            this.items = JSON.parse(string);

            console.log(JSON.parse(string));
         }
      }
   }
</script>
