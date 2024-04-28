<script setup>
import { ref } from "vue";
import InputTextarea from "@/Components/InputTextarea.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import PostModal from "@/Components/app/PostModal.vue";
import { PhotoIcon } from "@heroicons/vue/24/solid";
import { PencilIcon } from "@heroicons/vue/24/outline";
const authUser = usePage().props.auth.user;

const showModal = ref(false);
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

</script>

<template>
    <div @click="showCreatePostModal"
        class="p-2.5 pencil z-50 inline-block shadow-md rounded-full duration-300 text-white fixed bottom-16 right-4 md:hidden bg-blue-500 h-auto">
        <PencilIcon class="w-6" />
    </div>

    <PostModal :post="newPost" :group="group" v-model="showModal" />
</template>

<style scoped></style>
