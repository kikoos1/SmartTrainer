
<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">Добави нова тренировка</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex>
                                <v-text-field label="Име" v-model = 'workout.name' required></v-text-field>
                            </v-flex>
                            <v-flex>
                                <v-menu
                                        ref="menu1"
                                        :close-on-content-click="false"
                                        v-model="menu1"
                                        :nudge-right="40"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                >
                                    <v-text-field
                                            slot="activator"
                                            v-model="workout.date"
                                            label="Дата"
                                            hint="MM/DD/YYYY format"
                                            persistent-hint
                                            prepend-icon="event"
                                            @blur="workout.date = parseDate(workout.date)"
                                            requred

                                    ></v-text-field>
                                    <v-date-picker v-model="workout.date" no-title @input="menu1 = false"></v-date-picker>
                                </v-menu>
                            </v-flex>

                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click.native="Close()">Затвори</v-btn>
                    <v-btn color="blue darken-1" flat @click.native=" Save()">Запази</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    export default {
        name: "AddGymProgress",
        props:['dialog'],
        data:()=>({
            dateFormatted: null,
            workout:{
                name:'',
                date:this.dateFormatted
            },
            menu1:false,

        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal')
            },
            Save(){
                this.post('workouts/add',{
                    name:this.workout.name,
                    date:this.workout.date
                }).then(function(){
                    this.$eventBus.$emit('save');
                    this.workout.name = null;
                    this.workout.date = null ;
                })


            },
            formatDate (date) {
                if (!date) return null

                const [year, month, day] = date.split('-')
                return `${month}/${day}/${year}`
            },
            parseDate (date) {
                if (!date) return null

                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            }
        },
        computed: {
            computedDateFormatted () {
                return this.formatDate(this.date)
            }
        },
        watch: {
            date (val) {
                this.dateFormatted = this.formatDate(this.date)
            }
        },

    }
</script>

<style scoped>

</style>