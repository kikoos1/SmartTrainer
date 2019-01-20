<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="290">
            <v-card>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click.native="Close()" class = 'ws-close-modal-button'>X</v-btn>
                </v-card-actions>
                <v-card-title class="headline">Nutrition facts</v-card-title>
                <v-card-text>
                    <h1>Protein</h1>
                    <v-progress-linear v-model="protein"></v-progress-linear>
                    <h1>Carbs</h1>
                    <v-progress-linear v-model="carbs"></v-progress-linear>
                    <h1>fat</h1>
                    <v-progress-linear v-model="fat"></v-progress-linear>
                </v-card-text>

            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        name: "Nutrition",
        props:['dialog'],
        data:()=>({
            protein:0,
            carbs:0,
            fat:0
        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal');
            }
        }
    }
</script>

<style scoped>
    .ws-close-modal-button{
        top: 0;
        right: 0;
    }

</style>