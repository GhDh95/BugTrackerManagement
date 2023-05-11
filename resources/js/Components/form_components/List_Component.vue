<template>
    <label class="text-sm md:pl-2 text-gray-600" for="manager_id">Assign a Manager</label>
    <select
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        name="manager_id" class="peer h-full w-full rounded-[7px] border border-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0  placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:ring-0 focus:ring-pink-500  focus:border-pink-500 focus:outline-none disabled:border-0 disabled:bg-blue-gray-50">
        <option v-bind:id="manager.id" v-for="manager in managers" :value="manager.id">{{ manager.name }}</option>
    </select>
</template>

<script setup>

import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

defineProps(['modelValue'])
defineEmits(['update:modelValue'])

const page = usePage();
const managers = computed(() => page.props.managers);
</script>
