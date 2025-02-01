import '../css/app.css';
import '../css/icons.scss';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import MyPreset from './darkBlue';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';

import AppState from './Plugins/appState.js';
import ThemeSwitcher from './Components/ThemeSwitcher.vue';
import { useThemeStore } from './Store/ThemeStore';
import { createPinia } from 'pinia';

const pinia = createPinia();
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const THEME_KEY = 'theme';

function applyTheme(theme) {
	if (theme === 'dark') {
		document.documentElement.classList.add('p-dark');
	} else {
		document.documentElement.classList.remove('p-dark');
	}
}

function initializeTheme() {
	const storedTheme = localStorage.getItem(THEME_KEY) || 'auto';
	const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

	if (storedTheme === 'auto') {
		applyTheme(prefersDark ? 'dark' : 'light');
	} else {
		applyTheme(storedTheme);
	}

	return storedTheme;
}

const initialTheme = initializeTheme();

createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	resolve: (name) =>
		resolvePageComponent(
			`./Pages/${name}.vue`,
			import.meta.glob('./Pages/**/*.vue'),
		),
	setup({ el, App, props, plugin }) {
		const app = createApp({ render: () => h(App, props) });
		// Attach Pinia and stores
		app.use(pinia);

		// Initialize theme store after Pinia setup
		const themeStore = useThemeStore();
		const savedTheme = localStorage.getItem(THEME_KEY) || 'light';

		if (savedTheme== 'dark') {
			themeStore.onThemeToggler();
		}

		// Handle system preference changes only in "auto" mode
		window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
			const storedTheme = localStorage.getItem(THEME_KEY) || 'auto';
			if (storedTheme === 'auto') {
				applyTheme(e.matches ? 'dark' : 'light');
			}
		});

		return app
			.use(PrimeVue, {
				theme: {
					preset: MyPreset,
					options: {
						prefix: 'p',
						darkModeSelector: '.p-dark',
						cssLayer: false,
					}
				}
			})
			.use(plugin)
			.use(AppState)
			.use(ZiggyVue)
			.use(ToastService)
			.use(ConfirmationService)
			.component('ThemeSwitcher', ThemeSwitcher)
			.mount(el);
	},
	progress: {
		color: '#4B5563',
	},
});
