<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from "@/Components/Table.vue";

const props = defineProps(['assignments']);

</script>

<template>
    <Head title="Assignments" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Assignments
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Table :columns="['User Email', 'Test Title', 'Status', '']" >
                    <tr v-for="assignment in assignments"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ assignment['user_email'] }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ assignment['test_title'] }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ assignment['status'] }}
                        </th>
                        <th class="px-6 py-4">
                            <a
                                v-if="assignment['status'] === 'Completed'"
                                :href="route('recruiter-assignment.show', assignment['id'])"
                               class="underline text-blue-700 hover:text-blue-800"
                            >
                                Check
                            </a>
                        </th>
                    </tr>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
