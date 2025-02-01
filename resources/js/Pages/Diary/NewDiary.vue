<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

const toast = useToast();

const form = useForm({
	title: "",
	description: "",
});

const submit = () => {
	form.post(route("diaries.store"), {
		onSuccess: () => {
			form.reset();
			toast.add({
				severity: "success",
				summary: "Success",
				detail: "Diary created successfully",
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
	<Head title="New Diary" />

	<AuthenticatedLayout>
		<template #header>
			<h2
				class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
			>
				New Diary
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
					class="mt-2 w-full mx-auto overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-[#18181b]"
				>
					<form @submit.prevent="submit">
						<div>
							<InputLabel for="title" value="Title" />
							<InputText
								id="title"
								fluid
								v-model="form.title"
								class="mt-1"
							/>
							<InputError
								class="mt-2"
								:message="form.errors.title"
							/>
						</div>

						<div class="mt-4">
							<InputLabel for="description" value="Description" />
							<Textarea
								id="description"
								fluid
								v-model="form.description"
								class="mt-1"
								rows="9"
								cols="30"
							/>
							<InputError
								class="mt-2"
								:message="form.errors.description"
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
