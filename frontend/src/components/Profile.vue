<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">Профил</span>
                    <br>
                   <center> <v-icon>account_circle</v-icon></center>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout  wrap>
                            <v-flex xs12>
                                <v-text-field label="Name" v-model="user.name" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Email" v-model="user.email" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="Close">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="Save">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        name: "Profile",
        props:['dialog'],
        data:()=>({
            user: {
                name: null,
                email: null
            }
        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal');
            },
            Save(){
                this.Close();
            }
        },
        created(){
            this.get('api/profile').then(function (resp) {

            })
        }
    }
</script>

<style scoped>

</style>