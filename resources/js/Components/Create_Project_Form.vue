<template>
    <div class="relative flex flex-col rounded-xl w-fit p-2 bg-white bg-clip-border shadow-none">
        <h4 class="block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
            Create a Project
        </h4>
        <p class="mt-1 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased border-b border-gray-200">
            Fill in the details below.
        </p>
        <form @submit.prevent="submit" class="mt-8 mb-2 w-80 max-w-screen-lg sm:w-96 flex flex-col space-y-2">
            <Input_Component v-model="form.name" :title="'Project title'"></Input_Component>
            <p class="text-sm text-red-500" v-if="form.errors.name">{{form.errors.name}}</p>
            <Textarea_Component v-model="form.description" :message="'Project description'"></Textarea_Component>
            <p class="text-sm text-red-500" v-if="form.errors.description">{{form.errors.description}}</p>
            <List_Component v-model="form.manager_id"></List_Component>
            <p class="text-sm text-red-500" v-if="form.errors.manager_id">{{form.errors.manager_id}}</p>
            <Button_Component :title="'Create Project'"></Button_Component>
        </form>
    </div>
</template>

<script setup>

import Input_Component from "@/Components/form_components/Input_Component.vue";
import Textarea_Component from "@/Components/form_components/Textarea_Component.vue";
import Button_Component from "@/Components/form_components/Button_Component.vue";
import List_Component from "@/Components/form_components/List_Component.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    name: null,
    description: null,
    manager_id: null
})

const submit = () => {
    form.post('/projects', {
        preserveScroll : true,
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>

