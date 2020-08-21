
<template>

    <canvas id="myChart"    ></canvas>

</template>


<script>

    import { Line, mixins,Bar } from 'vue-chartjs'
    //const { reactiveProp } = mixins
    import Chart from 'chart.js';

    export default {
       // extends:Bar,
       // mixins: [mixins.reactiveData],
        props: {
            chartdata: {
                type: Array,
                default: null
            },
            options: {
                type: Object,
                default: null
            }
        },
        data(){
            return{
                chartData:this.chartdata,
                myChart:null,
                dataFinal:{},
            }
        },
        name: "chartForlIveUser",


        mounted () {
            this.dataFinal=this.chartdata;
            var ctx = document.getElementById('myChart');
            var currentdate = new Date();
            this.myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [currentdate.getDate() + "/"
                    + (currentdate.getMonth()+1)  + "/"
                    + currentdate.getFullYear() + " @ "
                    + currentdate.getHours() + ":"
                    + currentdate.getMinutes() + ":"
                    + currentdate.getSeconds()
                    ],
                    datasets: [{
                        label: '# of Users',
                        data: this.dataFinal,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        methods:{

            updateData(data){
                var currentdate = new Date();
                var label=currentdate.getDate() + "/"
                    + (currentdate.getMonth()+1)  + "/"
                    + currentdate.getFullYear() + " @ "
                    + currentdate.getHours() + ":"
                    + currentdate.getMinutes() + ":"
                    + currentdate.getSeconds();
                var th =this;
                this.dataFinal=data;
                var dataset=[
                    {
                        label: '# of Users',
                        data: this.dataFinal,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                    }
                ];

                // this.myChart.data.datasets.data = [];
                // this.myChart.data.labels = [];
                // this.myChart.data.datasets.label = null;

                this.myChart.data.labels.push(label);
                this.myChart.data.datasets=dataset;
                console.log('Update called From Root ');


                this.myChart.update();
            }

        },
        watch:{
            dataFinal(){
                var label=['live'];

                var th=this;




            }
        }

    }
</script>

<style scoped>

</style>
