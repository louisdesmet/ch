<template>
   <v-container>
      <v-toolbar flat color="white">
         <v-toolbar-title>Checkout</v-toolbar-title>
         <v-spacer></v-spacer>
      </v-toolbar>
      <v-card>
         <v-card-title primary-title>

               <h4>Gegevens</h4>
               <v-container>
                  <v-layout row wrap>
                     <v-flex xs6>
                        <p>Name</p>
                        <p>Email</p>
                     </v-flex>
                     <v-flex xs6>
                        <p>{{ currentUser.name }}</p>
                        <p>{{ currentUser.email }}</p>
                     </v-flex>
                  </v-layout>
               </v-container>

         </v-card-title>

      </v-card>


      <v-btn block>Afronden</v-btn>
   </v-container>
</template>
<script>
   export default {
      data: () => ({

      }),
      computed: {
         currentUser() {
            return this.$store.getters.currentUser;
         }
      },
      mounted() {
      }
   }
</script>
