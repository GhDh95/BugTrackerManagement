<template>
    <section class="bg-white dark:bg-gray-900">

        <div class="container px-6 py-8 mx-auto">
            <h2 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white bg-gray-100 px-2 rounded-lg">Our Team</h2>

            <div class="p-2">
              <div class="grid md:grid-cols-3 gap-2 border-b border-gray-300 pb-6">
                  <div class="border border-gray-300 rounded-lg min-h-[80px]" v-for="developer in props.developers">
                      <div class="relative flex flex-row w-full justify-between">
                      <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">{{developer.name}}</h3>
                          <Link class="absolute right-0 bg-indigo-200/40 rounded-full flex items-center scale-75" :href="'/projects/developer/destroy/'" :data="{developer_id : developer.id, project_id: project_id}" as="button" method="delete">
                                                        <span class="material-symbols-outlined ">
close
</span>
                          </Link>
                      </div>

                      <span class="mt-1 font-medium text-gray-600 dark:text-gray-300">{{developer.role}}</span>


                  </div>

              </div>





            </div>
        </div>
    </section>
</template>

<script setup>
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    developers: Object,
    project_id: Number
})

console.log(props.developers);

const page = usePage();

const developers = computed(() => page.props.auth.team ? page.props.auth.team : null);



</script>


