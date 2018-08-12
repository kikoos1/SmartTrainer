<template>
            <v-container grid-list-sm fluid align-content-center>
                <v-layout row wrap>
                    <v-flex d-flex xs12 sm6 md4>
                        <v-card>
                            <v-card-media
                                    src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
                                    height="200px"
                            >
                            </v-card-media>

                            <v-card-title primary-title>
                                <div>
                                    <div class="headline">Top western road trips</div>
                                    <span class="grey--text">1,000 miles of wonder</span>
                                </div>
                            </v-card-title>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn icon class = 'red'>
                                    <v-icon class = 'white--text'>keyboard_arrow_right</v-icon>
                                </v-btn>
                            </v-card-actions>

                            <v-slide-y-transition>
                                <v-card-text >
                                    I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.
                                </v-card-text>
                            </v-slide-y-transition>
                        </v-card>
                    </v-flex>
                </v-layout>

            </v-container>
</template>

<script>
    export default {
        name: "Blog",
        data:()=>({

        }),
        methods:{

        },
        created(){

        }
    }
</script>

<style scoped>

</style>