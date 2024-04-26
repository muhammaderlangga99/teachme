<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    group: Object,
    description: String,
});

function limitWords(text, limit) {
    // jika text kurang dari limit maka langsung kembalikan text
    if (text.split(" ").length <= limit) {
        return text;
    }
    // jika text lebih dari limit maka potong text dan tambahkan ...
    return text.split(" ").slice(0, limit).join(" ") + "...";
}
</script>

<template>
    <div
        class="cursor-pointer w-full hover:bg-zinc-200 dark:hover:bg-zinc-900 duration-300 rounded-full"
    >
        <Link
            :href="route('group.profile', group.slug)"
            class="flex items-center gap-2 py-2 px-2" :title=" group.description "
        >
            <img
                :src="group.thumbnail_url"
                class="w-[40px] h-[40px] rounded-full object-cover"
            />
            <div class="flex-1 flex flex-col pr-2">
                    <h3 class="font-semibold">{{ group.name }}</h3>
                    <div class="flex">
                        <!-- <span class="text-xs text-gray-500">{{ limitWords(group.description, 5) }} </span> -->
                        <!-- <span class="text-xs text-gray-500">{{ group. }} members</span> -->
                    </div>
                 <!-- <span class="text-xs text-center">
                    {{
                        group.status === "approved"
                            ? group.role === "admin"
                                ? group.role
                                : ""
                            : "not approved"
                    }}
                </span> -->
            </div>
        </Link>
    </div>
</template>


<style scoped></style>
