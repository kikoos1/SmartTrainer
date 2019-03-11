<template>

    <div
            id="e3"
    >
        <v-btn
                color="blue"
                dark
                fixed
                bottom
                right
                fab
                @click = "show = true"
        >
            <v-icon>add</v-icon>
        </v-btn>
        <add-food-modal :dialog ='show' ></add-food-modal>
        <calorie-widget></calorie-widget>
<v-flex>
        <v-card>
            <v-container fluid
                         grid-list-lg>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">Закуска</div>
                    </div>
                </v-card-title>

                <v-card-actions>
                    <v-spacer></v-spacer>
                </v-card-actions>

                <v-slide-y-transition>
                    <v-card-text>
                        <v-list>
                            <v-list-tile
                                v-for = '(item,id) in breakfast' :key = 'id'
                            >


                                <v-list-tile-content>
                                    <v-list-tile-title>{{ item.food.name}}</v-list-tile-title>
                                </v-list-tile-content>

                                <v-list-tile-action>
                                    <v-btn icon ripple @click = 'Update(item.id)'>
                                        <v-icon>edit</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                                <v-list-tile-action>
                                    <v-btn icon ripple @click = 'Delete(item.id)'>
                                        <v-icon>delete</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                            </v-list-tile>
                        </v-list>
                    </v-card-text>
                </v-slide-y-transition>
            </v-container>
        </v-card>
                    </v-flex><!---Breakfast--->
        <br>
        <v-flex>
            <v-card>
                <v-container fluid
                             grid-list-lg>
                    <v-card-title primary-title>
                        <div>
                            <div class="headline">Обяд</div>
                        </div>
                    </v-card-title>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                    </v-card-actions>

                    <v-slide-y-transition>
                        <v-card-text>
                            <v-list>
                                <v-list-tile
                                    v-for = '(item,id) in lunch' :key = 'id'
                                >


                                    <v-list-tile-content>
                                        <v-list-tile-title>{{item.food.name}}</v-list-tile-title>
                                    </v-list-tile-content>

                                    <v-list-tile-action>
                                        <v-btn icon ripple @click = "Update(item.id)">
                                            <v-icon>edit</v-icon>
                                        </v-btn>
                                    </v-list-tile-action>
                                    <v-list-tile-action>
                                        <v-btn icon ripple @click = 'Delete(item.id)'>
                                            <v-icon>delete</v-icon>
                                        </v-btn>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                        </v-card-text>
                    </v-slide-y-transition>
                </v-container>
            </v-card>
        </v-flex><!---Lunch--->
        <br>
        <v-flex>
            <v-card>
                <v-container fluid
                             grid-list-lg>
                    <v-card-title primary-title>
                        <div>
                            <div class="headline">Вечеря</div>
                        </div>
                    </v-card-title>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions>

                    <v-slide-y-transition>
                        <v-card-text>
                            <v-list>
                                <v-list-tile
                                    v-for = '(item,id) in dinner' :key = 'id'
                                >


                                    <v-list-tile-content>
                                        <v-list-tile-title>{{ item.food.name }}</v-list-tile-title>
                                    </v-list-tile-content>

                                    <v-list-tile-action>
                                        <v-btn icon ripple @click = "Update(item.id)">
                                            <v-icon>edit</v-icon>
                                        </v-btn>
                                    </v-list-tile-action>
                                    <v-list-tile-action>
                                        <v-btn icon ripple @click = 'Delete(item.id)'>
                                            <v-icon>delete</v-icon>
                                        </v-btn>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                        </v-card-text>
                    </v-slide-y-transition>
                </v-container>
            </v-card>
        </v-flex><!---Dinner--->
        <br>
    </div>
</template>

<script>
    export default {
        name: "DailyIntake",
        data:()=>({
            show:false,
            breakfast:[],
            dinner:[],
            lunch:[],
            dialog:false,
            intake:[]
        }),
        
        methods:{
            fetchData(){
                var app =this;
                this.get('/daily-intake').then(function(resp){
                    console.log(resp)
                    app.intake = resp;
                    app.Daily_Intake(resp.meals);
                }).catch(function (error) {
                    console.log(error);
                })
                console.log(app.intake);

            },
            Daily_Intake(foods){
                var app = this;
                console.log(foods);
                foods.forEach((food)=>{
                    console.log("Food:" +food);
                    console.log(food);
                    if(food.type == "Breakfast"){
                        app.breakfast.unshift(food);
                    }else if(food.type =='Lunch'){
                        app.lunch.unshift(food)
                    }else if(food.type =='Dinner'){
                        app.dinner.unshift(food);
                    }
                })
            },
            Delete(index){
                var app = this;
                
                this.delete('daily-intake/meal/'+index+'/delete').then(function(){
                    app.fetchData();
                   location.reload();
                })
            },
            Update(id){
                var app = this;
                this.$router.push('daily-intake/updateMeal/'+id);
                
                
                
            }
        },
        created(){
            this.fetchData();
            //this.Daily_Intake(this.intake);
            var app = this;
            this.$eventBus.$on('close-food-modal',function () {
                app.show = false;
            })
            this.$eventBus.$on('close-modal',function(){
                app.dialog = false;
            })
        }
    }
</script>

<style scoped>

</style>