<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from "@/Components/Table.vue";

defineProps(['tests']);
</script>

<template>
    <Head title="Tests" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Tests
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                        <Table :columns="['Title', '']" >
                            <tr v-for="test in tests"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ test['title'] }}
                                </th>
                                <th class="px-6 py-4 flex flex-row gap-x-6">
                                    <a
                                        :href="route('candidate-tests.execute', test['id'])"
                                        class="underline text-blue-700 hover:text-blue-800">Do</a>
                                </th>
                            </tr>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
