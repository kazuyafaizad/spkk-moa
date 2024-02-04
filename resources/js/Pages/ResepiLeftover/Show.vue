<script setup>
import RatingStar from "@/Components/RatingStar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    recipe_recommend: Object,
});

const checkURL = (url) => {
    const urlRegex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
    return urlRegex.test(url);
};
</script>

<template>
    <AppLayout title="Tambah Discover More">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c] text-left">
                Resepi Leftover {{ $page.props.recipe.title }}
            </h2>

            <RatingStar />
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                <img
                    :src="
                        checkURL($page.props.recipe.image)
                            ? $page.props.recipe.image
                            : '/' + $page.props.recipe.image
                    "
                    class="w-full"
                />
                <div
                    class="w-full mx-auto py-4"
                    v-html="$page.props.recipe.description"
                ></div>
            </div>
        </div>
        <h3 class="text-xl mt-12">Cadangan Discover More Lain</h3>
        <div class="mt-8 grid lg:grid-cols-5 gap-10">
            <template v-for="(r, i) in $page.props.recipe_recommend" :key="i">
                <Link :href="route('recipe.show', { recipe: r.slug })">
                    <div
                        class="relative h-64 w-full flex items-end justify-start text-left bg-cover bg-center"
                    >
                        <img
                            :src="checkURL(r.image) ? r.image : '/' + r.image"
                            alt="stew"
                            class="w-full h-full absolute object-cover"
                        />
                        <div
                            class="absolute top-0 mt-20 right-0 bottom-0 left-0 bg-gradient-to-b from-transparent to-gray-900"
                        ></div>
                        <div
                            class="absolute top-0 right-0 left-0 mx-5 mt-2 flex justify-between items-center"
                        >
                            <!-- <a href="#"
                                class="text-xs bg-indigo-600 text-white px-5 py-2 uppercase hover:bg-white hover:text-indigo-600 transition ease-in-out duration-500">{{
                                    r.created_by_user.name }}</a> -->
                            <div
                                class="text-white font-regular flex flex-col justify-start"
                            >
                                <span
                                    class="text-3xl leading-0 font-semibold"
                                    >{{ r.title }}</span
                                >
                            </div>
                        </div>
                    </div>
                </Link>
            </template>
        </div>
    </AppLayout>
</template>
