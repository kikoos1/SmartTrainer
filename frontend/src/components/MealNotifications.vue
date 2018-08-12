<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">Set time for notifications</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex >
                                <v-dialog
                                        ref="breakfastdialog"
                                        v-model="breakfastdialog"
                                        :return-value.sync="breakfast"
                                        persistent
                                        lazy
                                        full-width
                                        width="290px"
                                >
                                    <v-text-field
                                            slot="activator"
                                            v-model="breakfast"
                                            label="Breakfast"
                                            prepend-icon="access_time"
                                            required
                                    ></v-text-field>
                                    <v-time-picker
                                            v-if="breakfastdialog"
                                            v-model="breakfast"
                                    >
                                        <v-spacer></v-spacer>

                                        <v-btn flat color="primary" @click="breakfastdialog = false">Cancel</v-btn>
                                        <v-btn flat color="primary" @click="$refs.breakfastdialog.save(breakfast)">OK</v-btn>
                                    </v-time-picker>
                                </v-dialog>
                            </v-flex> <!----Breakfast-->
                            <v-flex>
                                <v-dialog
                                        ref="lunchdialog"
                                        v-model="lunchdialog"
                                        :return-value.sync="lunch"
                                        persistent
                                        lazy
                                        full-width
                                        width="290px"
                                >
                                    <v-text-field
                                            slot="activator"
                                            v-model="lunch"
                                            label="Lunch"
                                            prepend-icon="access_time"
                                            required
                                    ></v-text-field>
                                    <v-time-picker
                                            v-if="lunchdialog"
                                            v-model="lunch"
                                    >
                                        <v-spacer>
                                        </v-spacer>
                                        <v-btn flat color="primary" @click="lunchdialog = false">Cancel</v-btn>
                                        <v-btn flat color="primary" @click="$refs.lunchdialog.save(lunch)">OK</v-btn>
                                    </v-time-picker>

                                </v-dialog>
                            </v-flex><!---Lunch--->
                            <v-flex>
                                <v-dialog
                                        ref="dinnerdialog"
                                        v-model="dinnerdialog"
                                        :return-value.sync="dinner"
                                        persistent
                                        lazy
                                        full-width
                                        width="290px"
                                >
                                    <v-text-field
                                            slot="activator"
                                            v-model="dinner"
                                            label="Dinner"
                                            prepend-icon="access_time"
                                            required
                                    ></v-text-field>
                                    <v-time-picker
                                            v-if="dinnerdialog"
                                            v-model="dinner"
                                    >
                                        <v-spacer>
                                        </v-spacer>
                                        <v-btn flat color="primary" @click="dinnerdialog = false">Cancel</v-btn>
                                        <v-btn flat color="primary" @click="$refs.dinnerdialog.save(dinner)">OK</v-btn>
                                    </v-time-picker>

                                </v-dialog>
                            </v-flex><!---Dinner--->
                        </v-layout>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="Close()">Close</v-btn>
                    <v-btn color="blue darken-1" flat @click.native="Save()">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        name: "MealNotifications",
        props:['dialog'],
        data:()=>({
            breakfastdialog:false,
            breakfast:null,
            lunchdialog:false,
            lunch:null,
            dinnerdialog:false,
            dinner:null
        }),
        methods:{
            Close(){
              this.$eventBus.$emit('close-modal');
            },
            Save(){
                localStorage.setItem('breakfast',this.breakfast)
                localStorage.setItem('lunch',this.lunch)
                localStorage.setItem('dinner',this.dinner)
                this.Close();
            }
        },
        created(){
            if(localStorage.getItem('breakfast') != null && localStorage.getItem('lunch') != null && localStorage.getItem('dinner') != null){
                this.breakfast = localStorage.getItem('breakfast');
                this.dinner = localStorage.getItem('dinner');
                this.lunch = localStorage.getItem('lunch');
            }
        }
    }
</script>

<style scoped>

</style>