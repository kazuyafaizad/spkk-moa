<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import Logo from "../../img/logo.png";
import Profile from "../../img/hanif.png";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route("logout"));
};

const back = () => {
    window.history.back();
};
</script>

<template>
    <div class="app-bg">
        <Head :title="title" />

        <Banner />

        <!--  BEGIN NAVBAR  -->
        <div class="social hidden lg:block">
            <a href="https://www.facebook.com/swcorpMY" target="_blank">
                <div class="social-btn bg-[#3b5999]">
                    <p class="order-1">Facebook</p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-facebook order-last text-white"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"
                        />
                    </svg>
                </div>
            </a>
            <a href="https://www.instagram.com/swcorp_my" target="_blank">
                <div class="social-btn bg-[#e4405f]">
                    <p class="order-1">Instagram</p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-instagram order-last text-white"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
                        />
                    </svg>
                </div>
            </a>
            <a href="https://twitter.com/swcorp_my?lang=en" target="_blank">
                <div class="social-btn bg-[#55acee]">
                    <p class="order-1">Twitter</p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-twitter order-last text-white"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"
                        />
                    </svg>
                </div>
            </a>
            <a href="https://www.youtube.com/@swchannel6360" target="_blank">
                <div class="social-btn bg-[#cd201f]">
                    <p class="order-1">Youtube</p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-youtube order-last text-white"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"
                        />
                    </svg>
                </div>
            </a>
        </div>

        <div
            class="header-container"
            :class="{ 'h-screen overflow-scroll': showingNavigationDropdown }"
        >
            <header
                class="header navbar navbar-expand-sm relative flex flex-wrap items-center content-between py-3 px-4 max-w-7xl mx-auto"
            >
                <div class="nav-logo self-center flex flex-row">
                    <a
                        class="navbar-brand pt-1 pb-1 mr-4 text-lg whitespace-no-wrap flex flex-row items-center gap-2"
                        href="/"
                    >
                        <img alt="logo swcorp" :src="Logo" class="max-w-full" />
                        <span class="navbar-brand-name lg:text-2xl"
                            >mySWCorp</span
                        ></a
                    >
                </div>

                <ul class="navbar-item flex-row mr-auto">
                    <li class="self-center search-animated">
                        <!-- <form class="flex items-center search-full flex items-center search" role="search">
                        <div class="search-bar">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded search-form-control  lg:ml-auto" placeholder="Search...">
                        </div>
                    </form> -->
                    </li>
                </ul>

                <ul class="navbar-item flex-row nav-dropdowns">
                    <li class="relative notification-dropdown hidden">
                        <a
                            id="notificationDropdown"
                            href="javascript:void(0);"
                            class="py-2 px-4 no-underline inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-bell"
                            >
                                <path
                                    d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"
                                ></path>
                                <path
                                    d="M13.73 21a2 2 0 0 1-3.46 0"
                                ></path>
                                </svg><span
                                class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-green-500 text-white hover:green-600"
                            ></span>
                        </a>
                        <div
                            class="left-0 z-50 float-left hidden list-reset py-2 mt-1 text-base bg-white border border-gray-300 rounded absolute animated fadeInUp"
                            aria-labelledby="notificationDropdown"
                        >
                            <div class="notification-scroll">
                                <div
                                    class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"
                                >
                                    <div class="flex items-start server-log">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-server"
                                        >
                                            <rect
                                                x="2"
                                                y="2"
                                                width="20"
                                                height="8"
                                                rx="2"
                                                ry="2"
                                            ></rect>
                                            <rect
                                                x="2"
                                                y="14"
                                                width="20"
                                                height="8"
                                                rx="2"
                                                ry="2"
                                            ></rect>
                                            <line
                                                x1="6"
                                                y1="6"
                                                x2="6"
                                                y2="6"
                                            ></line>
                                            <line
                                                x1="6"
                                                y1="18"
                                                x2="6"
                                                y2="18"
                                            ></line>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="data-info">
                                                <h6 class="">
                                                    Server Rebooted
                                                </h6>
                                                <p class="">45 min ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-x"
                                                >
                                                    <line
                                                        x1="18"
                                                        y1="6"
                                                        x2="6"
                                                        y2="18"
                                                    ></line>
                                                    <line
                                                        x1="6"
                                                        y1="6"
                                                        x2="18"
                                                        y2="18"
                                                    ></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"
                                >
                                    <div class="flex items-start">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-heart"
                                        >
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                                            ></path>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="data-info">
                                                <h6 class="">
                                                    Licence Expiring Soon
                                                </h6>
                                                <p class="">8 hrs ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-x"
                                                >
                                                    <line
                                                        x1="18"
                                                        y1="6"
                                                        x2="6"
                                                        y2="18"
                                                    ></line>
                                                    <line
                                                        x1="6"
                                                        y1="6"
                                                        x2="18"
                                                        y2="18"
                                                    ></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"
                                >
                                    <div class="flex items-start file-upload">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-file-text"
                                        >
                                            <path
                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                            ></path>
                                            <polyline
                                                points="14 2 14 8 20 8"
                                            ></polyline>
                                            <line
                                                x1="16"
                                                y1="13"
                                                x2="8"
                                                y2="13"
                                            ></line>
                                            <line
                                                x1="16"
                                                y1="17"
                                                x2="8"
                                                y2="17"
                                            ></line>
                                            <polyline
                                                points="10 9 9 9 8 9"
                                            ></polyline>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="data-info">
                                                <h6 class="">
                                                    Kelly Portfolio.pdf
                                                </h6>
                                                <p class="">670 kb</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-check"
                                                >
                                                    <polyline
                                                        points="20 6 9 17 4 12"
                                                    ></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li
                        class="relative user-profile-dropdown lg:order-0 order-1 nav-item dropdown hidden lg:block order-lg-0"
                    >
                        <Dropdown
                            v-if="$page.props.auth.user"
                            width="48"
                        >
                            <template #trigger>
                                <button
                                    v-if="
                                        $page.props.jetstream
                                            .managesProfilePhotos
                                    "
                                    type="button"
                                    class="flex text-sm border-2 border-transparent rounded-full text-[#22577a] transition items-center gap-2 font-bold leading-4"
                                >
                                    <img
                                        class="h-8 w-8 rounded-full object-cover"
                                        :src="
                                            $page.props.auth.user
                                                .profile_photo_url
                                                ? $page.props.auth.user
                                                      .profile_photo_url
                                                : Profile
                                        "
                                        :alt="$page.props.auth.user.name"
                                    />
                                    {{
                                        $page.props.auth.user
                                            ? $page.props.auth.user.name
                                            : "Pelawat"
                                    }}
                                </button>

                                <span v-else class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                    >
                                        {{
                                            $page.props.auth.user
                                                ? $page.props.auth.user.name
                                                : "Pelawat"
                                        }}

                                        <svg
                                            class="ml-2 -mr-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Akaun Saya
                                </div>

                                <DropdownLink :href="route('profile.show')">
                                    Profil
                                </DropdownLink>

                                <DropdownLink
                                    v-if="$page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')"
                                >
                                    API Tokens
                                </DropdownLink>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        Log Keluar
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                        <Dropdown v-else align="right" width="48" class="">
                            <template #trigger>
                                <a
                                    id="user-profile-dropdown"
                                    href="javascript:void(0);"
                                    class="nav-link dropdown-toggle user"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <div class="media flex">
                                        <div
                                            class="media-body align-self-center"
                                        >
                                            <h6>
                                                <span class="text-[#22577a]"
                                                    >Hi,</span
                                                >Pelawat
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </template>

                            <template #content>
                                <!-- Authentication -->
                                <DropdownLink :href="route('login')">
                                    Log Masuk
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </li>
                </ul>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out"
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        'w-full block text-sm h-screen overflow-scroll ':
                            showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            <div class="flex items-center justify-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-home"
                                >
                                    <path
                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                    ></path>
                                    <polyline
                                        points="9 22 9 12 15 12 15 22"
                                    ></polyline>
                                </svg>
                                <span>Home</span>
                            </div>
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('jadual.index')"
                            :active="route().current('jadual.*')"
                        >
                            <div class="flex items-center justify-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-calendar"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="18"
                                        rx="2"
                                        ry="2"
                                    ></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Jadual Perkhidmatan</span>
                            </div>
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('sisaindustri.index')"
                            :active="route().current('sisaindustri.*')"
                        >
                            <div class="flex items-center justify-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-box"
                                >
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"
                                    ></path>
                                    <polyline
                                        points="3.27 6.96 12 12.01 20.73 6.96"
                                    ></polyline>
                                    <line
                                        x1="12"
                                        y1="22.08"
                                        x2="12"
                                        y2="12"
                                    ></line>
                                </svg>
                                <span> Direktori Kontraktor</span>
                            </div>
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('complaint.index')"
                            :active="route().current('complaint.*')"
                        >
                            <div class="flex items-center justify-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-zap"
                                >
                                    <polygon
                                        points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"
                                    ></polygon>
                                </svg>
                                <span>Aduan</span>
                            </div>
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('kitarsemula.index')"
                            :active="route().current('kitarsemula.*')"
                        >
                            <div class="flex items-center justify-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-recycle"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"
                                    />
                                </svg>
                                <span>Kemudahan Kitar Semula</span>
                            </div>
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('recipe.index')"
                            :active="route().current('recipe.*')"
                        >
                            <div class="flex items-center justify-start">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-clipboard"
                                >
                                    <path
                                        d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"
                                    ></path>
                                    <rect
                                        x="8"
                                        y="2"
                                        width="8"
                                        height="4"
                                        rx="1"
                                        ry="1"
                                    ></rect>
                                </svg>
                                <span>Discover</span>
                            </div>
                        </ResponsiveNavLink>
                        <div
                            v-if="
                                $page.props.auth.user?.role_id === 5 ||
                                $page.props.auth.user?.role_id === 16 ||
                                $page.props.auth.user?.role_id === 17 ||
                                $page.props.auth.user?.role_id === 2
                            "
                            class="pt-4 pb-1 border-t border-base-content"
                        >
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Admin
                            </div>

                            <ResponsiveNavLink
                                :href="route('admin.complaint')"
                                :active="route().current('admin.complaint.*')"
                            >
                                Aduan
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('admin.announcement.index')"
                                :active="
                                    route().current('admin.announcement.*')
                                "
                            >
                                Pengumuman
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('admin.recipe.index')"
                                :active="route().current('admin.recipe.*')"
                            >
                                Discover More
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                            >
                                Profil
                            </ResponsiveNavLink>
                        </div>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        v-if="$page.props.auth.user"
                        class="pt-4 pb-1 border-t border-base-content"
                    >
                        <div class="flex items-center px-4">
                            <div
                                v-if="
                                    $page.props.jetstream.managesProfilePhotos
                                "
                                class="shrink-0 mr-3"
                            >
                                <img
                                    class="h-8 w-8 rounded-full object-cover"
                                    :src="
                                        $page.props.auth.user?.profile_photo_url
                                            ? $page.props.auth.user
                                                  ?.profile_photo_url
                                            : Profile
                                    "
                                    :alt="$page.props.auth.user?.name"
                                />
                                {{
                                    $page.props.auth.user
                                        ? $page.props.auth.user.name
                                        : "Pelawat"
                                }}
                            </div>

                            <div>
                                <div class="font-medium text-base">
                                    {{ $page.props.auth.user?.name }}
                                </div>
                                <div class="font-medium text-sm">
                                    {{ $page.props.auth.user?.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Log Keluar
                                </ResponsiveNavLink>
                            </form>
                        </div>
                    </div>
                    <div v-else class="py-4 border-t border-base-content">
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('login')">
                                Log Masuk
                            </ResponsiveNavLink>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-4">
                        <a
                            href="https://www.facebook.com/swcorpMY"
                            target="_blank"
                        >
                            <div class="flex text-white bg-[#3b5999]">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="34"
                                    height="34"
                                    fill="currentColor"
                                    class="bi bi-facebook order-last text-white"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"
                                    />
                                </svg>
                            </div>
                        </a>
                        <a
                            href="https://www.instagram.com/swcorp_my"
                            target="_blank"
                        >
                            <div class="flex text-white bg-[#e4405f]">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="34"
                                    height="34"
                                    fill="currentColor"
                                    class="bi bi-instagram order-last text-white"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"
                                    />
                                </svg>
                            </div>
                        </a>
                        <a
                            href="https://twitter.com/swcorp_my?lang=en"
                            target="_blank"
                        >
                            <div class="flex text-white bg-[#55acee]">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="34"
                                    height="34"
                                    fill="currentColor"
                                    class="bi bi-twitter order-last text-white"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"
                                    />
                                </svg>
                            </div>
                        </a>
                        <a
                            href="https://www.youtube.com/@swchannel6360"
                            target="_blank"
                        >
                            <div class="flex text-white bg-[#cd201f]">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="34"
                                    height="34"
                                    fill="currentColor"
                                    class="bi bi-youtube order-last text-white"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"
                                    />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </header>
        </div>
        <!--  END NAVBAR  -->

        <div>
            <div
                class="topbar-nav header relative flex flex-wrap items-center content-between py-3 px-4 max-w-7xl mx-auto bg-white rounded-3xl"
                role="banner"
            >
                <nav id="topbar" class="bg-white flex" role="navigation">
                    <!-- Navigation Links -->
                    <ul id="topAccordion" class="list-unstyled menu-categories">
                        <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-home"
                                >
                                    <path
                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                                    ></path>
                                    <polyline
                                        points="9 22 9 12 15 12 15 22"
                                    ></polyline>
                                </svg>
                                <span>Home</span>
                            </div>
                        </NavLink>
                        <NavLink
                            :href="route('jadual.index')"
                            :active="route().current('jadual.*')"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-calendar"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="18"
                                        rx="2"
                                        ry="2"
                                    ></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Jadual Perkhidmatan</span>
                            </div>
                        </NavLink>
                        <NavLink
                            :href="route('sisaindustri.index')"
                            :active="route().current('sisaindustri.*')"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-box"
                                >
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"
                                    ></path>
                                    <polyline
                                        points="3.27 6.96 12 12.01 20.73 6.96"
                                    ></polyline>
                                    <line
                                        x1="12"
                                        y1="22.08"
                                        x2="12"
                                        y2="12"
                                    ></line>
                                </svg>
                                <span> Direktori Kontraktor</span>
                            </div>
                        </NavLink>
                        <NavLink
                            :href="route('complaint.index')"
                            :active="route().current('complaint.*')"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-zap"
                                >
                                    <polygon
                                        points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"
                                    ></polygon>
                                </svg>
                                <span>Aduan</span>
                            </div>
                        </NavLink>
                        <NavLink
                            :href="route('kitarsemula.index')"
                            :active="route().current('kitarsemula.*')"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-recycle"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"
                                    />
                                </svg>
                                <span>Kemudahan Kitar Semula</span>
                            </div>
                        </NavLink>
                        <NavLink
                            :href="route('recipe.index')"
                            :active="route().current('recipe.*')"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-clipboard"
                                >
                                    <path
                                        d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"
                                    ></path>
                                    <rect
                                        x="8"
                                        y="2"
                                        width="8"
                                        height="4"
                                        rx="1"
                                        ry="1"
                                    ></rect>
                                </svg>
                                <span>Discover More</span>
                            </div>
                        </NavLink>
                        <NavLink
                            v-if="
                                $page.props.auth.user?.role_id === 5 ||
                                $page.props.auth.user?.role_id === 16 ||
                                $page.props.auth.user?.role_id === 17 ||
                                $page.props.auth.user?.role_id === 2
                            "
                            href="#"
                            :active="route().current('admin.*')"
                            class="dropdown-toggle"
                        >
                            <div class="flex items-center justify-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-shield-check"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"
                                    />
                                    <path
                                        d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"
                                    />
                                </svg>
                                <span>Admin</span>
                            </div>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-chevron-down"
                            >
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <!-- <Link :href="route('admin.index')" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle flex items-center justify-center">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                                            <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                                            <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                        <span>Admin</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </Link> -->
                            <ul
                                id="components"
                                class="collapse submenu list-unstyled z-50"
                                data-parent="#topAccordion"
                            >
                                <li>
                                    <Link :href="route('admin.complaint')">
                                        Aduan
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="
                                            route('admin.announcement.index')
                                        "
                                    >
                                        Pengumuman
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('admin.recipe.index')">
                                        Discover More
                                    </Link>
                                </li>
                            </ul>
                        </NavLink>
                    </ul>
                    <!-- Primary Navigation Menu -->
                </nav>
            </div>

            <div id="content" class="main-content max-w-7xl">
                <div class="layout-px-spacing">
                    <div
                        id="cancel-row"
                        class="flex flex-wrap layout-top-spacing"
                    >
                        <div class="w-full layout-spacing">
                            <div
                                class="widget-content widget-content-area"
                            >
                                <ul class="skip-links">
                                    <li>
                                        <a
                                            ref="skipLink"
                                            href="#main"
                                            class="skip-link"
                                            >Skip to main content</a
                                        >
                                    </li>
                                </ul>
                                <div
                                    id="main"
                                    class="max-w-7xl mx-auto"
                                    role="main"
                                >
                                    <!-- Page Heading -->
                                    <a
                                        v-if="
                                            route().current('*.edit') ||
                                            route().current('*.show') ||
                                            route().current('*.create')
                                        "
                                        href="#"
                                        @click="back"
                                        ><i class="bi bi-chevron-left"></i>
                                        Kembali</a
                                    >
                                    <div
                                        v-if="$slots.header"
                                        class="flex flex-wrap mb-5"
                                    >
                                        <div
                                            class="sm:w-full w-full text-center"
                                        >
                                            <slot name="header" />
                                        </div>
                                    </div>
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer-bottom">
            <div
                class="grid lg:grid-cols-2 w-full mx-auto py-2 lg:py-4 px-2 lg:px-4 max-w-7xl"
                role="contentinfo"
            >
                <!-- Footer Info -->
                <p id="footer-info" class="text-black" data-wahfont="14">
                    Hakcipta Terpelihara © 2023. Perbadanan Pengurusan Sisa
                    Pepejal Dan Pembersihan Awam (SWCorp) <br />Paparan terbaik
                    skrin beresolusi 1024x768 piksel menggunakan pelayar web
                    <br />
                    Mozilla Firefox atau Google Chrome versi terkini
                </p>
                <!-- Footer Navigation -->
                <div id="footer-nav" class="">
                    <ul
                        id="footer-menu"
                        class="bottom-nav flex flex-col lg:flex-row justify-end lg:gap-5"
                    >
                        <li
                            id="menu-item-239"
                            class="menu-item menu-item-type-post_type menu-item-object-post menu-item-239"
                        >
                            <a
                                href="https://www.swcorp.gov.my/penafian/"
                                data-wahfont="14"
                                class="text-gray-900 hover:text-white"
                                >Penafian</a
                            >
                        </li>
                        <li
                            id="menu-item-238"
                            class="splwpk-privacy-policy menu-item menu-item-type-post_type menu-item-object-post menu-item-238"
                        >
                            <a
                                href="https://www.swcorp.gov.my/dasar-privasi-keselamatan/"
                                data-wahfont="14"
                                class="text-gray-900 hover:text-white"
                                >Dasar Privasi &amp; Keselamatan</a
                            >
                        </li>
                        <li
                            id="menu-item-237"
                            class="menu-item menu-item-type-post_type menu-item-object-post menu-item-237"
                        >
                            <a
                                href="https://www.swcorp.gov.my/soalan-lazim/"
                                data-wahfont="14"
                                class="text-gray-900 hover:text-white"
                                >Soalan Lazim</a
                            >
                        </li>
                        <li
                            id="menu-item-236"
                            class="menu-item menu-item-type-post_type menu-item-object-post menu-item-236"
                        >
                            <a
                                href="https://www.swcorp.gov.my/peta-laman/"
                                data-wahfont="14"
                                class="text-gray-900 hover:text-white"
                                >Peta Laman</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.required:after {
    content: " *";
    color: red;
}
/* #3b3f5c */
.app-bg {
    height: 100%;
    background: rgb(9, 121, 33);
    background: linear-gradient(
        90deg,
        rgb(87, 204, 153,0.5) 0%,
        rgb(128, 237, 153,0.5) 100%
    );
}

.skip-link {
    white-space: nowrap;
    margin: 1em auto;
    top: 0;
    position: fixed;
    left: 50%;
    margin-left: -72px;
    opacity: 0;
}

.skip-link:focus {
    opacity: 1;
    background-color: white;
    padding: 0.5em;
    border: 1px solid black;
}

.multiselect,
.multiselect__input,
.multiselect__single {
    font-size: 13px !important;
}

#footer-bottom {
    font-size: 0.7rem;
}

.dataTables_filter {
    margin: 12px 0;
}

.social-btn {
    display: flex;
    width: 150px;
    align-items: center;
    justify-content: space-between;
    padding-left: 30px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    border: 1px;
    border-bottom-right-radius: 30px;
    border-top-right-radius: 30px;
    margin-bottom: 5px;
    position: relative;
    left: -118px;
    transition: left 1s;
}

.social-btn:hover {
    left: -10px;
    transition: left 1s;
}

.social {
    position: fixed;
    top: 50px;
}

.social a {
    text-decoration: none;
}

.social-btn img {
    width: 40px;
}

.social-btn p {
    color: white;

    margin-top: 0px;
    margin-bottom: 0px;
}
</style>
