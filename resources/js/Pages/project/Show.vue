<template>
<div class="">
    <Project_Card :can_show="can_create_ticket" :project="project"></Project_Card>
    <Ticket_Table :project_id="project.id" :tickets="tickets"></Ticket_Table>

</div>
</template>


<script setup>

import Project_Card from "@/Components/Project_Card.vue";
import Ticket_Table from "@/Components/Ticket_Table.vue";

const props = defineProps({
    project: Object,
    tickets: Object,
    can_create_ticket: Boolean
})


</script>

