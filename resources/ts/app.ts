import { createInertiaApp } from "@inertiajs/vue3";
import { DefineComponent, createApp, h } from "vue";
import "../css/app.css";
import "./bootstrap";

declare global {
    interface ImportMeta {
        glob: <T>(path: string, opt: T) => Promise<DefineComponent>;
    }
}

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
