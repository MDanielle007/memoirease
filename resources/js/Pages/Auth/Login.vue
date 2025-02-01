<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import GoogleLoginButton from "@/Components/GoogleLoginButton.vue";

defineProps({
	canResetPassword: {
		type: Boolean,
	},
	status: {
		type: String,
	},
});

const form = useForm({
	email: "",
	password: "",
	remember: false,
});

const submit = () => {
	form.post(route("login"), {
		onFinish: () => form.reset("password"),
	});
};
</script>

<template>
	<GuestLayout>
		<Head title="Log in" />

		<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
			{{ status }}
		</div>

		<form @submit.prevent="submit">
			<div class="flex flex-col gap-1">
				<InputLabel for="email" value="Email" />
				<InputText
					id="email"
					v-model="form.email"
					aria-describedby="username-help"
				/>
				<InputError :message="form.errors.email" />
			</div>

			<div class="mt-4">
				<InputLabel for="password" value="Password" />
				<Password
					v-model="form.password"
					:feedback="false"
					toggleMask
					fluid
				/>
				<InputError :message="form.errors.password" />
			</div>

			<div class="mt-4 block">
				<label class="flex items-center">
					<CheckBox name="remember" binary v-model="form.remember" />
					<span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
						>Remember me</span
					>
				</label>
				<Link
					v-if="canResetPassword"
					:href="route('password.request')"
					class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
				>
					Forgot your password?
				</Link>
				<br />
			</div>

			<div class="mt-4 flex flex-col items-center justify-center">
				<Button
					label="LOG IN"
					size="small"
					class="w-full tracking-widest"
					:disabled="form.processing"
					type="submit"
				/>

				<Divider align="center"
					><span class="text-gray-400">or</span></Divider
				>

				<GoogleLoginButton class="w-full flex justify-center" />
			</div>
			<div class="mt-6 mb-2 text-center">
				<p class="text-sm text-gray-600 dark:text-gray-400">
					Don't have an account?
					<Link
						:href="route('register')"
						class="font-bold hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
						>Sign up</Link
					>
				</p>
			</div>
		</form>
	</GuestLayout>
</template>
