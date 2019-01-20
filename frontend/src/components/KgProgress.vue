<template>
        <div>
                <v-btn
                        fixed
                        dark
                        fab
                        bottom
                        right
                        color="pink"
                        @click = 'show = !show'
                >
                        <v-icon>add</v-icon>
                </v-btn>
        <Chart :chartdata = 'datacollection' :options="{responsive: true, maintainAspectRatio: false} "></Chart>
        <modal :dialog = 'show'></modal>
                <section>
                        <v-list v-for="item in kg" :key = 'item.id'>
                                <v-list-tile>
                                        <v-list-tile-content>
                                                <v-list-tile-title>{{item.date}}</v-list-tile-title>
                                                <v-list-tile-sub-title>{{ item.kg }}kg</v-list-tile-sub-title>


                                        </v-list-tile-content>

                                </v-list-tile>
                                <v-divider></v-divider>
                        </v-list>
                </section>
        </div>
</template>

<script>
        var moment = require('moment');
    import Chart from './Chart'
  import AddKgModal from './AddKgModal'
    export default {
        name: "KgProgress",
        components:{
            Chart,
            'modal':AddKgModal

        },
        data:()=>({
            show:false,
            kg:[],
            datacollection:[],
            gradient: '',
            //kg:[{id:1,kg:85.6,date:'2018-07-27'},{id:1,kg:87.5,date:'2018-07-27'},{id:1,kg:87.9,date:'2018-07-27'},{id:1,kg:30,date:'2018-07-27'}]
        }),
        methods:{
          FillData(){
              var app = this;
              var kilos = {
                  labels:[],
                  datasets:[]
              };
              var kgs = {
                  data:[],
                  borderColor: '#FC2525',
                  pointBackgroundColor: 'white',
                  borderWidth: 1,
                  pointBorderColor: 'black',
                  backgroundColor: this.gradient,
                  label: 'Kg progress',
                  //opacity:0.8

              }
              for(var i = 0;i <this.kg.length;i++) {
                  var newkg = parseFloat(app.kg[i].kg)
                  kgs.data.push(newkg);

                  kilos.labels.push(app.kg[i].date);
                  //console.log(i);

              }
              kilos.datasets.push(kgs);
              app.datacollection = kilos;

                  // this.datacollection = {
                  //     labels: [this.getRandomInt(), this.getRandomInt()],
                  //     datasets: [
                  //         {
                  //             label: 'Data One',
                  //             backgroundColor: '#f87979',
                  //             data: [this.getRandomInt(), this.getRandomInt()]
                  //         }, {
                  //             label: 'Data One',
                  //             backgroundColor: '#f87979',
                  //             data: [this.getRandomInt(), this.getRandomInt()]
                  //         }
                  //     ]
                  // }

          },
            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            }
        },
        computed:{
          data() {

          }
        },

        mounted(){
            this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)


            this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
            this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
            this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');


            this.FillData()


        },
        created(){
            this.FillData();
            var app = this;
          this.$eventBus.$on('save',(kg)=>{
              var newkg ={
                  id:app.getRandomInt(),
                  kg:Number(kg.kg),
                  date:kg.date
              }
              app.kg.push(newkg);
              this.FillData();
              //console.log(app.kg);
              app.show = false;

          })
            this.$eventBus.$on('close-modal',()=>{
                app.show = false;
            })
        },


    }
</script>

<style scoped>

</style>