<template>
    <form @submit.prevent="submit">

        <div class="max-w-2xl md:min-w-[500px] w-[300px] md:w-[500px] px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mt-2">
                <div class="flex items-center space-x-3">
                    <p class="text-xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline" tabindex="0" role="link">{{project['name']}}</p>
                    <span :class="{'text-red-500 font-semibold motion-safe:animate-pulse' : project.developers.length === 0}" class="text-xs text-gray-500">Assign developers to your project!</span>
                </div>
                <p class="mt-2 text-gray-600 dark:text-gray-300 max-h-[100px] border border-gray-200 rounded-lg p-2 overflow-y-auto">{{project['description']}}</p>
            </div>

            <div class="mt-2">
                <TeamsGrid :project_id="project.id" :developers="project.developers"></TeamsGrid>
            </div>

            <div class="flex items-center justify-between mt-4">
                <Button_Component :title="'add developers'"></Button_Component>
                <select v-model="form.developer_id" name="developer_id" multiple class="h-20">
                    <option disabled selected>Assign developers to the project</option>
                    <option :value="developer.id"  v-for="developer in developers" >{{developer.name}}</option>
                </select>
            </div>
            <InputError class="mt-2" :message="form.errors.developer_id" />
            <input type="hidden" v-model="form.project_id">
        </div>
    </form>
</template>

<script setup>

import {useForm, usePage} from "@inertiajs/vue3";
import {computed} from "vue";
import Button_Component from "@/Components/form_components/Button_Component.vue";
import InputError from "@/Components/InputError.vue";
import TeamsGrid from "@/Components/TeamsGrid.vue";

const props = defineProps({
    project: Array
})


const page = usePage();
const developers = computed(() => page.props.developers);

const form = useForm({
    developer_id: null,
    project_id: null
});


const submit = () => {
    form.project_id = props.project.id;
    form.post('/projects/assign-dev', {
        preserveScroll : true
    })
}

</script>

