<template>

<div class=" flex justify-center overflow-auto bg-white p-2 rounded-lg shadow-md h-fit">
    <canvas class="" id="myChart"></canvas>
</div>
</template>

<script setup>
import Chart from 'chart.js/auto'
import {onMounted, ref} from "vue";

const props = defineProps({
    data: Object,
})

const managerNames = ref([]);
const projectNumbers = ref([]);

onMounted(() => {
    if (props.data) {
        props.data.forEach(item => {
            let s;
            if(item.manager_name.length > 7){
                s = item.manager_name.slice(7) + "...";
            }else{
                s = item.manager_name;
            }
            managerNames.value.push(s);
            projectNumbers.value.push(item.number_of_projects);
        });
    }
})




onMounted(() => {
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: managerNames.value,
            datasets: [{
                label: '# of Projects',
                data: projectNumbers.value,
                borderWidth: 1,
                backgroundColor:[
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ]
            }]
        },

        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

</script>


