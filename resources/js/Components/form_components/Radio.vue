<template>
    <div class="border border-gray-200 rounded p-2 text-sm">
        <label for="priority">Priority</label>
        <div id="priority" class="flex space-x-8 mt-4 ">
            <div class="flex space-x-2 items-center">
                <label for="high">High</label>
                <input  type="radio" name="priority" id="high" value="high" :checked="modelValue === 'high'"
                        @change="onPriorityChange($event)">

            </div>

            <div class="flex space-x-2 items-center">
                <label for="medium">Medium</label>
                <input  type="radio" name="priority" id="medium" value="medium" :checked="modelValue === 'medium'"
                        @change="onPriorityChange($event)">

            </div>
            <div class="flex space-x-2 items-center">
                <label for="low">Low</label>
                <input  type="radio" name="priority" id="low" value="low" :checked="modelValue === 'low'"
                        @change="onPriorityChange($event)">

            </div>
        </div>
    </div>
</template>

<script setup>

const emits = defineEmits(['update:modelValue']);

let selectedPriority = '';

const onPriorityChange = (event) => {
    selectedPriority = event.target.value;
    emits('update:modelValue', selectedPriority);
}

</script>

