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
                                <v-text-field label="Calories" v-model=" calories_and_macros.calories" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Protein" v-model=" calories_and_macros.protein" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Carbs" v-model=" calories_and_macros.carbs" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Fat" v-model=" calories_and_macros.fat" required></v-text-field>
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
        name: "CalorieAndNutrition",
        props:['dialog'],
        data:()=>({
            calories_and_macros:{
                calories:0,
                protein:0,
                fat:0,
                carbs:0
            }
        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal');
            },
            Save(){
                this.Close();
            }
        }
    }
</script>

<style scoped>

</style>