<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12>
        <h1>Калории</h1>
    <h3>{{calories+'/'+goals.calories}}</h3>
            </v-flex>
        <v-flex xs4>
    <v-progress-circular
            :rotate="360"
            :size="120"
            :width="15"
            :value="protein/goals.protein"
            color="teal"
    >
        <h5>Протеин</h5>{{ protein+'/'+goals.protein }}
    </v-progress-circular>
        </v-flex>
        <v-flex xs4>
        <v-progress-circular
                :rotate="360"
                :size="120"
                :width="15"
                :value="fat/goals.fat"
                color="red"
        >
            <h5>Мазнини</h5>{{ fat+'/'+goals.fat }}
        </v-progress-circular>
        </v-flex>
        <v-flex xs4>
        <v-progress-circular
                :rotate="360"
                :size="120"
                :width="15"
                :value="carbs/goals.carbs"
                color="primary"
        >
            <h5>Въглехидрати</h5>{{ carbs+'/'+goals.carbs }}
        </v-progress-circular>
        </v-flex>
        </v-layout>

    </v-container>
</template>

<script>
    var moment = require('moment');
    export default {
        name: "CalorieWidget",
        data: () => ({
            user: [],
            calories: 0,
            protein: 0,
            carbs: 0,
            intake: [],
            fat: 0,
            goals: {
                protein: 0,
                carbs: 0,
                fat: 0,
                calories: 0
            }

        }),
        methods: {
            fetchData(date='') {
                var app = this;
                if(date ==''){
                    date=moment().format('YYYY-MM-DD');
                }
                this.get('/daily-intake/'+date).then(function (resp) {
                    //console.log("Widget: " + resp);
                    app.intake = resp;
                    app.filterDataandSum(resp.meals);
                })
            },
            filterDataandSum(foods) {
                var app = this;
                //console.log(foods);
               foods.forEach(function(food){
                  app.protein += Math.round((food.food.protein/100)*food.amount);
                  app.fat += Math.round((food.food.fat/100)*food.amount);
                  app.carbs += Math.round((food.food.carbs/100)*food.amount);
                  app.calories += Math.round((food.food.calories/100)*food.amount);
               });
            }
        },
            created() {
                var app = this;

                this.$eventBus.$on('fetchData', (date) => {
                    app.protein = 0;
                    app.fat = 0;
                    app.carbs = 0;
                    app.calories = 0;
                    app.fetchData(date);
                });
                setTimeout(function () {
                    app.user = app.$store.getters.getUser;
                    app.goals.calories = app.user.calories;
                    app.goals.carbs = app.user.carbs;
                    app.goals.fat = app.user.fat;
                    app.goals.protein = app.user.protein;
                }, 2000)
                app.fetchData();
            },
    }
</script>

<style scoped>

</style>