
<template>
    <div class="flex flex-col items-center space-y-4">

        <Create_Project_Form v-if="auth.user.role === 'admin' "></Create_Project_Form>
        <div class=" max-h-[500px] overflow-y-auto" v-if="auth.user.role === 'manager'">

                <Assign_developers  class="mb-2" :project="project" v-for="project in auth.team"></Assign_developers>

        <div v-if="auth.team.length === 0">
            <p class="font-semibold text-red-400 border border-black/20 rounded-lg p-2">You have not been assigned any Projects! Please Contact the admin.</p>
        </div>

        </div>
        <div class=" w-full max-h-[300px] overflow-y-auto bg-white p-2 rounded-lg" v-if="auth.user.role === 'developer'">
            <div class="">Your assigned projects</div>
            <div v-for="proj in auth.user.developer_projects" class="border border-gray-300 rounded mt-2">
                <Link :href="'/project/' + proj.id" class="p-1 font-semibold">
                    <span class="font-thin text-xs text-gray-400 pr-2">name</span>
                    {{proj.name}}</Link>
            </div>
        </div>
        <Project_table :projects="props.projects.data" :links="props.projects.links"></Project_table>

    </div>


</template>



<script setup>
import Create_Project_Form from "@/Components/Create_Project_Form.vue";
import Project_table from "@/Components/Project_table.vue";
import Assign_developers from "@/Components/Assign_developers.vue";

const props = defineProps({
    projects: Object,
    auth: Object,
    unassigned_projects: Object
})

const get_devs = (my_arr, id) => my_arr.filter(x => x.id === id);


</script>
