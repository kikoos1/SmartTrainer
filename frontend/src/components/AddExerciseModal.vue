<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-card>
                <v-btn icon @click = "Close">
                    <v-icon>clear</v-icon>
                </v-btn>
                <v-card-text>
                    <v-subheader class="pa-0">Потърси упражнение</v-subheader>
                    <v-autocomplete
                            v-model="exercise"
                            :items="exercises"
                            :search-input.sync="search"
                            color="white"
                            hide-selected
                            item-text="Description"
                            item-value="Exercise"
                            prepend-icon="mdi-database-search"
                            return-object
                    >
                        <v-slide-x-reverse-transition
                                mode="out-in"
                                slot="append-outer"
                        >
                        </v-slide-x-reverse-transition>
                        <template slot="no-data">
                            <v-list-tile @click = 'Redirect("/exercises/add")'>
                                <v-list-tile-action>
                                    <v-icon>add</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-title>
                                    Добави това упражнение
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
        name: "AddExercise",
        props:['dialog','workout_id'],
        data:()=>({
            exercise:'',
            exercises:[],
            search:null,
            resp:[]
        }),
        methods:{
            Redirect(route,event={emit:false,name:null,prop:null}){
                var app = this;
               
                if(event.emit){
                    app.$eventBus.$emit(event.name,event.prop);
                }
                 this.$router.push(route)
            },
            FindValue(val){
                var app = this;
                this.resp.forEach(function(food){
                    console.log(exercise.name)
                    console.log(app.food)
                    if(exercisee.name==app.exercise){
                        return food.id;
                    }
                })
            },
            SearchForFood(name){
                var app = this;
                if(name != "" || name != null) {
                    this.get('/exercise/search/' + ''+name+'').then(function (resp) {
                        console.log(resp);
                        app.exercises = [];
                        app.exercises.push(resp.exercises[0].name);
                        //console.log(resp.foods[0].name);
                        app.resp.push(resp.exercises);
                        console.log(app.resp);
                    }).catch(function (err) {
                        console.log(err);
                    })
                }
            },
            Close(){

                this.$eventBus.$emit('close-exercise-modal');
            }
        },
        watch:{
            search (val) {
                // console.log(val);
                this.SearchForFood(val);
            },
            exercise (val) {
                var app = this;
                // console.log(val);
                var id;
                for(var i = 0;i<=this.resp.length;i++){
                    if(this.resp[i][0].name == this.exercise){
                       id = this.resp[i][0].id;
                       break;
                    }
                }

                // var id = this.resp.indexOf(this.exercise);
                console.log(id);
                
                var props = {
            
                    workout_id:this.workout_id,
                    id:id,
                    name:val

                }
                console.log(this.resp[id]);
                app.Redirect(this.workout_id+'/addExercise/'+id,{emit:true,name:'exercise',prop:props})
            }
        }
    }
</script>

<style scoped>

</style>