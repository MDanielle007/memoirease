<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import Button from "primevue/button";
import DataView from "primevue/dataview";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    diaries: {
        type: Array,
        default: () => [],
    },
});

const confirm = useConfirm();
const toast = useToast();

const confirmDeleteDiary = (id) => {
    confirm.require({
        message: "Do you want to delete this diary?",
        header: "Danger Zone",
        icon: "pi pi-info-circle",
        rejectLabel: "Cancel",
        rejectProps: {
            label: "Cancel",
            severity: "secondary",
            outlined: true,
        },
        acceptProps: {
            label: "Delete",
            severity: "danger",
        },
        accept: () => {
            deleteDiary(id);
        },
    });
};

const deleteDiary = (id) => {
    router.delete(route("diaries.destroy", { diary: id }), {
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success',
                detail: 'Diary deleted successfully',
                life: 3000
            });
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-2 sm:py-4 md:py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-end mx-2 sm:mx-0">
                    <Link :href="route('diaries.create')">
                        <Button
                            icon="pi pi-plus"
                            label="New Diary"
                            class="tracking-widest"
                        />
                    </Link>
                </div>

                <div class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <DataView :value="diaries">
                        <template #header>
                            <h3 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                                My Diaries
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
                                            <p class="text-sm min-h-5 text-gray-600 dark:text-gray-400">
                                                {{ item.description }}
                                            </p>
                                        </div>
                                        <div class="flex grow-3 gap-1 items-center sm:items-end">
                                            <Link
                                                :href="route('diary-entries', { diary: item.id })"
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
                                    You have no diaries yet. Start creating one today!
                                </h4>
                            </div>
                        </template>
                    </DataView>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
