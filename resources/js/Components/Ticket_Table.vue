<template>
    <section class=" mt-4 max-w-7xl mx-auto overflow-auto py-2">
        <div class="flex items-center">
            <div class="md:flex md:flex-row md:justify-between md:w-full flex flex-col space-y-2">
                <div class="flex space-x-2 items-center">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Tickets</h2>
                    <span class="h-7 w-7 text-center flex items-center justify-center text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ tickets.data.length }}</span>

                </div>
                <Search_Component :route="'/project/' + project_id"></Search_Component>
            </div>

        </div>

        <div v-if="tickets.data.length > 0" class="flex flex-col mt-6">
            <div class="-mx-4 -my-2  sm:-mx-6 lg:-mx-8">
                <div class="  py-2 align-middle md:px-6 lg:px-8">
                    <div class="border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="divide-y divide-gray-200 dark:divide-gray-700 w-full">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-x-3">
                                        Developer name
                                    </div>
                                </th>

                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2">
                                        <span>Status</span>
                                    </button>
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2">
                                        <span>Ticket name</span>

                                    </button>
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Ticket Summary</th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Priority</th>

                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody  class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            <tr v-for="ticket in tickets.data">
                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center gap-x-3">

                                        <div class="flex items-center gap-x-2">
                                            <img class="object-cover w-10 h-10 rounded-full" :src="'https://i.pravatar.cc/100?img=' + ticket.developer.id" alt="">
                                            <div>
                                                <h2 class="font-medium text-gray-800 dark:text-white ">{{ ticket.developer.name }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                        <h2 class="text-sm font-normal text-emerald-500">{{ ticket.status }}</h2>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap truncate">{{ticket.name}}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap truncate">{{ticket.summary}}</td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <p v-if="ticket.priority ==='low'" class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                            {{ ticket.priority }}</p>
                                        <p v-if="ticket.priority ==='medium'" class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">
                                            {{ ticket.priority }}</p>
                                        <p v-if="ticket.priority ==='high'" class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">
                                            {{ ticket.priority }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-x-6">
                                        <Link as="button" :href="'/ticket/destroy/' + ticket.id" method="delete" class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </Link>

                                        <Link method="get" as="button" :href="'/ticket/update/' + ticket.id" class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </Link>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="flex justify-center">
        <Paginator v-if="tickets.data.length > 0" class="mt-2 self-center" :links="tickets.links"></Paginator>

    </div>
</template>

<script setup>


import Paginator from "@/Components/Paginator.vue";
import Search_Component from "@/Components/form_components/Search_Component.vue";

const props = defineProps({
    tickets:Object,
    project_id:Number
})

console.log(props.tickets);
</script>

