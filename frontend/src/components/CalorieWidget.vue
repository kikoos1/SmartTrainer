<template>
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12>
        <h1>Calories</h1>
    <h3>{{calories}}</h3>
            </v-flex>
        <v-flex xs4>
    <v-progress-circular
            :rotate="360"
            :size="120"
            :width="15"
            :value="protein"
            color="teal"
    >
        <h5>Protein</h5>{{ protein+'/'+protein }}
    </v-progress-circular>
        </v-flex>
        <v-flex xs4>
        <v-progress-circular
                :rotate="360"
                :size="120"
                :width="15"
                :value="protein"
                color="red"
        >
            <h5>Fat</h5>{{ fat+'/'+fat }}
        </v-progress-circular>
        </v-flex>
        <v-flex xs4>
        <v-progress-circular
                :rotate="360"
                :size="120"
                :width="15"
                :value="protein"
                color="primary"
        >
            <h5>Carbs</h5>{{ carbs+'/'+carbs }}
        </v-progress-circular>
        </v-flex>
        </v-layout>

    </v-container>
</template>

<script>
    export default {
        name: "CalorieWidget",
        data:()=>({
            calories:0,
            protein:0,
            carbs:0,
            fat:0

        })
    }
</script>

<style scoped>

</style>