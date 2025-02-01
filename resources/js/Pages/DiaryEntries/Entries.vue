<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
	diary: {
		type: Object,
		required: true,
	},
	entries: {
		type: Array,
		required: true,
	},
});

const confirm = useConfirm();
const toast = useToast();

const confirmDeleteEntry = (id) => {
	confirm.require({
		message: "Do you want to delete this entry?",
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
			deleteEntry(id);
		},
	});
};

const deleteEntry = (id) => {
	router.delete(route("diary-entries.destroy", { diary_entry: id }), {
		onSuccess: () => {
			toast.add({
				severity: "success",
				summary: "Success",
				detail: "Entry deleted successfully",
				life: 3000,
			});
		},
	});
};
</script>
<template>
	<Head title="Diary Entries" />

	<AuthenticatedLayout>
		<template #header>
			<h2
				class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
			>
				{{ diary.title }} Entries
			</h2>
		</template>

		<div class="py-2 sm:py-4 md:py-6">
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div class="flex justify-between mx-2 sm:mx-0">
					<Link :href="route('dashboard')">
						<Button
							variant="outlined"
							icon="pi pi-arrow-left"
							label="Back"
							class="tracking-widest"
						/>
					</Link>
					<Link
						:href="
							route('diary-entries.create', { diary: diary.id })
						"
					>
						<Button
							icon="pi pi-plus"
							label="New Entry"
							class="tracking-widest"
						/>
					</Link>
				</div>

				<div
					class="mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
				>
					<ScrollPanel style="width: 100%" class="h-svw sm:h-96">
						<DataView :value="entries" class="h-full">
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
											<div
												class="w-full flex justify-between"
											>
												<div>
													<h4
														class="text-lg font-bold"
													>
														{{ item.entry_title }}
													</h4>
													<p
														class="text-sm min-h-5 max-h-10 text-gray-600 dark:text-gray-400 truncate"
													>
														{{ item.content }}
													</p>
												</div>
												<sup class="">
													{{ item.entry_date }}
												</sup>
											</div>
											<div
												class="flex grow-3 gap-1 items-center sm:items-end"
											>
												<Link
													:href="
														route('diary-entries.edit', {
															diary_entry: item.id,
														})
													"
													class="w-full"
												>
													<Button
														label="View"
														class="min-w-40 w-full"
													/>
												</Link>
												<Button
													variant="outlined"
													icon="pi pi-trash"
													severity="danger"
													@click="
														confirmDeleteEntry(
															item.id
														)
													"
													class="min-w-10"
												/>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template #empty>
								<div class="flex h-full justify-center py-4">
									<p class="text-gray-500 dark:text-gray-400">
										Start sharing your story! Create your
										first entry.
									</p>
								</div>
							</template>
						</DataView>
					</ScrollPanel>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
