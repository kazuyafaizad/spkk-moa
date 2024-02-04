import "./bootstrap";
import "../css/app.css";
import "bootstrap-icons/font/bootstrap-icons.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import VueGtag from "vue-gtag";
import "../../node_modules/vue-multiselect/dist/vue-multiselect.css";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueGtag, {
                config: { id: "G-71PYXLVLYE" },
            })
            .mount(el);
    },
    progress: {
        color: "#22577a",
    },
});
