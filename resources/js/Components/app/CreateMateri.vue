<script setup>
import { ref } from "vue";
import InputTextarea from "@/Components/InputTextarea.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import PostModal from "@/Components/app/PostModal.vue";
import { PhotoIcon } from "@heroicons/vue/24/solid";

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

function ambilKataKedua(kalimat) {
    // Memisahkan kalimat menjadi array kata-kata
    const kataKata = kalimat.split(" ");

    // Jika hanya ada satu kata, tampilkan saja
    if (kataKata.length === 1) {
        return kataKata[0];
    }

    // Jika lebih dari satu kata, ambil kata kedua
    return kataKata[1];
}
</script>

<template>
    <div
        @click="showCreatePostModal"
        class="py-3 px-3 text-gray-500 rounded-2xl w-full flex items-center cursor-pointer transition-all gap-3 hover:border-blue-500 dark:hover:border-blue-500 mb-3"
    >
        <img
            :src="authUser.avatar_url"
            class="w-[40px] h-[40px] rounded-full transition-all hover:border-blue-500"
        />

        <div class="flex-1">
            <div
                class="text-sm font-semibold bg-slate-200 dark:text-gray-300 dark:bg-slate-950 p-2 rounded-full"
            >
                Buat Materi
            </div>
        </div>

        <!-- <PhotoIcon class="w-7 h-7 text-gray-800 dark:text-gray-300 rotate-12" /> -->
    </div>

    <PostModal :post="newPost" :group="group" v-model="showModal" />
</template>

<style scoped></style>
