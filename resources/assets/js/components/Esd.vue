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
            <v-text-field hint="Deze referentie wordt vermeld op je factuur." label="Referentie"></v-text-field>
            <v-select v-if="product.vendor.id == 1" v-model="language" :items="languages" placeholder="Taal"></v-select>
            <v-select v-if="product.vendor.id == 2" v-model="acronis_user" :items="acronis_users" placeholder="Gebruikers"></v-select>
            <v-select v-if="product.vendor.id == 5 || product.vendor.id == 6" v-model="duration" :items="durations" placeholder="Duur"></v-select>
            <v-select v-if="product.vendor.id == 5" v-model="bullguard_user" :items="bullguard_users" placeholder="Gebruikers"></v-select>
            <v-slider v-if="product.vendor.id == 6" v-model="users" color="#1976d2" label="Gebruikers" min="1" max="30" thumb-label="always" class="mt-4" hide-details></v-slider>
            <v-radio-group v-if="product.id == 21 || product.id == 22" v-model="row" row hide-details class="mt-0">
                <v-checkbox v-model="windows" label="windows" class="mr-3"></v-checkbox>
                <v-checkbox v-model="mac" label="mac"></v-checkbox>
            </v-radio-group>
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
            durations: [1, 2, 3],
            language: null,
            bullguard_user: null,
            acronis_user: null,
            duration: null,
            users: 1,
            windows: false,
            mac: false,
            row: null

        }),
        props: ['product'],
        mounted() {
          console.log(this.product);
        },
        methods: {
            cart(product) {
                let options = [];
                if(this.duration && this.bullguard_user) {
                    options.push(this.duration + ' jaar');
                    options.push(this.bullguard_user + ' gebruikers');
                } else if(this.acronis_user) {
                    options.push('');
                    options.push(this.acronis_user + ' gebruikers');
                } else if(this.language) {
                    options.push(this.language);
                    options.push('');
                }
                this.$router.push({ name: 'cart', params: { product: product, options: options }})
            }
        }
    }
</script>
