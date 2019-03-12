<template>
    <div>
    <v-btn
            color="green"
            dark
            fixed
            bottom
            right
            fab
            @click = "show = true"
    >
        <v-icon>add</v-icon>

    </v-btn>
        <add-gym-progress-widget :dialog="show"></add-gym-progress-widget>
    <v-container grid-list-sm fluid align-content-center>
        <v-layout row wrap>
            <v-flex d-flex xs12 sm6 md4 v-for = 'workout in workouts' :key = 'workout.id'>
                <v-card>

                    <v-card-title primary-title >
                        <div class = " text-xs-center">
                            <div class="headline">{{workout.name}} <v-btn icon flat @click = 'Delete(workout.id)'><v-icon>delete</v-icon></v-btn></div>
                            <span class="grey--text">Дата:{{workout.created_at}}</span>
                        </div>
                    </v-card-title>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn flat class = 'blue--text' :to = "'/workout/' + workout.id">
                           Научи повече
                        </v-btn>
                    </v-card-actions>
                </v-card>
                <br>
            </v-flex>
        </v-layout>

    </v-container>
    </div>
</template>

<script>
    export default {
        name: "Progress",
        data:()=>({
            show:false,
            workouts:[]
        }),
        methods:{
          FetchData(){
              var app = this;
              this.get('/workouts').then(function(resp){
                  app.workouts = resp.workouts;
              });
          }, 
          Delete(id){
              var app=this;
              this.delete('workout/'+id+'/delete').then(function(){
                  app.FetchData();
              })
          }
        },
        created(){
            var app =this;
            this.FetchData();
            this.$eventBus.$on('close-modal',function () {
                app.show = false;
            })
            this.$eventBus.$on('save',()=>{
                app.FetchData();
                app.show = false;
            })
        }
    }
</script>

<style scoped>

</style>