<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
<v-card>
    <v-btn icon @click = "Close">
    <v-icon>clear</v-icon>
    </v-btn>
            <v-card-text>
                <v-subheader class="pa-0">Потърси храна</v-subheader>
                <v-autocomplete
                        v-model="food"
                        :items="foods"
                        :search-input.sync="search"
                        color="white"
                        hide-selected
                        item-text="Description"
                        item-value="Food"
                        prepend-icon="mdi-database-search"
                        return-object
                >
                    <v-slide-x-reverse-transition
                            mode="out-in"
                            slot="append-outer"
                    >
                    </v-slide-x-reverse-transition>
                    <template slot="no-data">
                        <v-list-tile @click = 'Redirect("/daily-intake/addFood")'>
                            <v-list-tile-action>
                                <v-icon>add</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title>
                                Добави тази храна
                            </v-list-tile-title>

                        </v-list-tile>
                    </template>
                </v-autocomplete>
            </v-card-text>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        name: "AddFoodModal",
        props:['dialog'],
        data:()=>({
            food:'',
            foods:[],
            search:null,
            resp:[]
        }),
        methods:{
            Redirect(route,event={emit:false,name:null,prop:null}){
                var app = this;
                this.$router.push(route)
                if(event.emit){
                    app.$eventBus.$emit(event.name,event.prop);
                }
            },
            FindValue(val){
                var app = this;
                this.resp.forEach(function(food){
                    console.log(food.name)
                    console.log(app.food)
                    if(food.name==app.food){
                        return food.id;
                    }
                })
            },
            SearchForFood(name){
                var app = this;
                if(name != "" || name != null) {
                    this.get('/food/search/' + name).then(function (resp) {
                        app.foods.push(resp.foods[0].name);
                        //console.log(resp.foods[0].name);
                        app.resp.push(resp.foods[0]);
                    }).catch(function (err) {
                        console.log(err);
                    })
                }
            },
            Close(){

                this.$eventBus.$emit('close-food-modal');
            }
        },
        watch:{
            search (val) {
               // console.log(val);
                this.SearchForFood(val);
            },
            food (val) {
                var app = this;
                // console.log(val);
                var id = app.resp[0].id;
                console.log(id);
               app.Redirect('daily-intake/addMeal/'+id,{emit:true,name:'food',prop:id})
            }
        }
    }
</script>

<style scoped>

</style>