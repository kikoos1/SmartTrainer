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
        <Chart :data = 'data' :options = '{responsive:true}'></Chart>
        <add-kg-modal :dialog = 'show'></add-kg-modal>
        </div>
</template>

<script>
import AddKgModal from './AddKgModal'
  import  Chart from './Chart'
    export default {
        components:{
        'add-kg-modal':AddKgModal
    },
        name: "KgProgress",
        data:()=>({
            show:false,
            kg:[{id:1,kg:85.6,date:'2018-07-27'},{id:1,kg:87.5,date:'2018-07-27'},{id:1,kg:87.9,date:'2018-07-27'},{id:1,kg:30,date:'2018-07-27'}]
        }),
        computed:{
          data(){
            var app = this;
              var kilos = {
                  labels:[],
                  datasets:[]
              };
              var kgs = {
                  data:[],
                  label: 'Kg progress',
                  backgroundColor: '#f87979     '

              }
              for(var i = 0;i <this.kg.length;i++) {
                    kgs.data.push(this.kg[i].kg);

                  kilos.labels.push(app.kg[i].date)

                  }
                    console.log(kgs.data)
                  kilos.datasets.push(kgs);
              return kilos
          }

        },
        components:{
            Chart

        }
    }
</script>

<style scoped>

</style>