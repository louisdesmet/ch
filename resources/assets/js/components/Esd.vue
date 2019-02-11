<template>
<div>
    <v-container>
        <v-card class="pa-5">
            <v-layout row wrap align-center>
                <v-flex xs8>
                    <h2 class="mb-4">{{ product.name }}</h2>
                    <div v-html="product.description"> </div>
                </v-flex>
                <v-flex xs4>
                    <img class="product-image" :src="product.image">
                </v-flex>
            </v-layout>
            <v-text-field hint="Dit is verplicht voor de facturatie van je product" label="Referentie"></v-text-field>
            <v-select v-if="product.vendor.id != 5 && product.vendor.id != 2" :items="languages" placeholder="Taal"></v-select>
            <v-select v-if="product.vendor.id == 5" :items="duration" placeholder="Duur"></v-select>
            <v-select v-if="product.vendor.id == 5" :items="bullguard_users" placeholder="Gebruikers"></v-select>
            <v-select v-if="product.vendor.id == 2" :items="acronis_users" placeholder="Gebruikers"></v-select>
            <v-btn class="my-3" dark large block color="#6A9F59" @click="cart(product)">Toevoegen</v-btn>
            <v-btn large absolute dark fab bottom right color="#6A9F59">53.60€</v-btn>
        </v-card>
    </v-container>
</div>
</template>
<script>
    export default {
        data: () => ({
            languages: ['Nederlands', 'Frans'],
            bullguard_users: [1, 5, 10, 15, 20, 25, 30],
            acronis_users: [1, 3, 5],
            duration: [1, 2, 3]
        }),
        props: ['product'],
        methods: {
            cart(product) {
                this.$router.push({ name: 'cart', params: { product: product }})
            }
        }
    }
</script>
