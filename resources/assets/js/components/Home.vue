<template>
    <div class="main-container">
        <div class="client-nav">
            <div class="client-nav-container">
                <div class="selected-client">
                    <p>Geselecteerde klant</p>
                    <a href="#">FisBoCo Accounting</a>
                </div>
                <a class="new-client" href="#">
                    <v-btn fab dark small color="#6A9F59">
                        <v-icon dark>add</v-icon>
                    </v-btn>
                    <span>Nieuwe klant aanmaken</span>
                </a>

                <v-text-field class="search" light solo append-icon="search" placeholder="Zoeken..." hide-details></v-text-field>
                <div class="clients">
                    <a href="#">Mark jansen</a>
                    <a href="#">Louis De Smet</a>
                    <a href="#">Bart Peelen</a>
                    <a href="#">Sloeber De Sloeb</a>
                    <a href="#">Joris Van Maldegem</a>
                    <a href="#">Piet Huisentruyt</a>
                    <a href="#">Ellen Vandersteen</a>
                    <a href="#">Sarah Quinaert</a>
                    <a href="#">Mark jansen</a>
                    <a href="#">Louis De Smet</a>
                    <a href="#">Bart Peelen</a>
                    <a href="#">Sloeber De Sloeb</a>
                    <a href="#">Joris Van Maldegem</a>
                    <a href="#">Piet Huisentruyt</a>
                    <a href="#">Ellen Vandersteen</a>
                    <a href="#">Sarah Quinaert</a>
                </div>
            </div>
        </div>
        <div class="client-details">
            <v-card>
                <v-toolbar color="#FAFAFA" light>
                    <v-toolbar-title>FisBoCo Accounting</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon>
                        <v-icon>search</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-list three-line>
                    <v-subheader >
                        Services van deze klant
                        <v-btn color="#6A9F59" dark small absolute right fab>
                            <v-icon>add</v-icon>
                        </v-btn>
                    </v-subheader>
                    <template v-for="(service, index) in services">
                        <v-divider></v-divider>
                        <v-list-tile  :key="service.title" avatar @click="">
                            <v-list-tile-avatar class="avatar-image" tile>
                                <img :src="service.avatar">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title v-html="service.title"></v-list-tile-title>
                                <v-list-tile-sub-title class="product-title" v-html="service.item1"></v-list-tile-sub-title>
                                <v-list-tile-sub-title class="product-title" v-html="service.item2"></v-list-tile-sub-title>
                                <v-list-tile-sub-title class="product-title" v-html="service.item3"></v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </template>
                    <v-divider></v-divider>
                    <v-subheader >
                        Domeinen van deze klant
                        <v-btn color="#6A9F59" dark small absolute right fab>
                            <v-icon>add</v-icon>
                        </v-btn>
                    </v-subheader>
                    <template v-for="(domain, index) in domains">
                        <v-divider></v-divider>
                        <v-list-tile  :key="domain.title" avatar @click="">
                            <v-list-tile-avatar class="avatar-image" tile>
                                <img :src="domain.avatar">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title v-html="domain.title"></v-list-tile-title>
                                <v-list-tile-sub-title class="product-title" v-html="domain.item1"></v-list-tile-sub-title>
                                <v-list-tile-sub-title class="product-title" v-html="domain.item2"></v-list-tile-sub-title>
                                <v-list-tile-sub-title class="product-title" v-html="domain.item3"></v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </template>
                </v-list>
            </v-card>
        </div>
        <div class="new-service">
            <v-card>
                <v-toolbar color="#E2EAEC" light>
                    <v-toolbar-title>FisBoCo Accounting</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon>
                        <v-icon>search</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-list three-line class="new-service-color">
                    <v-subheader>
                        Nieuwe service
                        <v-btn color="#6A9F59" dark small absolute right fab>
                            <v-icon>add</v-icon>
                        </v-btn>
                    </v-subheader>
                    <v-subheader>
                        <v-container pa-0 grid-list-md>
                            <v-layout row wrap>
                                <v-flex xs6>
                                    <v-select item-text="name" :items="categories" placeholder="Categories"></v-select>
                                </v-flex>
                                <v-flex xs6>
                                    <v-select item-text="name" :items="vendors" placeholder="Vendors"></v-select>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-subheader>
                    <template v-for="(product, index) in products">
                        <v-list-tile  :key="product.name" avatar @click="order(product)">
                            <v-list-tile-avatar class="avatar-image" tile>
                                <img :src="product.image">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title v-html="product.name"></v-list-tile-title>
                                <v-list-tile-sub-title class="product-title" v-html="product.category.name"></v-list-tile-sub-title>
                                <v-list-tile-sub-title class="product-title" v-html="product.vendor.name"></v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-divider v-if="index != products.length - 1"></v-divider>
                    </template>
                </v-list>
            </v-card>
        </div>
    </div>
</template>
<script>
    export default {
        data: () => ({
            categories: [
                'Microsoft Cloud',
                'Storage & Backup',
                'Security',
                'VOIP',
                'Cloud Server / VPS',
                'Domains & Web',
                'Tools',
                'Service',
                'Training',
            ],
            vendors: [
                'Microsoft',
                'Acronis',
                'SkyHi',
                'Nomadesk',
                'Bullguard',
                'Gdata',
                'Comodo'
            ],
            services: [
                {
                    avatar: 'img/office365.png',
                    title: 'Offic 365 abonement',
                    item1: "Tenant: denever.onmicrosoft.com",
                    item2: "Status: actief",
                    item3: "Automatische verlenging op 01/02/2019"
                },
                {
                    avatar: 'img/office365.png',
                    title: 'Office 365 abonnemen',
                    item1: "Tenant: denever.onmicrosoft.com",
                    item2: "Status: actief",
                    item3: "Automatische verlenging op 01/02/2019"
                },
                {
                    avatar: 'img/office365.png',
                    title: 'Office 365 abonement',
                    item1: "Tenant: denever.onmicrosoft.com",
                    item2: "Status: actief",
                    item3: "Licentie vervalt op 01/02/2019"
                }
            ],
            domains: [
                {
                    avatar: 'img/office365.png',
                    title: 'Office 365 abonnemnt',
                    item1: "Tenant: denever.onmicrosoft.com",
                    item2: "Status: actief",
                    item3: "Automatische verlenging op 01/02/2019"
                },
                {
                    avatar: 'img/office365.png',
                    title: 'Office 365 bonnement',
                    item1: "Tenant: denever.onmicrosoft.com",
                    item2: "Status: actief",
                    item3: "Automatische verlenging op 01/02/2019"
                },
                {
                    avatar: 'img/office365.png',
                    title: 'Office 36 abonnement',
                    item1: "Tenant: denever.onmicrosoft.com",
                    item2: "Status: actief",
                    item3: "Licentie vervalt op 01/02/2019"
                }
            ],
            //products: []
        }),
        mounted () {
            this.$store.dispatch('products');
            //this.initialize();
        },
        computed: {
            products() {
                return this.$store.getters.products;
            }
        },
        methods: {
            initialize() {
                //this.fetchProducts();
                this.fetchCategories();
                this.fetchVendors();
            },
            /*fetchProducts() {
                axios.get('/api/products').then(response => {
                    this.products = response.data;
                });
            },*/
            fetchCategories() {
                axios.get('/api/categories').then(response => {
                    this.categories = response.data;
                });
            },
            fetchVendors() {
                axios.get('/api/vendors').then(response => {
                    this.vendors = response.data;
                });
            },
            order(product) {
                this.$router.push({ name: 'order', params: { product: product }})
            }
        }
    }
</script>
