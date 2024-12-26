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
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps(['test']);
const test = props.test ?? false;

const form = useForm({
    title: test['title'] ?? '',
    description: test['description'] ?? '',
    questions: ''
});

const questionsObj = {
    1: { label: "", id: "" }
};

if(test && Object.keys(test['questions']).length){
    let i = 1;
    for(let key of Object.keys( test['questions']))
    {
        questionsObj[i] = { label: test['questions'][key], id: key };
        i++;
    }
}

const questions = ref(questionsObj);

const submit = () => {
    form.questions = JSON.stringify(questions.value);
    if(test && test['id']){
        form.post(route('recruiter-tests.edit', test['id']))
    } else {
        form.post(route('recruiter-tests.create'));
    }
};

const deleteTest = () => {
    if(test && test['id']) {
        form.post(route('recruiter-tests.delete', test['id']))
    }
}

</script>

<template>
    <Head title="Test" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                {{test ? 'Edit' : 'Create'}} Test
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
                            <DangerButton v-if="test" @click.prevent="deleteTest">
                                Delete Test
                            </DangerButton>

                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                {{test ? 'Update' : 'Create'}}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
