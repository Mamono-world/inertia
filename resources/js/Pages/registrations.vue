<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    users: Array
});

async function approveUser(id) {
    await axios('/api/user/status', {
        method: 'PUT',
        data: {
            user: id,
            status: true
        }
    });
}

async function rejectUser(id) {
    await axios('/api/user/status', {
        method: 'PUT',
        data: {
            user: id,
            status: false
        }
    });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6 overflow-x-auto">
                    <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg text-black dark:text-white">
                        <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Discord</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users" :key="user.id"
                            class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="py-4 px-6">{{ user.id }}</td>
                            <td class="py-4 px-6">{{ user.name }}</td>
                            <td class="py-4 px-6">{{ user.email }}</td>
                            <td class="py-4 px-6 flex gap-4 align-center">
                                <button @click="approveUser(user.id)" class="text-green-500 border-solid border-2 rounded-xl border-green-500 p-2 hover:bg-green-800 hover:text-white">Approve</button>
                                <button @click="rejectUser(user.id)" class="text-red-500 border-solid border-2 rounded-xl border-red-500 p-2 hover:bg-red-800 hover:text-white">Reject</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <h2 v-if="users.length === 0" class="text-2xl w-full text-center text-black dark:text-white p-3">There are no users in need of approval!</h2>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
