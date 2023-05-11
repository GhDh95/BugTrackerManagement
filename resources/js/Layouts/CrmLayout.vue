<template>
    <div class="md:flex md:flex-row flex flex-col p-2 space-x-2">

        <CrmNavigation></CrmNavigation>

        <div class="w-full min-h-screen  bg-gray-100 border-2  rounded-lg p-2">
            <slot></slot>
        </div>
    </div>
<Flash_Message></Flash_Message>
</template>

<script setup>

import CrmNavigation from "@/Components/CrmNavigation/CrmNavigation.vue";
import Flash_Message from "@/Components/Flash_Message.vue";
</script>

