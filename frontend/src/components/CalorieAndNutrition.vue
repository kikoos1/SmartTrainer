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
                                <v-select
                                        :items = 'activities'
                                        v-model="activity"
                                        label = 'Твоята активност'
                                        single line
                                        :rules = 'selectRules'
                                        :disabled = '!edit'
                                >
                                </v-select>
                            </v-flex>

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
            goal:0,
            activity:0,
            goals:[
                {text:"Сваляй по 0,5кг на седмица",value:-500},
                {text:"Поддържай килограми",value:1},
                {text:"Качвай по 0,5кг на седмица",value:500},
            ],
            activities:[
                {text:'Заседнал начин на живот (малко или никакви упражнения)',value:1.2},
                {text:'Ниско активен (леки упражнения/спорт  1-3 дни/сецмица) ',value:1.375},
                {text:'Средно Активен (Средни упражнения/спорт 3-5 дни/седмица) ',value:1.55},
                {text:'Много Активен (Трудни упражнениея/спорт 6-7 дни/седмица)',value:1.725},
                {text:'Екстремно активен (Много тежки упражнения/ Работа в склад/ Тренировки по 2 пъти на ден) ',value:1.9},
            ],
            nameRules:[
                v=>!!v||'Име е необходимо'
            ],
            emailRules:[
                v=>!!v||'Email е необходим'
            ],
            passwordRules:[
                v=>!!v||'Парола е необходима'
            ],
            selectRules:[
                v=>!!v||' Моля избери опция',

            ],
            numberRules:[
                v=>!!v||'Това поле е необходимо'
            ],
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
            },
            FormatData(response){

               this.goal = response.target;

               this.activity = response.activity;


            }

        },
        created(){
           // console.log(this.$store.getter.getUser);
            var app = this;
            this.get('auth/user').then(function(resp){
                app.FormatData(resp.data);
            })
        }
    }
</script>

<style scoped>

</style>