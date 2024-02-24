<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    DocumentTextIcon,
    UsersIcon,
    UserCircleIcon
} from "@heroicons/vue/24/outline";
import { StarIcon } from "@heroicons/vue/24/solid";
import CreateMateri from "@/Components/app/CreateMateri.vue";
defineProps({
    user: Object
});
</script>

<template>
<AuthenticatedLayout>
    <section class=" dark:bg-[#0c1d2d]">
        <!-- section profile -->
        <section class="mx-auto translate-y-5 max-w-6xl flex flex-col md:items-start md:flex-row">
            <div class="">
                <section class="w-72 bg-slate-200 dark:bg-slate-950 dark:border-2 dark:border-emerald-950 rounded-2xl px-8 py-6 shadow-lg m-auto">
                    <div class="flex items-center justify-between">
                        <span class="dark:text-gray-400 text-sm font-medium">Teacher</span>
                        <UserCircleIcon class="h-5 w-5 dark:text-gray-400 stroke-emerald-600" />
                    </div>
                    <div class="mt-6 w-fit mx-auto">
                        <img :src="`/storage/` + user.avatar_path || '/img/default_avatar.webp'" class="rounded-full w-28 " alt="profile picture" srcset="">
                    </div>

                    <div class="mt-8 ">
                        <h2 class="dark:text-white font-bold text-2xl tracking-wide">{{user.name}}</h2>
                    </div>
                    <p class="dark:text-emerald-400 text-emerald-600 font-semibold mt-2.5">
                        Co-founder
                    </p>
                    <div class="mt-3 flex gap-3 dark:text-white text-sm">
                        <p>
                            <DocumentTextIcon class="h-4 w-4 stroke-2 inline-block font-semibold" />
                            <span class="ml-1 translate-y-0.5 font-semibold inline-block">3 Materi</span>
                        </p>
                        <p>
                            <UsersIcon class="h-4 w-4 stroke-2 inline-block font-semibold" />
                            <span class="ml-1 translate-y-0.5 font-semibold inline-block">45 Murid</span>
                        </p>
                    </div>
                </section>
            </div>
            <!-- section materi -->
            <section class="flex-1 px-5 h-auto">
                <div class="m-auto mt-5 md:mt-0 md:m-0 max-w-96">
                    <CreateMateri />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 md:h-[80vh] rounded-xl md:overflow-auto gap-5 scrollbar-hide px-5">

                    <div class="card w-full h-auto flex md:inline-block md:max-h-80 max-w-sm bg-white border border-gray-200 rounded-3xl shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        <a href="#" class="flex md:inline w-2/3">
                            <img class="overflow-hidden object-cover h-1/2 m-auto w-full" src="https://th.bing.com/th?id=OIP.YePVzjkjsadOqzQ03wl5kAHaEO&w=331&h=188&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" alt="product image" />
                        </a>
                        <div class="px-5 py-3 md:pt-3">
                            <a href="#">
                                <h5 class="md:text-lg md:py-2 font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                            </a>
                            <div class="flex items-center mt-1">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span>
                            </div>
                        </div>
                    </div>
                    <div class="card w-full h-auto flex md:inline-block md:max-h-80 max-w-sm bg-white border border-gray-200 rounded-3xl shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        <a href="#" class="flex md:inline w-2/3">
                            <img class="overflow-hidden object-cover h-1/2 m-auto w-full" src="https://buildwithangga.com/storage/assets/thumbnails/thumbnail_kelas_web_developer_tools.png" alt="product image" />
                        </a>
                        <div class="px-5 py-3 md:pt-3">
                            <a href="#">
                                <h5 class="md:text-lg md:py-2 font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                            </a>
                            <div class="flex items-center mt-1">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span>
                            </div>
                        </div>
                    </div>
                    <div class="card w-full h-auto flex md:inline-block md:max-h-80 max-w-sm bg-white border border-gray-200 rounded-3xl shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        <a href="#" class="flex md:inline w-2/3">
                            <img class="overflow-hidden object-cover h-1/2 m-auto w-full" src="https://th.bing.com/th?id=OIP.kmK49SRJaGmY0vH0bUxcuQHaEK&w=333&h=187&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" alt="product image" />
                        </a>
                        <div class="px-5 py-3 md:pt-3">
                            <a href="#">
                                <h5 class="md:text-lg md:py-2 font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport</h5>
                            </a>
                            <div class="flex items-center mt-1">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-5 w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span>
                            </div>
                        </div>
                    </div>
                    

                </div>

            </section>
        </section>
    </section>
</AuthenticatedLayout>
</template>
