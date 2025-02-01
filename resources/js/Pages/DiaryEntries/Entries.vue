<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
	diary:{
		type: Object,
		required: true
	},
	entries:{
		type: Array,
        required: true
	}
})

</script>
<template>
    <Head title="Diary Entries" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ diary.title }} Entries
            </h2>
        </template>

        <div class="py-2 sm:py-4 md:py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between mx-2 sm:mx-0">
                    <Link :href="route('dashboard')">
						<Button
							icon="pi pi-arrow-left"
							label="Back"
							class="tracking-widest"
						/>
					</Link>
					<Link :href="route('diary-entries.create')">
                        <Button
                            icon="pi pi-plus"
                            label="New Entry"
                            class="tracking-widest"
                        />
                    </Link>
                </div>

                <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <DataView :value="diaryEntries">
                        <template #header>
                            <h3 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">

                            </h3>
                        </template>
                        <template #list="slotProps">
                            <div class="flex flex-col">
                                <div
                                    v-for="(item, index) in slotProps.items"
                                    :key="item.id"
                                >
                                    <div
                                        class="flex flex-col sm:justify-between sm:flex-row p-6 gap-2"
                                        :class="{
                                            'border-t border-surface-200 dark:border-surface-700':
                                                index !== 0,
                                        }"
                                    >
                                        <div class="w-full flex flex-col items-start">
                                            <h4 class="text-lg font-bold">
                                                {{ item.title }}
                                            </h4>
                                            <p class="text-sm min-h-5 max-h-10 text-gray-600 dark:text-gray-400 truncate">
                                                {{ item.description }}
                                            </p>
                                        </div>
                                        <div class="flex grow-3 gap-1 items-center sm:items-end">
                                            <Link
                                                :href="route('diaries.show', { diary: item.id })"
                                                class="w-full"
                                            >
                                                <Button
                                                    label="View Entries"
                                                    class="min-w-40 w-full"
                                                />
                                            </Link>
                                            <Link
                                                :href="route('diaries.edit', { diary: item.id })"
                                            >
                                                <Button
                                                    variant="outlined"
                                                    icon="pi pi-pencil"
                                                    severity="info"
                                                    class="min-w-10"
                                                />
                                            </Link>
                                            <Button
                                                variant="outlined"
                                                icon="pi pi-trash"
                                                severity="danger"
                                                @click="confirmDeleteDiary(item.id)"
                                                class="min-w-10"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template #empty>
                            <div class="flex justify-center py-4">
                                <h4 class="text-gray-500 dark:text-gray-400">
									Start sharing your story! Create your first entry.
                                </h4>
                            </div>
                        </template>
                    </DataView>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
