<script setup>
import { Link } from "@inertiajs/vue3";
import { ChevronRightIcon } from "@heroicons/vue/24/solid/index.js";

defineProps({
    post: {
        type: Object,
    },
    showTime: {
        type: Boolean,
        default: true,
    },
});

// function date of post
function formatDate(date) {
    // if date is today, Display time based on a few minutes or how many hours have passed since the post was created
    const today = new Date(); // today's date
    const postDate = new Date(date); // post date
    const diff = today - postDate; // difference in milliseconds
    const hours = Math.floor(diff / 1000 / 60 / 60); // difference in hours
    if (hours < 24) {
        if (hours < 1) {
            return Math.floor(diff / 1000 / 60) + "m";
        }
        return hours + "j";
    }

    // if date is not today & still in this year then only show date and month
    if (today.getFullYear() === postDate.getFullYear()) {
        return postDate.toLocaleString("default", {
            month: "short",
            day: "numeric",
        });
    } else {
        return postDate.toLocaleString("default", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });
    }
}
</script>

<template>
    <div class="flex items-center gap-2">
        <Link v-if="!post.group" :href="route('profile', post.user.username)">
        <img :src="post.user.avatar_url"
            class="w-[40px] h-[40px] object-cover rounded-full transition-all hover:border-blue-500" />
        </Link>
        <Link v-if="post.group" :href="route('group.profile', post.group.slug)">
        <img :src="
                    post.group.thumbnail_url ||
                    '/img/avatar.jpg'
                " class="w-[40px] h-[40px] object-cover rounded-xl transition-all hover:border-blue-500" />
        <img :src="post.user.avatar_url"
            class="w-[25px] h-[25px] object-cover -translate-y-5  translate-x-5 border-2 border-white dark:border-zinc-950 rounded-full transition-all hover:border-blue-500" />
        </Link>

        <div class="leading-none md:leading-3">
            <h4 class="flex items-center font-extrabold">
                <Link v-if="!post.group" :href="route('profile', post.user.username)"
                    class="hover:underline text-sm md:text-base">
                {{ post.user.name }}
                <small class="text-zinc-500 inline-block font-light">{{ " · " + formatDate(post.updated_at) }}</small>
                </Link>
                <!-- jika postnya dari grup, maka tampilkan -->
                <template v-if="post.group">
                    <Link :href="route('group.profile', post.group.slug)" class="hover:underline -mt-7">
                    {{ post.group.name }}
                    </Link>

                    <!-- <Link
                        :href="route('profile', post.user.username)"
                        class="hover:underline text-sm md:text-base"
                    >
                        {{ post.user.name }}
                    </Link>
                    <ChevronRightIcon class="w-4 mt-1 stroke-2 font-bold" />
                    <Link
                        :href="route('group.profile', post.group.slug)"
                        class="hover:underline"
                    >
                        {{ post.group.name }}
                    </Link> -->
                </template>
            </h4>
            <small v-if="showTime && !post.group"
                class="text-xs text-gray-300 dark:text-slate-700 overflow-hidden w-full">
                {{
                post.user.username
                }}</small>

            <Link :href="route('profile', post.user.username)" v-if="showTime && post.group"
                class="text-xs text-gray-300 dark:text-slate-700 overflow-hidden w-full hover:underline">
            {{
            post.user.name

            }}
            <small class="text-zinc-500 inline-block font-light">{{ " · " + formatDate(post.updated_at)
                }}</small>
            </Link>

        </div>
    </div>
</template>

<style scoped></style>
