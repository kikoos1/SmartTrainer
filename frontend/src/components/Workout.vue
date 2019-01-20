<template>


    <v-container fluid
                 grid-list-lg>
<v-container class = 'text-lg-center'>
    <v-btn
            color="purple"
            fab
            dark
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
                        <div class="headline">{{ exercise.name }}


                                    <v-btn icon @click="DeleteVolume(exercise)">
                                        <v-icon>delete</v-icon>
                                    </v-btn>

                        </div>
                    </div>
                    </v-card-title>

                    <v-slide-y-transition>
                        <v-card-text >
                           <v-list>
                               <v-list-tile v-for = 'v in exercise.volume' :key = 'v.id'>
                                   <v-list-tile-title>
                                       {{v.kg}}kg X {{v.reps}}
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
        <modal :dialog="dialog"></modal>
    </v-container>

</template>

<script>
    import AddExerciseModal from './AddExerciseModal'
    export default {
        name: "Workout",
        components:{
            modal:AddExerciseModal
        },

        data:()=>({
            exercises:[{id:1,name:'Леганка',volume:[{id:1,kg:75,reps:10}]},{id:2,name:'Набиранка',volume:[{id:2,kg:90,reps:3}]}],
            show:false,
            dialog:false

        }),
        methods:{
            EditVolume(volume){

            },
            DeleteVolume(exercise){
                var id = this.exercises.indexOf(exercise);
                this.exercises.splice(id,1)
            }
        },
        created(){
            var app = this;
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