<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import GoogleLoginButton from "@/Components/GoogleLoginButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
	username: "",
	email: "",
	password: "",
	password_confirmation: "",
});

const submit = () => {
	form.post(route("register"), {
		onFinish: () => form.reset("password", "password_confirmation"),
	});
};

</script>

<template>
	<GuestLayout>
		<Head title="Register" />
		<form @submit.prevent="submit">
			<div>
				<InputLabel for="username" value="Username" />
				<InputText
					id="username"
					fluid
					v-model="form.username"
					class="mt-1"
				/>
				<InputError class="mt-2" :message="form.errors.username" />
			</div>

			<div class="mt-4">
				<InputLabel for="email" value="Email" />
				<InputText id="email" fluid v-model="form.email" class="mt-1" />
				<InputError class="mt-2" :message="form.errors.email" />
			</div>

			<div class="mt-4">
				<InputLabel for="password" value="Password" />
				<Password
					v-model="form.password"
					:feedback="true"
					toggleMask
					fluid
				>
					<template #header>
						<div class="font-semibold text-xm mb-4">
							Pick a password
						</div>
					</template>
					<template #footer>
						<Divider />
						<ul class="pl-2 ml-2 my-0 leading-normal">
							<li>At least one lowercase</li>
							<li>At least one uppercase</li>
							<li>At least one numeric</li>
							<li>Minimum 8 characters</li>
						</ul>
					</template>
				</Password>

				<InputError class="mt-2" :message="form.errors.password" />
			</div>

			<div class="mt-4">
				<InputLabel
					for="password_confirmation"
					value="Confirm Password"
				/>
				<Password
					v-model="form.password_confirmation"
					:feedback="false"
					toggleMask
					fluid
				/>
				<InputError
					class="mt-2"
					:message="form.errors.password_confirmation"
				/>
			</div>

			<div class="mt-4 flex flex-col gap-1 items-center">
				<Link
					:href="route('login')"
					class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
				>
					Already registered?
				</Link>
				<Button
					label="REGISTER"
					size="small"
					class="w-full tracking-widest"
					:disabled="form.processing"
					type="submit"
				/>
				<Divider align="center"
					><span class="text-gray-400">or</span></Divider
				>
				<GoogleLoginButton class="w-full flex justify-center"/>
			</div>
		</form>
	</GuestLayout>
</template>
