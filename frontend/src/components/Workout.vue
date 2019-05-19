<template>


    <v-container fluid
                 grid-list-lg>
<v-container class = 'text-lg-center'>
    <v-btn
            fab
            :dark="dark"
            fixed
            bottom
            right
            @click = "dialog = true"
    >
        <v-icon>add</v-icon>

    </v-btn>
</v-container>
        <v-layout row wrap>
            <v-flex xs12 v-for="exercise in exercises" :key="exercise.id">
                <v-card

                         >



                    <v-card-title primary-title>
                    <div>
                        <div class="headline">{{ exercise.exercise.name }}


                                    <v-btn icon @click="DeleteVolume(exercise.id)">
                                        <v-icon>delete</v-icon>
                                    </v-btn>

                        </div>
                    </div>
                    </v-card-title>

                    <v-slide-y-transition>
                        <v-card-text >
                           <v-list>
                               <v-list-tile>
                                   <v-list-tile-title>
                                       {{exercise.kg}}kg X {{exercise.reps}}X{{exercise.sets}} 
                                   </v-list-tile-title>
                                   <v-list-tile-action>
                                       <v-btn icon @click = 'EditVolume'><v-icon>edit</v-icon></v-btn>

                                   </v-list-tile-action>
                               </v-list-tile>
                           </v-list>
                        </v-card-text>
                    </v-slide-y-transition>

                </v-card>


            </v-flex>
            <br><br><br>

        </v-layout>
        <modal :dialog="dialog" :workout_id="this.id"></modal>
    </v-container>

</template>

<script>
    import AddExerciseModal from './AddExerciseModal'
    export default {
        name: "Workout",
        components:{
            modal:AddExerciseModal
        },
        props:['id'],

        data:()=>({
            exercises:[{id:1,name:'Леганка',volume:[{id:1,kg:75,reps:10}]},{id:2,name:'Набиранка',volume:[{id:2,kg:90,reps:3}]}],
            show:false,
            dialog:false,
            dark:localStorage.getItem("dark-theme")

        }),
        methods:{
            FetchData(){
                var app = this;
                this.get('/workout/'+this.id).then(function(resp){
                    app.exercises = resp.exercises;
                })
            },
            EditVolume(volume){

            },
            DeleteVolume(id){
                this.delete('/workout/'+id+'/delete').then(function(){
                    location.reload();
                })
            }
        },
        created(){
            var app = this;
            this.FetchData();
            this.$eventBus.$on('workout',(resp)=>{

            })
            this.$eventBus.$on('close-exercise-modal',()=>{
                app.dialog = false;
            })
        }
    }
</script>

<style scoped>

</style>