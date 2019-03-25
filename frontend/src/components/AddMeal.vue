<template>
    <v-container  fluid>
        <h1 v-if = '!addfood'>{{food.name}}</h1>
        <v-layout>
            <v-flex xs12>
                <v-text-field
                        v-show = 'addfood'
                        label="Име"
                        v-model="food.name"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row>


            <v-flex xs12>
                <v-text-field
                        label="Количество(gr)"
                        v-model="amount"
                ></v-text-field>
            </v-flex>
            </v-layout>
        <v-layout row>


            <v-flex xs12>
                <v-text-field
                        label="Калории(Kcal)"
                        v-model="food.calories"
                        :readonly = '!addfood'
                        :disabled="!addfood"
                ></v-text-field>
            </v-flex>
        </v-layout>
            <v-layout>
            <v-flex xs12>
                <v-text-field
                        label="Протеин"
                        v-model="food.protein"

                        :readonly="!addfood"
                        :disabled="!addfood"

                ></v-text-field>
            </v-flex>
                </v-layout>
            <v-layout>
            <v-flex xs12>
                <v-text-field
                        label="Въглехидрати"
                        v-model="food.carbs"
                        :readonly="!addfood"
                        :disabled="!addfood"

                ></v-text-field>
            </v-flex>
            </v-layout>
                <v-layout>
                <v-flex xs12>

                    <v-text-field
                            label="Мазнити"
                            v-model="food.fat"
                            :readonly="!addfood"
                            :disabled="!addfood"
                    ></v-text-field>
                </v-flex>

        </v-layout>
        <v-layout>
            <v-flex xs12>
                <v-select v-show ="!addfood"
                        :items="items"
                        label="Тип"
                        v-model = 'type'
                ></v-select>
            </v-flex>
        </v-layout>
        <v-layout>
        <v-flex xs12>
            <v-btn type = 'submit' @click = 'Send'>Добави</v-btn>
        </v-flex>
        </v-layout>

    </v-container>
</template>

<script>
    var moment = require('moment');
    export default {
        name: "AddMeal",
        props:['id','meal_id'],
        data:()=>({
            food:{
                id:0,
                meal_id:0,
                calories:0,
                name:'',
                protein:0,
                fat:0,
                carbs:0,
            },
            items:['Breakfast','Lunch','Dinner'],
            type:'',
            addfood:true,
            update:false,
            amount:1,
            calculated:{
                calories:0,
                protein:0,
                carbs:0,
                fat:0
            }
        }),
        methods:{
          Send(){
              var date = moment().format("YYYY-MM-DD");
              var app = this;
              if(this.addfood){
                  this.post('/food/add',{
                      name:app.food.name,
                      amount:app.amount,
                      protein:app.food.protein,
                      fat:app.food.fat,
                      carbs:app.food.carbs,
                      calories:app.food.calories,
                  }).then(function(){
                      app.$router.push('/daily-intake');
                  })


              }else if(this.update){
                  this.patch('daily-intake/updateMeal',{
                      id:app.food.meal_id,
                      amount:app.amount,
                      type:app.type
                  }).then(function(){
                      app.$router.push('/daily-intake');
                  })
              }
              else{
                  this.post('/daily-intake/addMeal',{
                      id:app.food.id,
                      amount:app.amount,
                      type:app.type,
                      date:date
                  }).then(function(){
                      app.$router.push('/daily-intake');
                  })

              }
          },
          FetchFood(){
              var app = this;
              this.get('/food/' + this.food.id).then(function (resp) {
                    app.food.name = resp.food[0].name;
                    app.food.calories = resp.food[0].calories;
                    app.food.protein = resp.food[0].protein;
                    app.food.carbs = resp.food[0].carbs;
                    app.food.fat = resp.food[0].fat;
                    app.food.id = resp.food[0].id;
                    app.Calculate();
              })
          },
          Calculate(){
              var app = this;
                app.calculated.calories = app.food.calories/100;
                app.calculated.protein = app.food.protein/100;
                app.calculated.fat = app.food.fat/100;
                app.calculated.carbs = app.food.carbs/100;
          },
          FetchMeal(){
              var app =this;
              this.get('/daily-intake/meal/'+this.meal_id).then(function(resp){
                  app.food.id = resp.meal[0].food_id;
                  app.FetchFood();
              })
          }
        },
        mounted(){
            var app = this;
             this.$eventBus.$on('update',function(meal){
                app.update = true;
                app.food.id = meal.food_id;
                app.food.meal_id = meal.id;
                app.FetchFood();
                console.log('emited by mounted'+meal);
            })
            //console.log(this.id)
            if(this.id == 'undefined' || this.id == ' ' || isNaN(this.id)){
                console.log('undefined')
               if(this.meal_id == 'undefined'|| this.meal_id == ' '|| isNaN(this.meal_id)){
                   console.log('undefined')
            }else{
                    this.addfood = false;
                    this.update = true;
                    this.food.meal_id = this.meal_id;
                    this.FetchMeal();
                   //app.Calculate();
                    app.food.protein = app.food.protein / 100;
                    app.food.carbs = app.food.carbs / 100;
                    app.food.fat = app.food.fat / 100;
                    app.food.calories = app.food.calories / 100;
            } 

            }
            else {

                    this.addfood = false;
                    this.food.id = this.id;
                    this.FetchFood();
                   //app.Calculate();
                    app.food.protein = app.food.protein / 100;
                    app.food.carbs = app.food.carbs / 100;
                    app.food.fat = app.food.fat / 100;
                    app.food.calories = app.food.calories / 100;
                
            
            }
             
        },


        created(){
            var app = this;
            this.$eventBus.$on('food',function(food){
                app.food.id = food.id;
                app.food.name = food.name;
                app.food.protein = food.protein;
                app.food.fat = food.fat;
                app.food.carbs = food.carbs;
                app.amount = 100;
                app.addfood = false
            })
            var app = this;
            app.food.protein = app.food.protein / 100;
            app.food.carbs = app.food.carbs / 100;
            app.food.fat = app.food.fat / 100;
            app.food.calories = app.food.calories / 100;
            app.amount = 1;
            app.Calculate();
           

        },
        watch: {
            amount(val) {
                if (!this.addfood && val >= 1) {
                    var app = this;
                    app.food.protein = app.calculated.protein * val;
                    app.food.carbs=app.calculated.carbs * val;
                    app.food.fat=app.calculated.fat * val;
                    app.food.calories=app.calculated.calories * val;
                }
            }
        }
    }
</script>

<style scoped>

</style>