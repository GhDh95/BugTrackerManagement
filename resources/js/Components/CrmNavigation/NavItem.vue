<template>
    <Link :class="{'text-white ' : active}" as="button" :href="url" :method="method ? method : 'get'" class="text-gray-400 hover:text-gray-200 cursor-pointer w-full text-center ">{{name}}</Link>

</template>

<script setup>
defineProps({
    name:String,
    url: String,
    method: String,
    active: Boolean
})
</script>

