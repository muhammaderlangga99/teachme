<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    DocumentTextIcon,
    UsersIcon,
    UserCircleIcon,
} from "@heroicons/vue/24/outline";
import { StarIcon, AcademicCapIcon, BellIcon, HandThumbUpIcon } from "@heroicons/vue/24/solid";
import CreateMateri from "@/Components/app/CreateMateri.vue";
import Dropdown from "@/Components/Dropdown.vue";
import {Link} from "@inertiajs/vue3";
defineProps({
    user: Object
});
</script>

<template>
<AuthenticatedLayout>
    <section class="h-full dark:bg-[#0c1d2d]">
        <!-- section profile -->
        <section class="mx-auto translate-y-5 max-w-6xl flex flex-col md:items-start md:flex-row">
            <div class="">
                <section class="w-72 bg-slate-200 dark:bg-slate-950 dark:border-2 dark:border-emerald-950 rounded-2xl px-8 py-6 shadow-lg m-auto">
                    <div class="flex items-center justify-between">
                        <span class="dark:text-gray-400 text-sm font-medium">Teacher</span>
                        <UserCircleIcon class="h-5 w-5 dark:text-gray-400 stroke-emerald-600" />
                    </div>
                    <div class="mt-6 w-fit mx-auto">
                        <img :src="`/storage/` + user.avatar_path || '/img/default_avatar.webp'" class="rounded-full object-cover h-28 w-28 " alt="profile picture" srcset="">
                    </div>

                    <div class="mt-8 ">
                        <h2 class="dark:text-white font-bold text-2xl tracking-wide">{{user.name}}</h2>
                    </div>
                    <p class="dark:text-emerald-400 text-emerald-600 font-semibold mt-2.5">
                        Teacher Programming
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
                <div class="m-auto mt-5 flex items-center md:mt-0 md:m-0 max-w-96">
                    <CreateMateri />

                    <div class="relative -translate-y-1">
                        <Dropdown align="right" width="80">
                            <template #trigger>
                                <button class="dark:text-white p-2 relative">
                                    <span class="border-2 border-slate-100 dark:border-[#0c1d2d] font-medium rounded-full text-xs bg-blue-100  absolute top-0 h-6 w-6 flex items-center justify-center text-blue-600 -translate-y-2 translate-x-2">1</span>
                                    <BellIcon class="w-5 h-5 text-slate-600 dark:text-slate-400" />
                                </button>
                            </template>

                            <template #content>
                                <div class="px-1 py-1">
                                    <Link href="#" class="group flex w-full rounded-md px-2 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-800 flex-col items-start">
                                        <div class="flex items-center">
                                            <img src="https://media.istockphoto.com/id/1473839183/photo/beautiful-smiling-happy-young-asian-woman-age-around-25-in-brown-shirt-charming-female-lady.webp?b=1&s=170667a&w=0&k=20&c=j_HdNolb9itxyzUUF6pw_ujsJkPq9AKjclqqlmxTAb8=" class="w-8 h-8 rounded-full object-cover"/>
                                            <span class="font-semibold ml-2">Dian Ariani</span> 
                                        </div>
                                        <div class="mt-2 grid grid-cols-4">
                                        <span class="col-span-3">Menyukai postingan anda: "Guru adalah..." </span>
                                        <div class="col-span-1 flex">
                                            <HandThumbUpIcon class="w-5 text-blue-600 m-auto inline-block items-center"/>
                                        </div>
                                        </div>
                                    </Link>
                                </div> 
                            </template>
                        </Dropdown>
                    </div>
                </div>
                <div class="grid justify-center md:grid-cols-2 lg:grid-cols-3 rounded-xl md:overflow-scroll md:h-screen  gap-5 scrollbar-hide px-5">
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://th.bing.com/th?id=OIP.YePVzjkjsadOqzQ03wl5kAHaEO&w=331&h=188&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Belajar menggunakan react js dari dasar...</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/bwafl.jpeg" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Membangun aplikasi toko sepatu menggunakan...</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="h-4 w-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-4 w-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-4 w-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-4 w-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="h-4 w-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/p4q7xicx-Thumbnail%20BWALARAVEL9%20(1)%20(2).png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">kenalan dengan modern web development</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnail/159817/thumbnail.png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Menggunakan framework php: Laravel</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/7ywtnixr-iyjy2emq-Thumbnail%20Bootcamp%20Mentor%20Fauzi.png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Merancang desain UI/UX website kesehatan</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/thumbnail%20kelas%20ui%20design%20wireframe%20ke%20visual%20design%20buildwith%20angga.png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Belajar mendesain web dari wireframe</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/rm8ehc2u-thumbnail%20(1).png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case...</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/thumbnail_vue_starter.png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case...</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 md:h-80 md:w-full grid grid-cols-3 md:inline-block md:max-h-80 max-w-sm border border-gray-200 rounded-3xl shadow-lg dark:bg-gray-800 dark:border-gray-700 bg-white overflow-hidden">
                        <a href="#" class="flex md:inline w-full col-span-1">
                            <img class="overflow-hidden object-cover md:h-1/2 m-auto w-full h-full" src="https://buildwithangga.com/storage/assets/thumbnails/leax5r8e-Thumbnail%20Bootcamp%20Laravel%20NuxtJS.png" alt="product image" />
                        </a>
                        <div class="px-5 col-span-2 md:h-1/2 py-3 md:py-0 flex flex-col space-y-1 md:space-y-0 md:justify-evenly h-full">
                            <a href="#">
                                <h5 class="md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case...</h5>
                            </a>
                            <!-- price -->
                            <div class="flex items center justify-between">
                                <span class="text-gray-500 dark:text-gray-300 font-semibold">Rp78,000</span>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                    <StarIcon class="w-4 h-4 lg:h-5 lg:w-5 text-yellow-400 dark:text-yellow-300" />
                                </div>
                                <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 ms-3 flex justify-center items-center gap-1">
                                    <span>12</span>
                                    <AcademicCapIcon class="h-3 w-3 inline-block" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </section>
    </section>
</AuthenticatedLayout>
</template>
