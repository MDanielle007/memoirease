<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
	<Toast/>
    <div
        class="flex h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-[#09090b]"
    >
        <div class="flex flex-col justify-center items-center">
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>

            <h1 class="text-2xl font-bold text-gray-800 dark:text-white sm:text-3xl">
                MemoirEase
            </h1>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-[#18181b]"
        >
            <slot />
        </div>
    </div>
</template>
