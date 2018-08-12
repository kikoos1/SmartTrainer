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

<v-flex>
        <v-card>
            <v-container fluid
                         grid-list-lg>
                <v-card-title primary-title>
                    <div>
                        <div class="headline">Breakfast</div>
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
                                    <v-list-tile-title>{{ breakfast.food.name }}</v-list-tile-title>
                                </v-list-tile-content>

                                <v-list-tile-action>
                                    <v-btn icon ripple>
                                        <v-icon>edit</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                                <v-list-tile-action>
                                    <v-btn icon ripple>
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
                            <div class="headline">Lunch</div>
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
                                        <v-list-tile-title>{{lunch.food.name}}</v-list-tile-title>
                                    </v-list-tile-content>

                                    <v-list-tile-action>
                                        <v-btn icon ripple>
                                            <v-icon>edit</v-icon>
                                        </v-btn>
                                    </v-list-tile-action>
                                    <v-list-tile-action>
                                        <v-btn icon ripple>
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
                            <div class="headline">Dinner</div>
                        </div>
                    </v-card-title>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions>

                    <v-slide-y-transition>
                        <v-card-text>
                            <v-list>
                                <v-list-tile
                                    v-for = '(index,id) in dinner' :key = 'id'
                                >


                                    <v-list-tile-content>
                                        <v-list-tile-title>{{ dinner.food.name }}</v-list-tile-title>
                                    </v-list-tile-content>

                                    <v-list-tile-action>
                                        <v-btn icon ripple>
                                            <v-icon>edit</v-icon>
                                        </v-btn>
                                    </v-list-tile-action>
                                    <v-list-tile-action>
                                        <v-btn icon ripple>
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
        <v-btn flat @click = "dialog = true">
            <v-icon>dashboard</v-icon>
            Nutrition
        </v-btn>
        <nutrition :dialog = dialog ></nutrition>
    </div>
</template>

<script>
    import Nutrition from './Nutrition'
    export default {
        name: "DailyIntake",
        data:()=>({
            show:false,
            breakfast:[],
            dinner:[],
            lunch:[],
            dialog:false
        }),
        components:{
            Nutrition
        },
        methods:{
            fetchData(){
                this.get('api/').then(function(resp){

                }).catch(function (error) {
                    console.log(error);
                })
            }
        },
        created(){
            this.fetchData();
            var app = this;
            this.$eventBus.$on('close-food-modal',function () {
                app.show = false;
            })
        }
    }
</script>

<style scoped>

</style>