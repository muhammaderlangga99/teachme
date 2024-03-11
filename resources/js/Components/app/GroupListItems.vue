<script setup>
import TextInput from "@/Components/TextInput.vue";
import GroupItem from "@/Components/app/GroupItem.vue";
import { ref } from "vue";
import GroupModal from "@/Components/app/GroupModal.vue";
import {
    UserGroupIcon,
} from "@heroicons/vue/24/outline";


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
                class="cursor-pointer w-full bg-white dark:bg-slate-700 border-2 dark:border-slate-600  hover:bg-gray-300 dark:hover:bg-slate-950 rounded-full"
            >
                <Link
                    href="#"
                    class="flex items-center gap-2 py-2 px-2"
                >
                    <UserGroupIcon
                        class="w-[40px] h-[40px] rounded-full bg-slate-200 dark:bg-slate-500 p-2 object-cover"
                    />
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
