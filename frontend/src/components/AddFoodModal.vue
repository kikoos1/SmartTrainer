<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
<v-card>
    <v-btn icon @click = "Close">
    <v-icon>clear</v-icon>
    </v-btn>
            <v-card-text>
                <v-subheader class="pa-0">Search food</v-subheader>
                <v-autocomplete
                        v-model="food"
                        :items="foods"
                        persistent-hint
                        prepend-icon="mdi-city"
                >
                    <v-slide-x-reverse-transition
                            mode="out-in"
                            slot="append-outer"
                    >
                    </v-slide-x-reverse-transition>
                    <template slot="no-data">
                        <v-list-tile @click = ''>
                            <v-list-tile-action>
                                <v-icon>add</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title>
                                Add this food
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
            food:"",
            foods:[]
        }),
        methods:{
            Close(){

                this.$eventBus.$emit('close-food-modal');
            }
        }
    }
</script>

<style scoped>

</style>