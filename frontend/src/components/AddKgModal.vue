<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="headline">Добави</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex>
                                <v-text-field  type ='number' label="Kg" v-model = 'kg.kg' step = 'any' required></v-text-field>
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
                                            v-model="kg.date"
                                            label="Дата"
                                            hint="MM/DD/YYYY format"
                                            persistent-hint
                                            prepend-icon="event"
                                            @blur="kg.date = parseDate(kg.date)"
                                            requred

                                    ></v-text-field>
                                    <v-date-picker v-model="kg.date" no-title @input="menu1 = false"></v-date-picker>
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
        name: "AddKgModal",
        props:['dialog'],
        data:()=>({
            dateFormatted: null,
            edit:false,
            kg:{
                kg:0,
                date:this.dateFormatted
            },
            menu1:false,

        }),
        methods:{
            Close(){
                this.$eventBus.$emit('close-modal')
            },
            Save(){
                var app = this;
                if(!this.edit) {



                    this.post('/kg/add', {
                        kg: this.kg.kg,
                        date: this.kg.date
                    }).then(function () {
                        app.kg = []
                    })
                    this.$eventBus.$emit('save', this.kg);
                }else{

                    this.patch('/kg/update', {
                        id:this.kg.id,
                        kg: this.kg.kg,
                        date: this.kg.date
                    }).then(function () {
                        app.kg = []
                    })
                    this.$eventBus.$emit('save');
                }
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
            },
            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
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
        created() {
            this.$eventBus.$on('edit',(resp)=>{
                this.kg = {
                    id:resp.id,
                    kg:resp.kg,
                    date:resp.created_at
                }
                this.edit = true;
            })
        }

    }
</script>

<style scoped>

</style>