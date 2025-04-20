<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <div class="flex flex-col justify-center">
                    <div class="lg:col-start-2">
                        <div class="text-center">
                            <h3 class="text-2xl font-semibold">Welcome back!</h3>
                            <p class="mt-4 text-lg">
                                Please log in to continue.
                            </p>
                        </div>

                        <div class="mt-10 flex justify-center space-x-4">
                            <Link
                                v-if="canLogin"
                                :href="route('login')"
                                class="bg-gray-200 rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:focus-visible:ring-white"
                            >
                                Login
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="border-gray-200 border-solid border-2 rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
