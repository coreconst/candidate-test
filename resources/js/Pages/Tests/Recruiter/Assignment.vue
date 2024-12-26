<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from "@/Components/Table.vue";
import { router } from '@inertiajs/vue3'

const props = defineProps(['users', 'test']);
const test = props.test;

const assign = (userId) => {
    router.post(route('recruiter-assignment.assign', test['id']), {userId: userId});
}
</script>

<template>
    <Head title="Assign Test" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Assign <span class="italic">'{{test['title']}}'</span>
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Table :columns="['Name', 'Email', '']" >
                    <tr v-for="user in users"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user['name'] }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user['email'] }}
                        </th>
                        <th class="px-6 py-4 flex flex-row gap-x-6">
                            <button @click="assign(user['id'])" class="underline text-blue-700 hover:text-blue-800">Set</button>
                        </th>
                    </tr>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
