<template>
    <div>
    <v-container >
        <h1>Вход</h1>
    <form @submit.prevent = 'Login'>
        <v-text-field
            type = 'email'
            label = 'Email'
            v-model = 'email'
            required
        ></v-text-field>
        <v-text-field
            type = 'password'
            label = 'Парола'
            v-model = 'password'
            required
        ></v-text-field>
        <v-btn type = 'submit'>Вход</v-btn>
    </form>
    </v-container>
    <v-container>
        <v-btn >
            <v-icon>fab fa-facebook</v-icon>
            &nbsp;Вход с Facebook
        </v-btn>
        <v-btn >
            <v-icon>fab fa-google</v-icon>
            &nbsp;Вход с  Google
        </v-btn>
        <br>
        <v-btn to="register">Нямаш профил</v-btn>
    </v-container>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data:()=>({
            email:'',
            password:''
        }),
        methods:{
             
            Login(){
                var app = this;
                this.post('/auth/login',{
                    email:this.email,
                    password:this.password
                }).then(function(resp){
                   // app.$store.commit('set',resp.token);
                    localStorage.setItem('token',resp.token);

                      app.$eventBus.$emit('logged');
                })
            }
        },
        created() {
            var app = this;
            this.get('/auth/user').then(function(resp){
               app.$eventBus.$emit('logged');
            })
        }
    }
</script>

<style scoped>

</style>