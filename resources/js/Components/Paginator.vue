<template>
    <div class="items-center  md:flex gap-x-3">
        <Component :href="link.url" :class="{'text-blue-500 bg-blue-100/60' : link.active, 'text-gray-600' : !link.url}" :is="link.url ? 'Link' : 'span'" class="px-2 py-1 text-sm  rounded-md dark:bg-gray-800"  v-for="link in links" v-html="link.label"></Component>
    </div>
</template>

<script setup>

defineProps({
    links: Object
})

</script>

