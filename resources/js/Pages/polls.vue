<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    polls: Array
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
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Week</th>
                            <th class="py-3 px-6 text-left">Updated last</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr @click="router.visit(`poll/${poll.id}`)" v-for="poll in polls" :key="poll.id"
                            class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 hover:cursor-pointer">
                            <td class="py-4 px-6">{{ poll.title }}</td>
                            <td class="py-4 px-6">{{ poll.status }}</td>
                            <td class="py-4 px-6">{{ poll.week }}-{{ poll.year }}</td>
                            <td class="py-4 px-6">{{ new Date(poll.updated_at).toLocaleString().replace(/\//g, '-') }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <h2 v-if="polls.length === 0" class="text-2xl w-full text-center text-black dark:text-white p-3">There are no open polls at the moment.</h2>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
