<template>
    <div class="flex justify-center max-w-5xl mx-auto">
        <div class="w-full px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
            <div class="flex items-center justify-between">
                <span class="text-sm font-light text-gray-600 dark:text-gray-400">created at : {{ formattedDate }}</span>
                <Link v-if="showing" :href="'/ticket/create'" :data="{project_id : project.id}">
                    <button_-component :title="'Create Ticket'"></button_-component>
                </Link>
            </div>

            <div class="mt-2">
                <p class="text-xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline">{{project.name}}</p>
                <p class="mt-2 text-gray-600 dark:text-gray-300">{{project.description}}
                </p>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="border border-gray-400 rounded-lg w-1/2 max-h-[75px] overflow-y-auto ">
                    <p class="text-xs text-gray-800 font-semibold px-2 border-b border-gray-600 sticky top-0 bg-gradient-to-r from-blue-500 to-blue-600 py-1">Team:</p>
                    <p class="text-xs" v-if="project.developers.length === 0">No team members so far.</p>
                    <div v-for="dev in project.developers">
                        <p class="text-center p-1 ">{{dev.name}}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <img class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block" :src="'https://i.pravatar.cc/100?img=' + project.manager.id" alt="avatar">
                    <p class="font-bold text-gray-700 dark:text-gray-200">{{ project.manager.name }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import Button_Component from "@/Components/form_components/Button_Component.vue";
import {ref} from "vue";

const props = defineProps({
    project: Object,
    can_show: Boolean
})

let show = ref(props.can_show) ;
let showing = show.value;

const date = new Date('2023-05-08T16:03:17.000000Z');
const formattedDate = date.toLocaleDateString();
</script>
