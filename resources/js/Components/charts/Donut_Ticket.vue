<template>
    <div class="flex relative justify-center max-w-md bg-white p-2 rounded-lg shadow-md h-fit">
        <p class="absolute opacity-75 hover:opacity-100 transition ease-in inset-y-0 w-fit h-fit text-xs text-indigo-600 font-semibold">Tickets by priority</p>
        <canvas class="mt-2" id="myDonut"></canvas>
    </div>
</template>

<script setup>

import Chart from 'chart.js/auto'
import {onMounted, ref} from "vue";

const props = defineProps({
    data: Object,
})

const ticket_numbers = ref([]);

onMounted(()=>{
    if(props.data){
        ticket_numbers.value = props.data;
    }


})


onMounted(() => {
    const ctx = document.getElementById('myDonut');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'High',
                'Low',
                'Medium'
            ],
            datasets: [{
                label: '# of Tickets',
                data: [ticket_numbers.value.high, ticket_numbers.value.low, ticket_numbers.value.medium],
                borderWidth: 1,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4

            }]
        },

    });
});

</script>

