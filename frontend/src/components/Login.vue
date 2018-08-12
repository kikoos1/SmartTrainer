<template>
    <div>
    <v-container >
        <h1>Login</h1>
    <form @submit.prevent = ''>
        <v-text-field
            type = 'email'
            label = 'Email'
            required
        ></v-text-field>
        <v-text-field
            type = 'password'
            label = 'Password'
            required
        ></v-text-field>
        <v-btn>Login</v-btn>
    </form>
    </v-container>
    <v-container>
        <v-btn >
            <v-icon>fab fa-facebook</v-icon>
            &nbsp;Sign in with Facebook
        </v-btn>
        <v-btn >
            <v-icon>fab fa-google</v-icon>
            &nbsp;Sign in with Google
        </v-btn>
        <br>
        <a href="/register">Don't have an account</a>
    </v-container>
    </div>
</template>

<script>
    export default {
        name: "Login"
    }
</script>

<style scoped>

</style>