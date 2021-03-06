<template>
    <v-container mt-5>
        <v-layout row>
            <v-flex xs8 offset-xs2>
                <v-alert v-if="authError" :value="true" color="error" icon="warning" outline>{{ authError }}</v-alert>
                <v-card flat class="logincard pa-4">
                    <v-form>
                        <v-text-field required label="Email" type="email"
                                      :error-messages="emailErrors"
                                      @input="$v.form.email.$touch()"
                                      @blur="$v.form.email.$touch()"
                                      prepend-icon="person"
                                      v-model="form.email">
                        </v-text-field>
                        <v-text-field required label="Password" type="password"
                                      :error-messages="passwordErrors"
                                      @input="$v.form.password.$touch()"
                                      @blur="$v.form.password.$touch()"
                                      prepend-icon="lock"
                                      v-model="form.password"
                                      autocomplete="new-password">
                        </v-text-field>
                        <v-btn type="submit" block :loading="loading" :disabled="loading" @click.prevent="loader = 'loading'">
                            Aanmelden<span slot="loader" class="custom-loader"><v-icon light>cached</v-icon></span>
                        </v-btn>
                    </v-form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
    import {login} from '../auth';
    import { validationMixin } from 'vuelidate'
    import { required, email } from 'vuelidate/lib/validators'
    export default {
        data: () => ({
            form: {
                email: '',
                password:''
            },
            loader: null,
            loading: false
        }),
        mixins: [validationMixin],
        validations: {
            form: {
                email: { required, email },
                password: { required }
            }
        },
        watch: {
            loader () {
                this.$v.form.$touch();
                if(this.$v.form.$error) return;
                const l = this.loader;
                this[l] = !this[l];
                if(this.loader == 'loading') {
                    this.$store.dispatch('login');
                    login(this.$data.form).then((res) => {
                        this.$store.commit('loginSuccess', res);
                        this[l] = false
                        this.$router.push({path: '/'});
                    }).catch((error) => {
                        this.$store.commit('loginFailed', {error});
                        this[l] = false
                    });
                    this.loader = null;
                }
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            },
            emailErrors () {
                const errors = [];
                if (!this.$v.form.email.$dirty) return errors;
                !this.$v.form.email.email && errors.push('Must be valid e-mail');
                !this.$v.form.email.required && errors.push('E-mail is required');
                return errors
            },
            passwordErrors () {
                const errors = [];
                if (!this.$v.form.password.$dirty) return errors;
                !this.$v.form.password.required && errors.push('Password is required');
                return errors;
            }
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');
                login(this.$data.form).then((res) => {
                    this.$store.commit('loginSuccess', res);
                    this.$router.push({path: '/'});
                }).catch((error) => {
                    this.$store.commit('loginFailed', {error});
                });
            },

        }
    }
</script>
<style scoped>
    .custom-loader {
        animation: loader 1s infinite;
        display: flex;
    }
    @-moz-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-webkit-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-o-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
