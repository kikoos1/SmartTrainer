<template>
    <div class="container">
        <canvas ref="canvas" width="900" height="400"></canvas>
    </div>
</template>

<script>
    import { Line } from 'vue-chartjs'
    import reactiveProp from 'vue-chartjs'

    export default {
        extends: Line,
        props: ['chartdata', 'options'],
        data:()=>({
           chartData:this.chartdata
        }),
        watch: {
            chartdata: {
                handler: function (val) {
                    //this._chart.update
                    this.renderChart(this.chartdata, this.options)
                },
                deep: true
            }
        },
        mixins: [reactiveProp],
        mounted () {

            this.renderChart(this.chartdata, this.options)
        }
    }
</script>

<style scoped>

</style>