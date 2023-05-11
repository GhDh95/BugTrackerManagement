<template>
    <div class="hidden md:block md:w-1/5 md:min-w-[250px] bg-indigo-950 rounded-lg">
        <div class="flex flex-col items-center  h-screen rounded-lg px-2 space-y-3 mt-20">

            <div v-if="user" class="flex flex-col items-center space-y-2">
                <div class="px-20">
                    <img class="object-cover -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                         :src="'https://i.pravatar.cc/100?img=' + user.id">
                </div>
                <div class="flex flex-col items-center">
                    <p class="font-semibold text-blue-500">Welcome Back</p>
                    <p class="font-semibold text-blue-500">{{ user.name }}</p>
                </div>

            </div>

            <NavItem :active="$page.component ==='Dashboard'" :url="'/'" :name="'Dashboard'" :method="'get'"></NavItem>
            <NavItem :active="$page.component ==='Projects'" :url="'/projects'" :name="'Projects'"
                     :method="'get'"></NavItem>
            <div class="flex justify-center  w-full relative">
                <NavItem :active="$page.component ==='notification/Index'" class="" :url="'/notifications'"
                         :name="'Notifications'" :method="'get'"></NavItem>
                <div v-if="unread_notifications && unread_notifications.length > 0"
                     class="absolute right-8 w-5 h-5 rounded-full bg-white text-red-600 flex justify-center items-center">
                    <p>{{ unread_notifications.length }}</p>
                </div>
            </div>
            <NavItem v-if="page.props.auth.user" :active="page.props.component ===''" :url="'/logout'" :name="'logout'"
                     :method="'post'"></NavItem>

        </div>
    </div>

    <div class="md:hidden">
        <nav class="bg-white shadow dark:bg-gray-800">
            <div
                class="container flex items-center justify-center p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
                <a href="#"
                   class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Dashboard</a>

                <a href="#"
                   class="border-b-2 border-transparent hover:text-gray-800 transition-colors duration-300 transform dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">Projects</a>

                <a href="#"
                   class="border-b-2 border-transparent hover:text-gray-800 transition-colors duration-300 transform dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">Tickets</a>


            </div>
        </nav>
    </div>

</template>

<script setup>

import NavItem from "@/Components/CrmNavigation/NavItem.vue";
import {usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const page = usePage();

const unread_notifications = computed(() => page.props.unread_notifications ?? null);

const user = computed(() => page.props.auth.user);


</script>


