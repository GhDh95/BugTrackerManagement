<template>
    <div class="relative  flex items-center  flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
        <div class="p-6">
            <h5 class= "text-center mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                {{ title }}
            </h5>
            <p class="text-center  block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                {{ body }}
            </p>
        </div>

    </div>
</template>

<script setup>

defineProps({
    title:String,
    body: String
})

</script>

