<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { formatDate } from "@/Utils/formatUtils";

const toast = useToast();

const props = defineProps({
	diary: {
		type: Object,
		required: true,
	},
});

const form = useForm({
	diary_id: props.diary.id,
	entry_title: "",
	content: "",
	entry_date: new Date(),
});

const submit = () => {
	form.entry_date = formatDate(form.entry_date);
	form.post(route("diary-entries.store"), {
		onSuccess: () => {
			form.reset();
			toast.add({
				severity: "success",
				summary: "Success",
				detail: "Entry created successfully",
				life: 3000,
			});
		},
	});
};

const goBack = () => {
	if (window.history.length > 1) {
		window.history.back();
	} else {
		this.$inertia.visit("/");
	}
};
</script>

<template>
	<Head title="New Entry" />

	<AuthenticatedLayout>
		<template #header>
			<h2
				class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
			>
				New Entry
			</h2>
		</template>
		<div class="py-2 sm:py-4 md:py-6">
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div class="flex justify-start mx-2 sm:mx-0">
					<Button
						variant="outlined"
						@click="goBack"
						icon="pi pi-arrow-left"
						label="Back"
						class="tracking-widest"
					/>
				</div>

				<div
					class="mt-2 w-full mx-auto overflow-hidden bg-white px-6 py-4 shadow-md sm:rounded-lg dark:bg-[#18181b]"
				>
					<form @submit.prevent="submit">
						<div class="grid grid-cols-6 gap-2">
							<div class="col-span-6 sm:col-span-4">
								<InputLabel for="entry_title" value="Title" />
								<InputText
									id="entry_title"
									fluid
									v-model="form.entry_title"
									class="mt-1"
								/>
								<InputError
									class="mt-2"
									:message="form.errors.entry_title"
								/>
							</div>

							<div class="col-span-6 sm:col-span-2">
								<InputLabel value="Date" />
								<DatePicker
									v-model="form.entry_date"
									:manualInput="false"
									dateFormat="MM dd, yy"
									showIcon
									class="mt-1"
									fluid
									iconDisplay="input"
								/>
								<InputError
									class="mt-2"
									:message="form.errors.entry_date"
								/>
							</div>
						</div>

						<div class="mt-4">
							<InputLabel for="content" value="Content" />
							<Textarea
								id="content"
								fluid
								v-model="form.content"
								class="mt-1"
								rows="9"
								cols="30"
							/>
							<InputError
								class="mt-2"
								:message="form.errors.content"
							/>
						</div>

						<div class="flex items-center justify-end mt-6">
							<Button
								type="submit"
								label="SAVE"
								class="mr-2 tracking-widest"
								icon="pi pi-check"
							/>
							<Button
								label="CLEAR"
								class="tracking-widest"
								variant="outlined"
								@click="form.reset()"
							/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
