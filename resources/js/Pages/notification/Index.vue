<template>

<div class="flex flex-col max-h-screen overflow-y-auto space-y-2">
    <div :id="notification.id" v-for="notification in notifications" class="border border-black rounded-lg p-2">
<div class="flex space-x-2">
    <p class="border-b-2 border-indigo-900 text-xl pb-2 cursor-pointer">Message:
    </p>
    <Link v-if="notification.read_at === null" :href="'/notification/mark-as-read'" :data="{notification_id: notification.id}" method="post" as="button" class="hover:opacity-75 text-sm hover:underline bg-gray-600 px-2 py-1 rounded-lg text-white">mark as read</Link>

        <span v-if="notification.read_at !== null" class="text-xs text-green-900 self-center">read</span>
</div>
        <p class="mt-2"><span>{{notification.data.message}}</span></p>
        <Link class="hover:underline text-sm" :href="notification.data.link">visit</Link>
    </div>

</div>

    <div v-if="notifications.length === 0">
        <p class="text-center text-2xl mt-20">No notifications!</p>
    </div>
</template>


<script setup>

import {usePage} from "@inertiajs/vue3";
import {computed, ref, watch} from "vue";

const page = usePage();

const notifications_ = computed(() =>
    page.props.unread_notifications
)

const notifications = ref(notifications_);




console.log(notifications.value);
</script>
