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
        class="py-3 px-3 border-t-[0.5px] md:border border-zinc-200 dark:border-zinc-700 md:dark:border-zinc-800 md:dark:bg-zinc-950 text-gray-500 md:rounded-full w-full flex items-center cursor-pointer transition-all gap-3 bg-white dark:bg-black md:hover:border-blue-500 md:dark:hover:border-blue-500 md:mb-1.5"
    >
        <img
            :src="authUser.avatar_url"
            class="w-[40px] h-[40px] rounded-full border-2  object-cover transition-all border-blue-500"
        />

        <div class="flex-1">
            <div
                class="text-sm font-semibold bg-slate-100 dark:text-gray-300 dark:bg-zinc-950 md:dark:bg-zinc-800 p-2 rounded-full"
            >
                tuliskan apapun
                {{ ambilKataKedua(authUser.name) }}
            </div>
        </div>

        <img src="/img/books.png" class="w-9 h-9 md:w-12 md:h-12" alt="">

        <!-- <PhotoIcon class="w-7 h-7 text-gray-800 dark:text-gray-300 rotate-12" /> -->
    </div>

    <PostModal :post="newPost" :group="group" v-model="showModal" />
</template>

<style scoped></style>
