<script setup>
import InputLabel from "@/Components/InputLabel.vue";

const questions = defineModel();

const addQuestion = () => {
    if(Object.keys(questions.value).length < 10){
        const newId = Object.keys(questions.value).length + 1;
        questions.value[newId] = { label: "", id: "" };
    }
};

const removeQuestion = () => {
    if (Object.keys(questions.value).length > 1) {
        delete questions.value[Object.keys(questions.value).length];
    }
};

</script>

<template>
    <div
        class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
    >
        <h3>Questions</h3>
        <div class="flex flex-col gap-y-4 p-4">
            <div v-for="(question, index) in questions" :key="index">
                <InputLabel :for="`question_${index}`" :value="`Question ${index}`" />

                <input
                    :id="`question_${index}`"
                    type="text"
                    v-model="question.label"
                    required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
            </div>
        </div>
        <div class="flex flex-row gap-x-3 w-full justify-center pt-6">
            <button  class="hover:text-blue-600" @click.prevent="addQuestion()">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>
            <button  class="hover:text-red-600" @click.prevent="removeQuestion()">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>
        </div>
    </div>
</template>
