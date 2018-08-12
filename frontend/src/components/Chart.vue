<template>
    <div class="container">
        <canvas ref="canvas" width="900" height="400"></canvas>
    </div>
</template>

<script>
    import { Line } from 'vue-chartjs'

    export default {
        extends: Line,
        props: ['data', 'options'],
        mounted () {
            this.renderChart(this.data, this.options)
        }
    }
</script>

<style scoped>

</style>