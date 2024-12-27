<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps(['test']);
const test = props.test;
const questions = test.questions;

const submit = () => {

};
</script>

<template>
    <Head title="Test" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Test doing
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="flex justify-center">
                    <div class="flex flex-col gap-y-4 text-center w-full items-center">
                        <h2 class="text-2xl font-bold">{{test['title']}}</h2>
                        <div v-if="test['description']" class="text-xl font-medium">
                            {{test['description']}}
                        </div>
                        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 w-2/3">
                            <form @submit.prevent="submit" class="flex items-start flex-col gap-y-4">
                                <div v-for="(question, index) in questions" :key="index">
                                    <InputLabel :for="`question_${index}`" :value="question" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
