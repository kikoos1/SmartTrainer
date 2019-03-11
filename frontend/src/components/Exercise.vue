<template>
    <v-container fluid
                 grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-text-field
                    type="text"
                    label="Име"
                    v-model = "exercise.name"
                ></v-text-field>
            </v-flex>
            <v-flex xs12 >
                <v-text-field v-show = 'add'
                        type="number"
                        label="Повторения"
                        v-model = "reps"
                ></v-text-field>
            </v-flex>
                <v-flex xs12 >
                    <v-text-field v-show = 'add'
                            type="number"
                            label="Серии"
                            v-model = "sets"
                    ></v-text-field>
                </v-flex>
                    <v-flex xs12 >
                        <v-text-field v-show = 'add'
                                type="number"
                                label="Товар(KG)"
                                v-model = "kg"
                        ></v-text-field>
                    </v-flex>
            <v-flex xs12>
                <v-btn @click = "AddOrUpdateExercise">{{ update ? 'Update' : 'Add' }}</v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Exercise",
        props:['id','exercise_id'],
        data:()=>({
            exercise:{
                name:'',
                id:0
            },
            update:false,
            add:false,
            reps:0,
            sets:0,
            kg:0,
            resp:''
        }),
        methods:{
           AddOrUpdateExercise(){
               var app = this;
               if(this.add&this.update){
                   this.post('workout/exercises/add',{
                       id:this.exercise_id,
                       workout_id:this.id,
                       reps:this.reps,
                       sets:this.sets,
                       kg:this.kg

                   }).then(function(){
                       app.$router.push('/workout/'+app.id)
                   })
               }else{
                   this.post('/exercise/add',{
                       name:this.exercise.name
                       
                   }).then(function(){
                       app.$router.push('/workout/'+app.id)
                   })
               }
           },
           FetchExercise(){
               var app = this;
               this.get('exercise/'+this.exercise_id).then(function(resp){
                   app.exercise.id = app.exercise_id;
                   app.exercise.name = resp.exercise.name;
               })
           }
        },
        created(){
            var app = this;
            if(this.id == 'undefined' || this.workout_id == 'undefined'|| isNaN(this.id) ){
                this.add = false;
            }else{
                this.FetchExercise();
                this.add = true;
                this.update=true
            }
        }
    }
</script>

<style scoped>

</style>