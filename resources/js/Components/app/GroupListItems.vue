<script setup>
import TextInput from "@/Components/TextInput.vue";
import GroupItem from "@/Components/app/GroupItem.vue";
import { ref } from "vue";
import GroupModal from "@/Components/app/GroupModal.vue";
import {
    UserGroupIcon,
    ArrowUpRightIcon
} from "@heroicons/vue/24/outline";
import {Link} from "@inertiajs/vue3";

const searchKeyword = ref("");
const showNewGroupModal = ref(false);

const props = defineProps({
    groups: Array,
});

function onGroupCreate(group) {
    props.groups.unshift(group);
}
</script>

<template>
    <!-- <div class="flex gap-2  mt-4"> -->
    <!-- <TextInput :model-value="searchKeyword" placeholder="Type to search" class="w-full"/> -->
    <!-- <button @click="showNewGroupModal = true"
                class="text-sm bg-indigo-500 hover:bg-indigo-600 text-white rounded py-1 px-2 w-[120px]">
            new group
        </button> -->
    <!-- </div> -->
    <div class="lg:flex-1 overflow-auto m-auto">
        <div v-if="false" class="text-gray-400 text-center p-3">
            You are not joined to any groups
        </div>
        <div v-else class="flex flex-col gap-4">
            <GroupItem v-for="group of groups" :group="group" />
            <div
                class="cursor-pointer w-full dark:border-slate-600  hover:bg-zinc-200 dark:hover:bg-zinc-900 duration-300 rounded-full">
                <Link href="/relasi" class="flex items-center gap-2 py-2 px-2 min-w-[200px]">
                <ArrowUpRightIcon
                    class="w-[40px] h-[40px] rounded-full bg-zinc-200 dark:text-zinc-950 dark:bg-zinc-800 p-2 object-cover" />
                <div class="flex-1 flex flex-col pr-2">
                    <h3 class="font-semibold">Selengkapnya</h3>
                </div>
                </Link>
            </div>
        </div>
    </div>

    <GroupModal v-model="showNewGroupModal" @create="onGroupCreate" />
</template>

<style scoped></style>
