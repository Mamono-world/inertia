<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';
import AppLayout from "@/Layouts/AppLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const showModal = ref(false);
const fileInput = ref(null);

const form = reactive({
    title: '',
    description: '',
    file: null,
    display: true,
    preorder: false,
});

function handleFileChange(event) {
    const file = event.target.files[0];
    form.file = file;
}

function submitForm() {
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('description', form.description);
    formData.append('file', form.file);
    formData.append('file_name', form.file.name);
    formData.append('file_type', form.file.type);
    formData.append('display', form.display ? 1 : 0);
    formData.append('preorder', form.preorder ? 1 : 0);

    axios.post(route('archive.upload'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    })
        .then((res) => {
            console.log('Upload successful:', res.data);
            showModal.value = false;
        })
        .catch((err) => {
            console.error('Upload failed:', err);
        });
}
</script>



<template>
    <AppLayout title="Archive">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Archive</h2>
                <button @click="showModal = true" v-if="$page.props.auth.user.admin" class="uploadButton">
                    Upload Image
                </button>
            </div>
        </template>

        <!-- Modal -->
        <div v-if="showModal" class="darkBackground flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg max-w-md shadow-xl relative w-1/2">
                <h3 class="text-lg font-bold mb-4 text-white">Upload Image</h3>
                <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="space-y-3 flex flex-col gap-2">
                        <input v-model="form.title" type="text" placeholder="Title" />
                        <textarea v-model="form.description" placeholder="Description"></textarea>
                        <input class="dark:text-white" ref="fileInput" @change="handleFileChange" type="file" />
                        <label class="dark:text-white"><input type="checkbox" v-model="form.display" /> Display</label>
                        <label class="dark:text-white"><input type="checkbox" v-model="form.preorder" /> Preorder</label>
                    </div>

                    <div class="flex justify-end mt-4 gap-2 text-white">
                        <danger-button type="button" @click="showModal = false">Cancel</danger-button>
                        <primary-button type="submit">Upload</primary-button>
                    </div>
                </form>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold dark:text-white">Uploaded Images</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                            <div v-for="image in $page.props.archive" :key="image.id" class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg">
                                <img :src="image.file_path" alt="" class="w-full h-auto rounded-lg" />
                                <h4 class="mt-2 font-semibold dark:text-white">{{ image.title }}</h4>
                                <p class="dark:text-white">{{ image.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<style scoped>
.uploadButton {
    @apply dark:bg-green-400 p-2 rounded-lg text-white font-bold;
}

.darkBackground {
    @apply fixed inset-0 bg-black bg-opacity-90
}

input[type="text"], textarea {
    @apply dark:text-white bg-transparent border-b-2 border-l-0 border-r-0 border-t-0 border-solid border-b-blue-700 focus:border-blue-500 focus:outline-none p-2;
}
</style>
