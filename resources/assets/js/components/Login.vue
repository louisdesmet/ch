<template>
    <v-container mt-5>
        <v-layout row>
            <v-flex xs8 offset-xs2>
                <v-card flat class="logincard pa-4">
                    <v-form @submit.prevent="handleSubmit">
                        <v-text-field prepend-icon="person" v-model="email" name="Email" label="Email"></v-text-field>
                        <v-text-field prepend-icon="lock" v-model="password" name="Password" label="Password" type="password"></v-text-field>
                        <v-btn type="submit" primary large block>Aanmelden</v-btn>
                    </v-form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>

    export default {
        data: () => ({
            email: '',
            password:''
        }),
        methods: {
            handleSubmit (e) {
                axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    localStorage.setItem('user', JSON.stringify(response));
                    this.$router.push('/home');
                });
            }
        }
    }
</script>
