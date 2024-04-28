<script setup>
import {
    onMounted,
    ref
} from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import {
    Link,
    router,
    usePage
} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import {
    MoonIcon,
    BellIcon,
    HandThumbUpIcon,
} from "@heroicons/vue/24/solid";
import {
    HomeIcon,
    UserGroupIcon,
    UserIcon,
    ChatBubbleOvalLeftIcon,
    MagnifyingGlassIcon,
    AcademicCapIcon,
    PencilIcon,
} from "@heroicons/vue/24/outline";
import PostModal from "@/Components/app/PostModal.vue";

const showingNavigationDropdown = ref(false);
const notificationsDropdown = ref(false);
const keywords = ref(usePage().props.search || "");
const showModal = ref(false);
const authUser = usePage().props.auth.user;

const newPost = ref({
    id: null,
    body: "",
    user: authUser,
});

defineProps({
    group: {
        type: Object,
        default: null,
    },
});

function showCreatePostModal() {
    showModal.value = true;
}

function search() {
    router.get(route("search", encodeURIComponent(keywords.value)));
}

function toggleDarkMode() {
    const html = window.document.documentElement;
    if (html.classList.contains("dark")) {
        html.classList.remove("dark");
        localStorage.setItem("darkMode", "0");
    } else {
        html.classList.add("dark");
        localStorage.setItem("darkMode", "1");
    }
}

// navbar read url path and change the active link

onMounted(() => {
    // target icon svg in navbar
    const icons = document.querySelectorAll("nav svg");
    const links = document.querySelectorAll("nav a");

    // change the color of the icon and text
    icons.forEach((icon) => {
        if (icon.parentElement.href === window.location.href) {
            icon.classList.add("stroke-blue-600");
        }
    });

    // change the color of the text
    links.forEach((link) => {
        if (link.href === window.location.href) {
            link.classList.add("dark:text-blue-600", "text-blue-600");
            link.classList.remove("dark:text-white");
        }
    });

    // check the url path, if url path is /g/* then console log the url path
    
    
    
    
    // if( window.location.href == window.location.origin + "/g/" + window.location.pathname.split("/")[2]){
        //     console.log(window.location.href);
        // }
});
    
function groupUrl() {
    if (window.location.href == window.location.origin + "/g/" + window.location.pathname.split("/")[2]) {
        return window.location.href;
    }
}
//  console scroll event
window.addEventListener("scroll", () => {
    console.log(window.scrollY);
    const nav = document.querySelector("nav");
    if (window.scrollY > 0) {
        nav.classList.add("bg-gradient-to-b", "from-white", "via-white", "dark:bg-gradient-to-b", "dark:from-black", "dark:via-black", "to-transparent");
        nav.classList.remove("bg-white", "dark:bg-black", "dark:bg-zinc-950");
    } else {
        nav.classList.add("bg-white", "dark:bg-black", "dark:bg-zinc-950");
        nav.classList.remove("bg-gradient-to-b", "from-white", "via-white", "dark:bg-gradient-to-b", "dark:from-black", "dark:via-black", "to-transparent");
    }

    const pencil = document.querySelector(".pencil");
    if (window.scrollY > 200) {
        pencil.classList.add("inline-block");
        pencil.classList.remove("hidden");
    } else {
        pencil.classList.add("hidden");
        pencil.classList.remove("inline-block");
    }
    
});
 
</script>

<template>
    <div class="h-full overflow-hidden flex flex-col bg-gray-100 dark:bg-black">
        <nav
            class="bg-white dark:bg-black md:dark:bg-zinc-950 md:bg-gradient-to-b md:from-transparent md:via-transparent md:dark:from-transparent md:dark:via-transparent md:to-transparent  md:bg-white md:backdrop-blur-md md:backdrop-filter md:bg-clip-padding md:bg-opacity-70 md:dark:bg-opacity-70 md:dark:backdrop-filter md:dark:bg-clip-padding border-gray-100 dark:border-gray-700 fixed w-full z-50">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between gap-2 h-16">

                    <div class="relative md:hidden">
                        <Dropdown align="right" width="64">
                            <template #trigger>
                                <button class="dark:text-white p-2 relative">
                                    <!-- <span
                                        class="border-2 border-white dark:border-zinc-800 font-medium rounded-full text-xs bg-blue-50  absolute top-0 h-6 w-6 flex items-center justify-center text-blue-600 -translate-y-2 translate-x-2">1</span> -->
                                    <BellIcon class="w-6 h-6 text-zinc-900 dark:text-zinc-400" />
                                </button>
                            </template>

                            <template #content>
                                <div class="px-1 py-1">
                                    <Link href="#"
                                        class="group flex w-full rounded-md px-2 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-800 flex-col items-start">
                                    <div class="flex items-center">
                                        <img src="https://media.istockphoto.com/id/1473839183/photo/beautiful-smiling-happy-young-asian-woman-age-around-25-in-brown-shirt-charming-female-lady.webp?b=1&s=170667a&w=0&k=20&c=j_HdNolb9itxyzUUF6pw_ujsJkPq9AKjclqqlmxTAb8="
                                            class="w-8 h-8 rounded-full object-cover" />
                                        <span class="font-semibold ml-2">Dian Ariani</span>
                                    </div>
                                    <div class="mt-2 grid grid-cols-4">
                                        <span class="col-span-3">Menyukai postingan anda: "Guru adalah pahlawan..."
                                        </span>
                                        <div class="col-span-1 flex">
                                            <span class="w-5 h-5 bg-blue-200 dark:bg-blue-600 flex m-auto rounded-full">
                                                <HandThumbUpIcon
                                                    class="w-3 text-blue-600 dark:text-slate-300 m-auto inline-block items-center" />
                                            </span>
                                        </div>
                                    </div>
                                    </Link>
                                </div>
                            </template>
                        </Dropdown>
                    </div>

                    <div class="flex mr-2">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('dashboard')" class="flex justify-center items-center gap-1">
                            <img src="/img/graduated.png" class="block h-12 w-auto" alt="">
                            <!-- <a href="https://iconscout.com/3d-illustrations/graduated" class="text-underline font-size-sm" target="_blank">Graduated</a> by <a href="https://iconscout.com/contributors/tamry-studio" class="text-underline font-size-sm">Tamry Studio</a> on <a href="https://iconscout.com" class="text-underline font-size-sm">IconScout</a> -->
                            <div>
                                <p class="font-semibold tracking-wide">
                                    <span class="text-blue-600 dark:text-blue-400">Teach</span>
                                    <span class="text-gray-800 dark:text-gray-200">Me</span>
                                </p>
                                <!-- <p class="text-xs text-gray-500 dark:text-gray-400">Temukan guru belajarmu</p> -->
                            </div>

                            <!-- <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> -->
                            </Link>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-3 bg-white backdrop-filter md:backdrop-filter-none md:dark:backdrop-filter-none md:bg-transparent md:dark:bg-transparent bg-opacity-45 dark:backdrop-filter backdrop-blur-sm bg-clip-padding dark:bg-zinc-950 dark:bg-opacity-75 dark:backdrop-blur-md shadow-lg md:shadow-none md:p-0 md:relative fixed p-2 border-t-[0.1px] dark:border-t-zinc-700 md:border-none bottom-0 left-0 right-0 md:bottom-0 md:left-0 md:right-0 justify-around md:justify-normal z-50">
                        <Link href="/"
                            class="p-1.5 rounded-lg dark:text-white flex flex-col justify-center items-center">
                        <HomeIcon class="w-6 h-6 dark:text-white" />
                        <!-- <IconHome1 /> -->
                        <!-- <span class="hidden text-xs">Beranda</span> -->
                        </Link>

                        <Link href="/relasi"
                            class="p-1.5 rounded-lg dark:text-white flex flex-col justify-center items-center">
                        <UserGroupIcon class="w-6 h-6 dark:text-white" />
                        <!-- <span class="hidden text-xs">Relasi</span> -->
                        </Link>

                        <div class="relative hidden md:inline-block">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <MagnifyingGlassIcon class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                            </div>
                            <TextInput v-model="keywords" placeholder="Search"
                                class="w-full border-none md:rounded-full overflow-hidden bg-zinc-100 border-gray-300 text-sm rounded-lg ps-10 p-2.5 dark:text-white"
                                @keyup.enter="search" />
                        </div>

                        <!-- <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search branch name..." required />
                        </div> -->

                        <Link href="search"
                            class="md:hidden p-1.5 dark:text-white border-slate-100 rounded-2xl  flex flex-col justify-center items-center">
                        <MagnifyingGlassIcon class="w-6 h-6 dark:text-white" />
                        <!-- <span class="hidden text-xs">Search</span> -->
                        </Link>

                        <Link href="/teachme"
                            class="p-1.5 rounded-lg hidden dark:text-white md:flex flex-col justify-center items-center">
                        <AcademicCapIcon class="w-6 h-6 dark:text-white" />
                        <!-- <span class="hidden text-xs">Teachme</span> -->
                        </Link>

                        <Link href="pesan"
                            class="p-1.5 rounded-lg dark:text-white flex flex-col justify-center items-center">
                        <ChatBubbleOvalLeftIcon class="w-6 h-6 dark:text-white" />
                        <!-- <span class="hidden text-xs">Pesan</span> -->
                        </Link>

                        <Link :href="route('profile', {
                            username: authUser.username,
                        })" class="md:hidden">
                        <img :src="authUser.avatar_url"
                            class="w-[28px] h-[28px] object-cover dark:border-zinc-950 rounded-full transition-all hover:border-blue-500" />
                        </Link>

                    </div>

                    <div class="hidden sm:flex sm:items-center">
                        <div class="relative">
                            <Dropdown align="right" width="64">
                                <template #trigger>
                                    <button class="dark:text-white p-2 relative">
                                        <span
                                            class="border-2 border-white dark:border-slate-800 font-medium rounded-full text-xs bg-blue-50  absolute top-0 h-6 w-6 flex items-center justify-center text-blue-600 -translate-y-2 translate-x-2">1</span>
                                        <BellIcon class="w-5 h-5 text-slate-600 dark:text-white" />
                                    </button>
                                </template>

                                <template #content>
                                    <div class="px-1 py-1">
                                        <Link href="#"
                                            class="group flex w-full rounded-md px-2 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-800 flex-col items-start">
                                        <div class="flex items-center">
                                            <img src="https://media.istockphoto.com/id/1473839183/photo/beautiful-smiling-happy-young-asian-woman-age-around-25-in-brown-shirt-charming-female-lady.webp?b=1&s=170667a&w=0&k=20&c=j_HdNolb9itxyzUUF6pw_ujsJkPq9AKjclqqlmxTAb8="
                                                class="w-8 h-8 rounded-full object-cover" />
                                            <span class="font-semibold ml-2">Dian Ariani</span>
                                        </div>
                                        <div class="mt-2 grid grid-cols-4">
                                            <span class="col-span-3">Menyukai postingan anda: "Guru adalah
                                                pahlawan..."
                                            </span>
                                            <div class="col-span-1 flex">
                                                <span
                                                    class="w-5 h-5 bg-blue-200 dark:bg-blue-600 flex m-auto rounded-full">
                                                    <HandThumbUpIcon
                                                        class="w-3 text-blue-600 dark:text-slate-300 m-auto inline-block items-center" />
                                                </span>
                                            </div>
                                        </div>
                                        </Link>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>


                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <Dropdown v-if="authUser" align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md items-center justify-center">
                                        <button type="button"
                                            class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <img :src="authUser.avatar_url"
                                                class="w-[35px] h-[35px] rounded-full transition-all object-cover hover:border-blue-500" />
                                            <!-- {{ authUser.name }} -->

                                            <!-- <svg class="ms-2 -me-0.5 h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg> -->
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="
                                            route('profile', {
                                                username: authUser.username,
                                            })
                                        ">
                                        Profile
                                    </DropdownLink>

                                    <button @click="toggleDarkMode"
                                        class="font-normal text-sm px-3.5 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 w-full text-left py-2">
                                        Tema
                                        <MoonIcon class="w-3 h-3 inline-block" />
                                    </button>

                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                            <div v-else>
                                <Link :href="route('login')" class="dark:text-gray-100">
                                Login
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center md:hidden">
                        <!-- <button @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button> -->
                        <Link href="/teachme"
                            class="p-1.5 rounded-lg dark:text-white md:flex flex-col justify-center items-center">
                        <AcademicCapIcon class="w-6 h-6 dark:text-white" />
                        <!-- <span class="hidden text-xs">Teachme</span> -->
                        </Link>

                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <!-- <div :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }" class="sm:hidden"> -->
            <!-- Responsive Settings Options -->
            <!-- <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <template v-if="authUser">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ authUser.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ authUser.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="
                                    route('profile', {
                                        username: authUser.username,
                                    })
                                ">
                                Profile
                            </ResponsiveNavLink>
                            <button @click="toggleDarkMode"
                                class="font-medium text-sm px-3.5 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 w-full text-left py-2">
                                Tema
                                <MoonIcon class="w-3 h-3 inline-block" />
                            </button>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </template>
                    <template> Login button </template>
                </div> -->
            <!-- </div> -->
        </nav>

        <!-- Page Heading -->
        <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-hidden mt-16">
            <slot />

            <!-- button for post constent -->
            <div v-if="!groupUrl()" @click="showCreatePostModal()"
                class="p-2.5 pencil hidden shadow-md rounded-full duration-300 text-white fixed bottom-16 right-4 bg-blue-600 h-auto">
                <PencilIcon class="w-5" />
            </div>
            <!-- <PostModal :post="newPost" :group="group" v-model="showModal" /> -->

            <PostModal :post="newPost" :group="group" v-model="showModal" />
        </main>
    </div>
</template>
