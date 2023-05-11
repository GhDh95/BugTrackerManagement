<template>
    <div class=" flex justify-center overflow-auto bg-white p-2 rounded-lg shadow-md h-fit">
        <canvas class="" id="myBubble"></canvas>
    </div>
</template>

<script setup>
import Chart from 'chart.js/auto'
import {onMounted, ref} from "vue";

const props = defineProps({
    data: Object,
})

const dataset = ref([]);

dataset.value = props.data;

console.log(dataset.value[0].x);

onMounted(() => {




    const ctx = document.getElementById('myBubble');

    new Chart(ctx, {
        type: 'line',
        data : {
            datasets: [{
                label: 'First Dataset',
                data: dataset.value,
                backgroundColor: 'rgb(255, 99, 132)'
            }]
        },

        options: {
            responsive: true,

        }
    });
});


</script>
