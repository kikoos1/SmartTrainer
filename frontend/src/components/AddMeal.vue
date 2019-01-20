<template>
    <v-container  fluid>
        <h1 v-if = '!addfood'>{{food.name}}</h1>
        <v-layout>
            <v-flex xs12>
                <v-text-field
                        v-show = 'addfood'
                        label="Name"
                        v-model="food.name"
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row>


            <v-flex xs12>
                <v-text-field
                        label="Amount(gr)"
                        v-model="amount"
                ></v-text-field>
            </v-flex>
            </v-layout>
        <v-layout row>


            <v-flex xs12>
                <v-text-field
                        label="Calories(gr)"
                        v-model="food.calories"
                        :readonly = '!addfood'
                        :disabled="!addfood"
                ></v-text-field>
            </v-flex>
        </v-layout>
            <v-layout>
            <v-flex xs12>
                <v-text-field
                        label="Protein"
                        v-model="food.protein"

                        :readonly="!addfood"
                        :disabled="!addfood"

                ></v-text-field>
            </v-flex>
                </v-layout>
            <v-layout>
            <v-flex xs12>
                <v-text-field
                        label="Carbs"
                        v-model="food.carbs"
                        :readonly="!addfood"
                        :disabled="!addfood"

                ></v-text-field>
            </v-flex>
            </v-layout>
                <v-layout>
                <v-flex xs12>

                    <v-text-field
                            label="Fat"
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
                        label="Meal type"
                        v-model = 'type'
                ></v-select>
            </v-flex>
        </v-layout>
        <v-layout>
        <v-flex xs12>
            <v-btn type = 'submit' @click = 'Send'>Add</v-btn>
        </v-flex>
        </v-layout>

    </v-container>
</template>

<script>
    export default {
        name: "AddMeal",
        props:['id'],
        data:()=>({
            food:{
                id:0,
                calories:0,
                name:'',
                protein:0,
                fat:0,
                carbs:0,
                iscalc:false
            },
            items:['Breakfast','Lunch','Dinner'],
            type:'',
            addfood:true,
            amount:100
        }),
        methods:{
          Send(){
              var app = this;
              if(this.addfood){
                  this.post('/food/add',{
                      name:app.food.name,
                      amount:app.amount,
                      protein:app.food.protein,
                      fat:app.food.fat,
                      carbs:app.food.carbs,
                      calories:app.food.calories
                  }).then(function(){
                      app.$router.push('/daily-intake');
                  })


              }else{
                  this.post('/daily-intake/addMeal',{
                      id:app.food.id,
                      amount:app.amount,
                      type:app.type
                  }).then(function(){
                      app.$router.push('/daily-intake');
                  })

              }
          }
        },
        mounted(){
            var app = this;
            //console.log(this.id)
            if(this.id == 'undefined' || this.id == ' ' || isNaN(this.id)){


            }else {

                this.addfood = false;
                this.get('/food/' + this.id).then(function (resp) {
                    app.food.name = resp.food[0].name;
                    app.food.calories = resp.food[0].calories;
                    app.food.protein = resp.food[0].protein;
                    app.food.carbs = resp.food[0].carbs;
                    app.food.fat = resp.food[0].fat;
                    app.food.id = resp.food[0].id;
                })
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
        },
        watch:{
            amount(val){
                if(!this.addfood) {
                    if(!this.iscalc){
                        var app = this;
                        var prot = app.food.protein / 100;
                        var carb = app.food.carbs / 100;
                        var fat = app.food.fat / 100;
                        var calories = app.food.calories / 100;


                        this.iscalc = true;
                    }


                    app.food.protein = val * prot;
                    app.food.carbs = val * carb;
                    app.food.fat = val * fat;
                    app.food.calories = val * calories;
                }
            }
        }
    }
</script>

<style scoped>

</style>