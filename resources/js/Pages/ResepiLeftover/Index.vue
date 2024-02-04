<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
const form = useForm({
    search: "",
});

const useSearch = () => {
    form.get(route("recipe.index"), {
        only: ["recipe"],
    });
};
</script>

<template>
    <AppLayout title="Discover More">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">Discover More</h2>
        </template>

        <div class="w-full max-w-full mb-4 bg-transparent">
            <div class="my-4">
                <div
                    class="font-sans text-black bg-white flex items-center justify-center lg:w-1/4"
                >
                    <div
                        class="border rounded overflow-hidden grid grid-cols-6 w-full"
                    >
                        <input
                            v-model="form.search"
                            type="text"
                            class="px-4 py-2 col-span-5"
                            placeholder="Cari Resipi Leftover"
                        />
                        <button
                            class="flex items-center justify-center px-4 border-l"
                            @click="useSearch"
                        >
                            <svg
                                class="h-4 w-4 text-grey-dark"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">
                Resepi Terkini
            </h4>

            <div class="mt-8 grid lg:grid-cols-3 gap-10">
                <template v-for="(r, i) in $page.props.recipe.data" :key="i">
                    <Link
                        v-if="r.slug"
                        :href="route('recipe.show', { recipe: r.slug })"
                    >
                        <div
                            class="relative h-64 w-full flex items-end justify-start text-left bg-cover bg-center"
                        >
                            <img
                                :src="r.image"
                                alt="stew"
                                class="w-full h-full absolute object-cover"
                            />
                            <div
                                class="absolute top-0 mt-20 right-0 bottom-0 left-0 bg-gradient-to-b from-transparent to-gray-900"
                            ></div>
                            <div
                                class="absolute top-0 right-0 left-0 mx-5 mt-2 flex justify-between items-center"
                            ></div>
                            <main class="p-5 z-10">
                                <a
                                    href="#"
                                    class="text-md tracking-tight font-medium leading-7 font-regular text-white hover:underline"
                                    >{{ r.title }}
                                </a>
                                <span class="text-white">
                                    ({{
                                        new Date(r.created_at).getDate() +
                                        " " +
                                        new Date(r.created_at).toLocaleString(
                                            "default",
                                            { month: "long" },
                                        )
                                    }})</span
                                >
                            </main>
                        </div>
                    </Link>
                </template>
            </div>
        </div>
    </AppLayout>
</template>
