<template>

    <div
            id="e3"
    >
        <v-btn
                fixed
                :dark = "dark"
                bottom
                right
                fab
                @click = "show = true"
                v-show = 'today'
        >
            <v-icon >add</v-icon>
        </v-btn>
       
              <v-container>
          <div>
            <div class="headline mb-0" ><v-btn icon><v-icon medium @click="Backwards">keyboard_arrow_left</v-icon></v-btn>
           <v-btn flat class = "title" @click = "changedate = !chagedate">{{date}}
               <v-flex>
               <v-menu v-model = "changedate"
               :close-on-content-click="true"
             :nudge-right="40"
            lazy
          transition="scale-transition"
          offset-y
          full-width
          > 
             <v-date-picker  v-model="date" reactive = "true"></v-date-picker>
             </v-menu>
             
               </v-flex>
           </v-btn>
            <v-btn icon><v-icon medium @click = "Forward">keyboard_arrow_right</v-icon></v-btn>
            
            </div>
          </div>
     </v-container>
        
        
       
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
                                    <v-list-tile-sub-title>{{item.amount}} гр</v-list-tile-sub-title>  
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
                                        <v-list-tile-sub-title>{{item.amount}} гр</v-list-tile-sub-title>
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
                                        <v-list-tile-sub-title>{{item.amount}} гр</v-list-tile-sub-title> 
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
var moment = require('moment');
    export default {
        name: "DailyIntake",
        data:()=>({
            show:false,
            breakfast:[],
            dinner:[],
            lunch:[],
            dark:localStorage.getItem('dark-theme'),
            dialog:false,
            intake:[],
            changedate:false,
            today:true,
            date:moment().format("YYYY-MM-DD")
        }),
        
        methods:{
            fetchData(date=''){
                var app =this;
                if(date==''){
                     date = moment().format("YYYY-MM-DD");
                }
               
                this.get('/daily-intake/'+date).then(function(resp){
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
            },
            Backwards(){
                this.date = moment(this.date).subtract(1,'day').format("YYYY-MM-DD");
            },
            Forward(){
                this.date = moment(this.date).add(1,'day').format("YYYY-MM-DD");
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
        },
        watch:{
            date(val){
                if(val != moment().format("YYYY-MM-DD")){
                    this.today = false
                }else{
                    this.today = true
                }
                this.foods = [];
                this.intake = [];
                this.breakfast = [];
                this.lunch = [];
                this.diner = [];
                this.fetchData(val);
                this.$eventBus.$emit('fetchData',val);
            }
        }
    }
</script>

<style scoped>

</style>