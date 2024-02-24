<script setup>
import { computed, ref } from "vue";
import { XMarkIcon, BookmarkIcon } from "@heroicons/vue/24/solid";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import { useForm, usePage } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputTextarea from "@/Components/InputTextarea.vue";
import axiosClient from "@/axiosClient.js";
import BaseModal from "@/Components/app/BaseModal.vue";

const props = defineProps({
    modelValue: Boolean,
});

const page = usePage();
    
const formErrors = ref({});
const form = useForm({
    email: "",
});

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const emit = defineEmits(["update:modelValue", "hide", "create"]);

function closeModal() {
    show.value = false;
    emit("hide");
    resetModal();
}

function resetModal() {
    form.reset();
    formErrors.value = {};
}

function submit() {
    form.post(route("group.inviteUsers", page.props.group.slug), {
        onSuccess(res) {
            console.log(res);
            closeModal();
        },
        onError(res) {
            console.log(res);
        },
    });
}
</script>

<template>
    <BaseModal title="Invite Users" v-model="show" @hide="closeModal">
        <div class="p-4 dark:text-gray-100">
            <div class="mb-3">
                <label>Username or email</label>
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    :class="
                        page.props.errors.email
                            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                            : ''
                    "
                    v-model="form.email"
                    required
                    autofocus
                />
                <div class="text-red-500">{{ page.props.errors.email }}</div>
            </div>
        </div>

        <div class="flex justify-end gap-2 py-3 px-4">
            <button
                @click="show = false"
                class="text-gray-800 flex gap-1 items-center justify-center bg-gray-100 rounded-md hover:bg-gray-200 py-2 px-4"
            >
                <XMarkIcon class="w-5 h-5" />
                Cancel
            </button>
            <button
                type="button"
                class="flex items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                @click="submit"
                :disabled="form.processing"
            >
                <span v-if="form.processing">
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
        </svg>
        Loading...      
                    </span>
                    <span v-else class="px-3">Invite</span>
            </button>
        </div>
    </BaseModal>
</template>
