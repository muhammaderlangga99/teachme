<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import GroupListItems from "@/Components/app/GroupListItems.vue";
import {
    UserGroupIcon,
} from "@heroicons/vue/24/solid";
import {
    Link,
    router,
    usePage
} from "@inertiajs/vue3";

defineProps({
    groups: Array,
});

const authUser = usePage().props.auth.user;
</script>

<template>
    <div class="bg-transparent rounded-2xl dark:text-gray-100 py-3 overflow-y-auto">
        <div class="profile mb-4">
            <Link :href="route('profile', {
                username: authUser.username,
            })" class="flex hover:bg-zinc-200 dark:hover:bg-zinc-900 p-2 items-center gap-x-3 rounded-xl duration-300">
            <img :src="authUser.avatar_url" alt="" class="w-10 h-10 rounded-full object-cover">
            <div class="flex flex-col">
                <h3 class="font-semibold">{{ authUser.name }}</h3>
                <span class="text-sm text-gray-500">
                    @{{ authUser.username }}
                </span>
            </div>
            </Link>
        </div>
        <h3 class="mb-5 font-semibold ml-2">
            <UserGroupIcon
                class="w-[40px] h-[40px] inline mr-2 fill-blue-600 dark:fill-sky-600 rounded-full bg-zinc-300 dark:bg-zinc-800 p-2 object-cover" />
            Ruang Diskusi
        </h3>
        <!-- <div class="block lg:hidden">
            <Disclosure v-slot="{ open }">
                <DisclosureButton class="w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">My Groups</h2>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 transition-all"
                            :class="open ? 'rotate-90 transform' : ''"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8.25 4.5l7.5 7.5-7.5 7.5"
                            />
                        </svg>
                    </div>
                </DisclosureButton>
                <DisclosurePanel>
                    <GroupListItems :groups="groups" />
                </DisclosurePanel>
            </Disclosure>
        </div> -->
        <div class="h-auto overflow-hidden flex md:flex-col lg:flex">
            <GroupListItems :groups="groups" />
        </div>
        <!-- <div class="h-full overflow-hidden flex-col hidden lg:flex">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold">My Groups</h2>
            </div>
            <GroupListItems :groups="groups" />
        </div> -->

        <div class="w-full h-0.5 border-zinc-300 dark:border-zinc-800 border-b-[0.5px] inline-block"></div>

        <div class="company mt-3 flex flex-col gap-y-2 ml-2 h-auto text-base">
            <h3 class="text-lg font-semibold text-zinc-600">Company</h3>
            <a href="#" class="inline-block text-zinc-700">About</a>
            <a href="#" class="inline-block text-zinc-700">Contact Us</a>
            <a href="#" class="inline-block text-zinc-700">Privacy Policy</a>
            <a href="#" class="inline-block text-zinc-700">Terms & Conditions</a>
        </div>

        <div class="w-full h-0.5 border-zinc-300 dark:border-zinc-800 border-b-[0.5px] inline-block"></div>

        <div class="company mt-3 text-base text-zinc-700 flex flex-col gap-y-2 ml-2 h-auto">
            &copy; 2024 Teachme. <br> All rights reserved.
        </div>


    </div>
</template>

<style scoped></style>
