<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps(['test']);
const test = props.test;
const questions = test.questions;
const existingAnswers = test.answers;

const answers = Object.fromEntries(
    Object.keys(questions).map(key => [key, existingAnswers[key] ?? ''])
);

</script>

<template>
    <Head title="Completed Test" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Completed Test
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
                            <div class="flex items-start flex-col gap-y-4">
                                <div class="w-full flex flex-col items-start gap-y-2 border-b" v-for="(question, index) in questions" :key="index">
                                    <InputLabel :for="`answer_${index}`" :value="question" />
                                    <div class="text-lg font-medium">
                                        {{answers[index]}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
