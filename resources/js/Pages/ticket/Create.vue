<template>
   <form @submit.prevent="submit" class="flex flex-col space-y-2 max-w-xl mx-auto bg-white px-2 py-4 rounded-lg mt-10">
       <Input_Component v-model="form.name" :title="'name'"></Input_Component>
       <InputError :message="form.errors.name"></InputError>
       <Input_Component v-model="form.summary" :title="'summary'"></Input_Component>
       <InputError :message="form.errors.summary"></InputError>
       <Textarea_Component v-model="form.description" :message="'description'"></Textarea_Component>
       <InputError :message="form.errors.description"></InputError>
       <Radio v-model="form.priority"></Radio>
       <InputError :message="form.errors.priority"></InputError>
       <div class="flex flex-col space-y-2 border border-gray-200 rounded p-2">
           <label class="text-sm" for="status">status</label>
           <select v-model="form.status" class="peer h-full md:w-1/5 text-center rounded-[7px] border border-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0  placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:ring-0 focus:ring-pink-500  focus:border-pink-500 focus:outline-none disabled:border-0 disabled:bg-blue-gray-50" name="status" id="status">
               <option value="open">open</option>
               <option value="closed">closed</option>
           </select>
           <InputError :message="form.errors.status"></InputError>
       </div>
       <input type="text" hidden v-model="form.project_id">

       <Button_Component :title="title"></Button_Component>
   </form>
</template>
<script setup>

import {defineComponent} from "vue";
import Input_Component from "@/Components/form_components/Input_Component.vue";
import Textarea_Component from "@/Components/form_components/Textarea_Component.vue";
import Radio from "@/Components/form_components/Radio.vue";
import Button_Component from "@/Components/form_components/Button_Component.vue";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    name: null,
    summary: null,
    description: null,
    priority:null,
    status: null,
    project_id:null

})

let title = 'create';

const props = defineProps({
    project_id:Number,
    ticket: Object
});

form.project_id = props.project_id;

if(props.ticket){
    form.name = props.ticket.name;
    form.summary = props.ticket.summary;
    form.description = props.ticket.description;
    form.priority = props.ticket.priority;
    form.status = props.ticket.status;
    title = 'update';
    console.log(props.ticket.name);

}


const route = "/ticket/store";


const submit = () => {
    if(props.ticket){
        let r = "/ticket/update/" + props.ticket.id;
        form.patch(r, {
            preserveScroll : true,

        });
    }else{
    form.post(route, {
        preserveScroll : true,
        onSuccess: () => {
            form.reset();
        }
    })

    }
}


</script>


