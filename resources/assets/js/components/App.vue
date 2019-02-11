<template>
    <v-app v-cloak>
        <v-content>
            <v-toolbar color="#3083A7" dark height="80px">
                <v-toolbar-title><img class="logo" src="img/logo.png"></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn flat>{{welcome}}</v-btn>
                    <v-btn flat><router-link class="links" to="/home"><v-icon left dark small>{{ menu.home.icon }}</v-icon>{{ menu.home.text }}</router-link></v-btn>
                    <v-btn flat><router-link class="links" to="/services"><v-icon left dark small>{{ menu.services.icon }}</v-icon>{{ menu.services.text }}</router-link></v-btn>
                    <v-btn flat><router-link class="links" to="/domains"><v-icon left dark small>{{ menu.domeinen.icon }}</v-icon>{{ menu.domeinen.text }}</router-link></v-btn>
                    <v-btn flat><router-link class="links" to="/licenses"><v-icon left dark small>{{ menu.licenties.icon }}</v-icon>{{ menu.licenties.text }}</router-link></v-btn>
                    <v-btn flat><router-link class="links" to="/reports"><v-icon left dark small>{{ menu.rapporten.icon }}</v-icon>{{ menu.rapporten.text }}</router-link></v-btn>
                    <v-btn flat>
                    <v-badge overlap top left color="red">
                        <span slot="badge">6</span>
                        <v-avatar size="40" color="#6A9F59">
                            <v-btn flat dark fab icon>
                                <v-icon>shopping_cart</v-icon>
                            </v-btn>
                        </v-avatar>
                    </v-badge>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <router-view></router-view>
            <div class="floating-cart">
                <v-badge overlap top left color="red">
                    <span slot="badge">6</span>
                    <v-avatar size="40" color="#6A9F59">
                        <v-btn flat dark fab icon>
                            <v-icon>shopping_cart</v-icon>
                        </v-btn>
                    </v-avatar>
                </v-badge>
            </div>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        name: 'app',
        data: () => ({
            menu: {
                "home": { text: 'Home', icon: 'home' },
                "services": { text: 'Services', icon: 'list_alt' },
                "domeinen": { text: 'Domeinen', icon: 'view_list' },
                "licenties": { text: 'Licenties', icon: 'calendar_today' },
                "rapporten": { text: 'Rapporten', icon: 'assignment' }
            },
        }),
        computed: {
            welcome() {
                return this.$store.getters.welcome
            }
        },
    }
</script>
