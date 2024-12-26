<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TestList from "@/Pages/Tests/Partials/TestList.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps(['tests'])
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
                <a :href="route('recruiter-tests.create')">
                    <PrimaryButton>New Test</PrimaryButton>
                </a>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                   <TestList :tests="tests"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
