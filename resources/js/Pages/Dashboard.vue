<template>
    <div class="w-full grid gap-2 grid-cols-1 md:grid-cols-3 overflow-x-auto">
        <Card_Info :body="props.general_metrics.number_of_projects" :title="'Number of Projects'"></Card_Info>
        <Card_Info :body="props.general_metrics.number_of_tickets" :title="'Number of Tickets'"></Card_Info>
        <div class="relative flex items-center md:w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="p-6">
                <h5 class= "text-center mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                    Organization
                </h5>
                <div class="flex w-full space-x-2">
                    <div class=" text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60 py-1 px-2">admin : {{props.general_metrics.number_of_admins}}
                    </div>
                    <div class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">dev : {{props.general_metrics.number_of_developers}}</div>
                    <div class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">manager : {{props.general_metrics.number_of_managers}}</div>
                </div>
            </div>

        </div>
    </div>

   <div class="grid md:grid-cols-2 mt-4 gap-2 overflow-x-auto">
       <div class="flex flex-col space-y-2 ">
           <Bar_Chart class="" :data="bar_chart"></Bar_Chart>
       </div>
       <Donut_Ticket class="" :data="donut_data"></Donut_Ticket>
   </div>

</template>

<script setup>

import Card_Info from "@/Components/dashboard/Card_Info.vue";
import Bar_Chart from "@/Components/charts/Bar_Chart.vue";
import Donut_Ticket from "@/Components/charts/Donut_Ticket.vue";
import Bubble_Chart from "@/Components/charts/Bubble_Chart.vue";

const props = defineProps({
    bar_chart:Object,
    donut_data: Object,
    general_metrics: Object,
})



</script>
