<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from "@/Components/Textarea.vue";
import {ref} from "vue";
import Questions from "@/Pages/Tests/Partials/Questions.vue";

const form = useForm({
    title: '',
    description: '',
    questions: ''
});


const questions = ref([""]);

const submit = () => {
    form.questions = JSON.stringify(questions.value);
    form.post(route('recruiter-tests.create'));
};

</script>

<template>
    <Head title="Create Test" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Create Test
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="flex justify-center">
                    <form @submit.prevent="submit" class="flex flex-col gap-y-4 w-2/3">
                        <div class="shadow-lg">
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="shadow-lg">
                            <InputLabel for="description" value="Description" />

                            <Textarea
                                id="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                            />

                        </div>
                        <Questions v-model="questions"/>

                        <div class="mt-4 flex items-center justify-end">

                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Create
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
