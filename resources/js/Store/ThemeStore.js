import { defineStore } from 'pinia'
export const useThemeStore = defineStore('theme', {
	state: () => ({
		darkTheme: false,
		iconClass: 'pi-moon'
	 }),
	getters: {
	},
	actions: {
		onThemeToggler() {
            const root = document.getElementsByTagName('html')[0];

            root.classList.toggle('p-dark');

            this.iconClass = this.iconClass === 'pi-moon' ? 'pi-sun' : 'pi-moon';
        },
	},
})
