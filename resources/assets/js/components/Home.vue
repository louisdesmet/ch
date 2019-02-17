<template>
    <v-layout row wrap>
        <v-btn class="mt-4" absolute top left fab light small color="red" @click="debug">
            <v-icon dark>bug_report</v-icon>
        </v-btn>
        <v-flex xs4 sm4 md3 lg2>
            <div class="client-nav">
                <div class="client-nav-container">
                    <div class="selected-client">
                        <p>Geselecteerde klant</p>
                        <a href="#">{{ currentUser.name }}</a>
                    </div>
                    <a class="new-client" href="#">
                        <v-btn fab dark small color="#6A9F59">
                            <v-icon dark>add</v-icon>
                        </v-btn>
                        <span>Nieuwe klant</span>
                    </a>
                    <v-text-field v-model="search_clients" class="search" light solo append-icon="search" placeholder="Zoeken..." hide-details clearable></v-text-field>
                    <v-card v-if="search_clients != null" class="mt-3">
                        <v-list two-line dark dense>
                            <template v-for="(item, index) in sortedUsers">
                                <v-list-tile :key="item.id" avatar @click="" v-if="item.name.toLowerCase().indexOf(search_clients) >= 0">
                                    <v-list-tile-content>
                                        <v-list-tile-title v-html="item.name"></v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider v-if="item.name.toLowerCase().indexOf(search_clients) >= 0"></v-divider>
                            </template>
                        </v-list>
                    </v-card>
                    <v-card  v-else class="mt-2">
                        <v-list two-line dark dense class="pa-0">
                            <template v-for="(item, index) in sortedUsers">
                                <v-list-tile :key="item.id" avatar @click="" >
                                    <v-list-tile-content>
                                        <v-list-tile-title v-html="item.name"></v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                            </template>
                        </v-list>
                    </v-card>
                </div>
            </div>
        </v-flex >
        <v-flex xs8 sm8 md9 lg10>
            <v-layout row wrap>
                <v-flex xs12 sm12 v-bind:class="{ md12: md12, md6: md6, lg12: lg12, lg6: lg6 }">
                    <div class="client-details">
                        <v-card>
                            <v-toolbar color="#FAFAFA" light>
                                <v-toolbar-title>{{ currentUser.name }}</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-btn icon>
                                    <v-icon>search</v-icon>
                                </v-btn>
                            </v-toolbar>
                            <v-list three-line>
                                <v-subheader >
                                    Services van deze klant
                                    <v-btn color="#6A9F59" dark small absolute right fab @click="newService">
                                        <v-icon>add</v-icon>
                                    </v-btn>
                                </v-subheader>
                                <template v-for="(service, index) in userOrders">
                                    <v-divider></v-divider>
                                    <v-list-tile  :key="service.id" avatar @click="">
                                        <v-list-tile-avatar class="avatar-image" tile>
                                            <img :src="service.product.image">
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title v-html="service.product.name"></v-list-tile-title>
                                            <v-list-tile-sub-title class="product-title" v-html="service.product_key.key"></v-list-tile-sub-title>
                                            <v-list-tile-sub-title class="product-title" v-html="service.status"></v-list-tile-sub-title>

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
                </v-flex>
                <v-flex xs12 sm12 md6 lg6 class="new-service" v-show="new_service">
                    <v-card>
                        <v-toolbar color="#E2EAEC" light>
                            <v-toolbar-title>Nieuwe service</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn v-if="button" icon @click="closeNewService">
                                <v-icon>clear</v-icon>
                            </v-btn>
                            <v-text-field v-model="search" v-if="input" class="pt-0" hide-details @click:append-outer="untoggle" append-outer-icon="search" clearable></v-text-field>
                            <v-btn v-if="button" icon @click="toggle">
                                <v-icon>search</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-list three-line class="new-service-color">
                            <v-subheader>
                                <v-container pa-0 grid-list-md>
                                    <v-layout row wrap>
                                        <v-flex xs6>
                                            <v-select v-model="category" item-text="name" :items="categories" placeholder="Categories" clearable hide-details></v-select>
                                        </v-flex>
                                        <v-flex xs6>
                                            <v-select v-model="vendor" item-text="name" :items="vendors" placeholder="Vendors" clearable hide-details></v-select>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-subheader>
                            <template v-for="(product, index) in products">
                                <template v-if="category || vendor || search != null">
                                    <v-divider v-if="index != 0 && (category == product.category.name || vendor == product.vendor.name || product.name.toLowerCase().indexOf(search) >= 0)"></v-divider>
                                    <v-list-tile v-if="category == product.category.name || vendor == product.vendor.name || product.name.toLowerCase().indexOf(search) >= 0" :key="product.name" avatar @click="order(product)">
                                        <v-list-tile-avatar class="avatar-image" tile>
                                            <img :src="product.image">
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title v-html="product.name"></v-list-tile-title>
                                            <v-list-tile-sub-title class="product-title" v-html="product.category.name"></v-list-tile-sub-title>
                                            <v-list-tile-sub-title class="product-title" v-html="product.vendor.name"></v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </template>
                                <template v-else>
                                    <v-list-tile :key="product.name" avatar @click="order(product)">
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
                            </template>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        data: () => ({
            category: null,
            vendor: null,
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
            button: true,
            input: false,
            search: null,
            search_clients: null,
            new_service: false,
            md12: true,
            md6: false,
            lg12: true,
            lg6: false
        }),
        computed: {
            products() { return this.$store.getters.products; },
            users() { return this.$store.getters.users; },
            userOrders() { return this.$store.getters.userOrders; },
            vendors() { return this.$store.getters.vendors; },
            categories() { return this.$store.getters.categories; },
            orders() { return this.$store.getters.orders; },
            currentUser() { return this.$store.getters.currentUser; },
            sortedUsers: function() {
                function compare(a, b) {
                    if (a.name < b.name)
                        return -1;
                    if (a.name > b.name)
                        return 1;
                    return 0;
                }
                return this.users.sort(compare);
            }
        },
        mounted () {
            if(this.orders.length === 0) { this.$store.dispatch('orders'); }
            if(this.users.length === 0) { this.$store.dispatch('users'); }
            if(this.products.length === 0) { this.$store.dispatch('products'); }
            if(this.vendors.length === 0) { this.$store.dispatch('vendors'); }
            if(this.categories.length === 0) { this.$store.dispatch('categories'); }
        },
        methods: {

            order(product) {
                this.$router.push({ name: 'order', params: { product: product }})
            },
            toggle() {
                this.input = true;
                this.button = false;
            },
            untoggle() {
                this.input = false;
                this.button = true;
            },
            newService() {
                this.md12 = false;
                this.md6 = true;
                this.lg12 = false;
                this.lg6 = true;
                this.new_service = true;
            },
            closeNewService() {
                this.md12 = true;
                this.md6 = false;
                this.lg12 = true;
                this.lg6 = false;
                this.new_service = false;
            },
            debug() {
                debugger;
            }
        }
    }
</script>