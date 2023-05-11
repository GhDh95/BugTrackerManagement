import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import {Link} from "@inertiajs/vue3";
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
import CrmLayout from "@/Layouts/CrmLayout.vue";
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
        resolve: name => {
            const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
            let page = pages[`./Pages/${name}.vue`]
            page.default.layout = page.default.layout || CrmLayout
            return page
        },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('Link',Link)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
