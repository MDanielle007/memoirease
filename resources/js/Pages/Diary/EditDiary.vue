<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref } from "vue";
import { useToast } from "primevue";

const toast = useToast();

const props = defineProps({
	diary: {
		type: Object,
		required: true,
	},
});

const form = useForm({
	title: props.diary.title,
	description: props.diary.description,
});

const title = ref(...[form.title]);

const submit = () => {
	form.put(route("diaries.update", props.diary.id), {
		onSuccess: () => {
			toast.add({
				severity: "success",
				summary: "Success",
				detail: "Diary updated successfully",
				life: 3000,
			});
		},
	});
};
</script>

<template>
	<Head title="New Diary" />

	<AuthenticatedLayout>
		<template #header>
			<h2
				class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
			>
				Edit Diary: {{ title }}
			</h2>
		</template>
		<div class="py-2 sm:py-4 md:py-6">
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div class="flex justify-start mx-2 sm:mx-0">
					<Link :href="route('dashboard')">
						<Button
							variant="outlined"
							icon="pi pi-arrow-left"
							label="Back"
							class="tracking-widest"
						/>
					</Link>
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
