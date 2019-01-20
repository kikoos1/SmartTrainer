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
            <v-flex d-flex xs12 sm6 md4 v-for = 'workout in workouts' :key = 'workout.name'>
                <v-card>

                    <v-card-title primary-title >
                        <div class = " text-xs-center">
                            <div class="headline">{{workout.name}}</div>
                            <span class="grey--text">Date:{{workout.date}}</span>
                        </div>
                    </v-card-title>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn flat class = 'blue--text' to = '/workout'>
                           Learn More
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
        created(){
            var app =this;
            this.$eventBus.$on('close-modal',function () {
                app.show = false;
            })
            this.$eventBus.$on('save',function (data) {
                app.workouts.unshift(data);
                app.show = false;
            })
        }
    }
</script>

<style scoped>

</style>