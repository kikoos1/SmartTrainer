<template>
    <v-container fluid
                 grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-text-field
                    type="text"
                    placeholder="Name"
                    v-model = "exercise.name"
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
        data:()=>({
            exercise:{
                name:'',
                id:0
            },
            update:false
        }),
        methods:{
           AddOrUpdateExercise(){
               if(this.update){
                   this.post('/exercise/'+this.exercise.id+'/edit',{
                       name:this.exercise.name
                   })
               }else{
                   this.post('/exercise/add',{
                       name:this.exercise.name
                   })
               }
           }
        }
    }
</script>

<style scoped>

</style>