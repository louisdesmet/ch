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
                        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                            <v-btn slot="activator" fab dark small color="#6A9F59">
                                <v-icon dark>add</v-icon>
                            </v-btn>
                            <v-card>
                                <v-toolbar dark color="#3083A7">
                                    <v-btn icon dark @click="dialog = false">
                                        <v-icon>close</v-icon>
                                    </v-btn>
                                    <v-toolbar-title>Nieuwe klant aanmaken</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-toolbar-items>
                                        <v-btn dark flat @click="dialog = false">Opslaan</v-btn>
                                    </v-toolbar-items>
                                </v-toolbar>
                                <v-form>
                                    <v-container>
                                        <v-text-field v-model="firstname" :counter="25" label="Voornaam" required></v-text-field>
                                        <v-text-field v-model="lastname" :counter="25" label="Achternaam" required></v-text-field>
                                        <v-text-field v-model="company_name" :counter="25" label="Bedrijfsnaam" required></v-text-field>
                                        <v-text-field v-model="adresses" :counter="25" label="Adressen" required></v-text-field>
                                        <v-text-field v-model="postcode" :counter="25" label="Postcode" required></v-text-field>
                                        <v-text-field v-model="city" :counter="25" label="Stad" required></v-text-field>
                                        <v-text-field v-model="country" :counter="25" label="Land" required></v-text-field>
                                        <v-text-field v-model="gsm" :counter="25" label="Telefoonnummer" required></v-text-field>
                                        <v-text-field v-model="email" label="E-mailadres" required></v-text-field>
                                        <v-text-field v-model="password" label="Wachtwoord" required></v-text-field>
                                        <v-text-field v-model="tax_number" label="BTW-nummer" required></v-text-field>
                                        <v-radio-group v-model="radios" :mandatory="false">
                                            <v-radio label="Partner beheert alles van de klant. Factuur naar de partner." value="0"></v-radio>
                                            <v-radio label="Eindklant beheert eigen account. Factuur naar de eindklant." value="1"></v-radio>
                                        </v-radio-group>
                                    </v-container>
                                </v-form>
                            </v-card>
                        </v-dialog>
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
                                    <v-btn color="#6A9F59" dark small absolute right fab @click="newDomain">
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
                <v-flex xs12 sm12 md6 lg6 class="new-domain" v-show="new_domain">
                    <v-card>
                        <v-toolbar color="#E2EAEC" light>
                            <v-toolbar-title>Nieuwe domein</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn v-if="button" icon @click="closeNewDomain">
                                <v-icon>clear</v-icon>
                            </v-btn>
                            <v-text-field v-model="search_extensions" v-if="input" class="pt-0" hide-details @click:append-outer="untoggle" append-outer-icon="search" clearable></v-text-field>
                            <v-btn v-if="button" icon @click="toggle">
                                <v-icon>search</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-text-field v-model="domain" class="px-4 pt-4" :counter="25" label="Domeinnaam" required prefix="www."></v-text-field>





                        <v-list two-line dense class="pa-0">
                            <v-layout row wrap>
                                <template v-for="(item, index) in selectedExtensions">
                                    <v-flex xs12>
                                        <v-list-tile :key="item.id" avatar>
                                            <v-list-tile-content>
                                                <v-list-tile-title>www.{{ domain + '.' + item.name }}</v-list-tile-title>
                                            </v-list-tile-content>
                                            <v-btn icon @click="">
                                                <v-icon>done_outline</v-icon>
                                            </v-btn>
                                        </v-list-tile>

                                        <v-divider></v-divider>
                                    </v-flex>
                                </template>
                            </v-layout>
                        </v-list>






                        <v-card v-if="search_extensions != null">
                            <v-list two-line dense class="pa-0">
                                <v-layout row wrap>
                                    <template v-for="(item, index) in extensions">
                                        <v-flex xs3 v-if="item.name.toLowerCase().indexOf(search_extensions) >= 0">
                                            <v-list-tile :key="item" avatar @click="extension" v-bind:style="{ background: activeColor }">
                                                <v-list-tile-content>
                                                    <v-list-tile-title v-html="item"></v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-divider></v-divider>
                                        </v-flex>
                                    </template>
                                </v-layout>
                            </v-list>
                        </v-card>
                        <v-card v-else>
                            <v-list two-line dense class="pa-0">
                                <v-layout row wrap>
                                    <template v-for="(item, index) in sortedExtensions">
                                        <v-flex xs3 v-if="item.selected">
                                            <v-list-tile :key="item.id" avatar @click="extension(item)" v-bind:style="{ background: '#E2EAEC'}">
                                                <v-list-tile-content>
                                                    <v-list-tile-title v-html="item.name"></v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-divider></v-divider>
                                        </v-flex>
                                        <v-flex xs3 v-else>
                                            <v-list-tile :key="item.id" avatar @click="extension(item)">
                                                <v-list-tile-content>
                                                    <v-list-tile-title v-html="item.name"></v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-divider></v-divider>
                                        </v-flex>
                                    </template>
                                </v-layout>
                            </v-list>
                        </v-card>
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
            search_extensions: null,
            new_service: false,
            new_domain: false,
            md12: true,
            md6: false,
            lg12: true,
            lg6: false,
            extensions: [
                { id: 1, name: 'be', selected: false },
                { id: 2, name: 'nl', selected: false },
                { id: 3, name: 'eu', selected: false },
                { id: 4, name: 'brussels', selected: false },
                { id: 5, name: 'gent', selected: false },
                { id: 6, name: 'vlaanderen', selected: false },
                { id: 7, name: 'com', selected: false },
                { id: 8, name: 'net', selected: false },
                { id: 9, name: 'org', selected: false },
                { id: 10, name: 'info', selected: false },
                { id: 11, name: 'biz', selected: false },
                { id: 12, name: 'fr', selected: false },
                { id: 13, name: 'es', selected: false },
                { id: 14, name: 'it', selected: false },
                { id: 15, name: 'de', selected: false },
                { id: 16, name: 'gr', selected: false },
                { id: 17, name: 'ch', selected: false },
                { id: 18, name: 'pt', selected: false },
                { id: 19, name: 'com.tr', selected: false },
                { id: 20, name: 'tr', selected: false },
                { id: 21, name: 'lu', selected: false },
                { id: 22, name: 'at', selected: false },
                { id: 23, name: 'no', selected: false },
                { id: 24, name: 'fi', selected: false },
                { id: 25, name: 'pl', selected: false },
                { id: 26, name: 'com.pl', selected: false },
                { id: 27, name: 'dk', selected: false },
                { id: 28, name: 'nu', selected: false },
                { id: 29, name: 'mobi', selected: false },
                { id: 30, name: 'tel', selected: false },
                { id: 31, name: 'com.al', selected: false },
                { id: 32, name: 'ad', selected: false },
                { id: 33, name: 'by', selected: false },
                { id: 34, name: 'ba', selected: false },
                { id: 35, name: 'bg', selected: false },
                { id: 36, name: 'com.cy', selected: false },
                { id: 37, name: 'ee', selected: false },
                { id: 38, name: 'co.ee', selected: false },
                { id: 39, name: 'fo', selected: false },
                { id: 40, name: 'gi', selected: false },
                { id: 41, name: 'com.gr', selected: false },
                { id: 42, name: 'hu', selected: false },
                { id: 43, name: 'co.hu', selected: false },
                { id: 44, name: 'ie', selected: false },
                { id: 45, name: 'je', selected: false },
                { id: 46, name: 'hr', selected: false },
                { id: 47, name: 'lv', selected: false },
                { id: 48, name: 'li', selected: false },
                { id: 49, name: 'lt', selected: false },
                { id: 50, name: 'cz', selected: false },
                { id: 51, name: 'co', selected: false },
                { id: 52, name: 'xxx', selected: false },
                { id: 53, name: 'asia', selected: false },
                { id: 54, name: 'jobs', selected: false },
                { id: 55, name: 'name', selected: false },
                { id: 56, name: 'pro', selected: false },
                { id: 57, name: 'travel', selected: false },
                { id: 58, name: 'me', selected: false },
                { id: 59, name: 'co.uk', selected: false },
                { id: 60, name: 'uk', selected: false },
                { id: 61, name: 'sx', selected: false },
                { id: 62, name: 'us', selected: false },
                { id: 63, name: 'test', selected: false },
                { id: 64, name: 'pw', selected: false },
                { id: 65, name: 'fm	,', selected: false },
                { id: 66, name: 'si', selected: false },
                { id: 67, name: 'sk', selected: false },
                { id: 68, name: 'se', selected: false },
                { id: 69, name: 'agency', selected: false },
                { id: 70, name: 'immo', selected: false },
                { id: 71, name: 'beer', selected: false },
                { id: 72, name: 'solutions', selected: false },
                { id: 73, name: 'now', selected: false },
                { id: 74, name: 'today', selected: false },
                { id: 75, name: 'energy', selected: false },
                { id: 76, name: 'events', selected: false },
                { id: 77, name: 'club', selected: false },
                { id: 78, name: 'promo', selected: false },
                { id: 79, name: 'gs', selected: false },
                { id: 80, name: 'online', selected: false },
                { id: 81, name: 'shop'	, selected: false },
                { id: 82, name: 'expert', selected: false },
                { id: 83, name: 'coach', selected: false },
                { id: 84, name: 'academy', selected: false },
                { id: 85, name: 'cat', selected: false },
                { id: 86, name: 'amsterdam', selected: false },
                { id: 87, name: 'rs', selected: false },

            ],
            firstname: '',
            lastname: '',
            company_name: '',
            adresses: '',
            postcode:'',
            city: '',
            country: '',
            gsm: '',
            email: '',
            password: '',
            tax_number: '',
            radios: '0',

            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,

            activeColor: 'red',
            selectedExtensions: [],
            domain: ''

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

                return this.users.sort(this.compare);
            },
            sortedExtensions: function() {
                console.log(this.extensions.sort(this.compare));
                return this.extensions.sort(this.compare);
            },

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
                this.new_domain = false;
            },
            closeNewService() {
                this.md12 = true;
                this.md6 = false;
                this.lg12 = true;
                this.lg6 = false;
                this.new_service = false;
            },
            newDomain() {
                this.md12 = false;
                this.md6 = true;
                this.lg12 = false;
                this.lg6 = true;
                this.new_domain = true;
                this.new_service = false;
            },
            closeNewDomain() {
                this.md12 = true;
                this.md6 = false;
                this.lg12 = true;
                this.lg6 = false;
                this.new_domain = false;
            },
            extension(item) {
                let foundIndex = this.extensions.findIndex(x => x.id == item.id);
                if(item.selected) {
                    item.selected = false;
                    this.selectedExtensions = this.selectedExtensions.filter(function (ext) {
                        return ext.id != item.id;
                    });

                } else {
                    item.selected = true;
                    this.selectedExtensions.push(this.extensions[foundIndex]);
                }
                this.extensions[foundIndex] = item;

            },
            compare(a, b) {
                if (a.name < b.name)
                    return -1;
                if (a.name > b.name)
                    return 1;
                return 0;
            },
            debug() {
                console.log(this.selectedExtensions);
                //debugger;
            }
        }
    }
</script>