<script setup>
import Table from "@/Components/Table.vue";

defineProps(['tests']);

const tableColumns = ['Title', ''];
</script>

<template>
    <section class="space-y-6">
        <Table :columns="tableColumns" >
            <tr v-for="test in tests"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ test['title'] }}
                </th>
                <th class="px-6 py-4 flex flex-row gap-x-6">
                    <a
                        :href="route('recruiter-tests.edit', test['id'])"
                        class="underline text-blue-700 hover:text-blue-800">Edit</a>
                    <a
                        :href="route('recruiter-assignment.assign', test['id'])"
                        class="underline text-green-700 hover:text-green-800">Assign</a>
                </th>
            </tr>
        </Table>
    </section>
</template>
