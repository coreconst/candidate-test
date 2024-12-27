<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['test']);
const test = props.test;
const questions = test.questions;

const answersObj = Object.fromEntries(
    Object.keys(questions).map(key => [key, ''])
);

const answers = ref(answersObj);

const submit = () => {
    router.post(route('candidate-tests.execute', test['id']), {'answers': answers.value});
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
                                <div class="w-full flex flex-col items-start gap-y-2" v-for="(question, index) in questions" :key="index">
                                    <InputLabel :for="`answer_${index}`" :value="question" />
                                    <input
                                        :id="`answer_${index}`"
                                        type="text"
                                        v-model="answers[index]"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    />
                                </div>
                                <PrimaryButton class="self-end">Done</PrimaryButton>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
