<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-2 border-solid border-gray-500 dark:border-gray-500 flex flex-col items-center">
            <img src="https://mamono.world/cdn/shop/files/Untitled_Artwork_-_2022-04-20T124351.815.png?v=1694801988&width=170" class="block w-fit" />

            <h1 class="mt-8 text-3xl font-medium text-gray-900 dark:text-white">
                Welcome to the Mamono dashboard.
            </h1>

            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                Eager to vote on a poll or just curious about the latest poll results? You can find all of that here.
            </p>

            <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                <a :href="route('polls')" class="mt-8 p-4 bg-white dark:bg-gray-900 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-2 border-solid border-gray-500 dark:border-gray-500 rounded-lg transition hover:bg-gray-100 dark:hover:bg-gray-700">
                    <h2 class="text-2xl font-medium text-gray-900 dark:text-white">
                        Latest Poll
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        You can find the latest poll here. Note that polls are only open between monday and wednesday each week.
                    </p>
                </a>

                <a :href="route('archive')" class="mt-8 p-4 bg-white dark:bg-gray-900 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-2 border-solid border-gray-500 dark:border-gray-500 rounded-lg transition hover:bg-gray-100 dark:hover:bg-gray-700">
                    <h2 class="text-2xl font-medium text-gray-900 dark:text-white">
                        Archived items
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        You can find all the archived items the website has here. Keep in mind that not all archived items may be available for reasons.
                    </p>
                </a>

                <a class="mt-8 p-4 bg-white dark:bg-gray-900 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-2 border-solid border-gray-500 dark:border-gray-500 rounded-lg transition hover:bg-gray-100 dark:hover:bg-gray-700">
                    <h2 class="text-2xl font-medium text-gray-900 dark:text-white">
                        User profile
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        You can find your user profile here. Your voting statistics and poll history can be found here. You may also change your login credentials here.
                    </p>
                </a>

                <a class="mt-8 p-4 bg-white dark:bg-gray-900 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-2 border-solid border-gray-500 dark:border-gray-500 rounded-lg transition hover:bg-gray-100 dark:hover:bg-gray-700">
                    <h2 class="text-2xl font-medium text-gray-900 dark:text-white">
                        Mamono webshop
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        You can navigate to the official Mamono webshop here for all purchasable items.
                    </p>
                </a>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
</script>
