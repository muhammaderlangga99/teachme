<script setup>
import { computed, ref } from "vue";
import {
    XMarkIcon,
    CheckCircleIcon,
    CameraIcon,
    UserGroupIcon,
    EyeIcon,
    EyeSlashIcon,
    TrashIcon,
    InformationCircleIcon,
    LockOpenIcon,
    LockClosedIcon,
    UserCircleIcon
} from "@heroicons/vue/24/solid";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TabItem from "@/Pages/Profile/Partials/TabItem.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InviteUserModal from "@/Pages/Group/InviteUserModal.vue";
import DeleteGroupModal from "@/Pages/Group/DeleteGroupModal.vue";
import UserListItem from "@/Components/app/UserListItem.vue";
import TextInput from "@/Components/TextInput.vue";
import GroupForm from "@/Components/app/GroupForm.vue";
import PostList from "@/Components/app/PostList.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import TabPhotos from "@/Pages/Profile/TabPhotos.vue";
import ReadMoreReadLess from "@/Components/app/ReadMoreReadLess.vue";

const imagesForm = useForm({
    thumbnail: null,
    cover: null,
});


const showNotification = ref(true);
const coverImageSrc = ref("");
const thumbnailImageSrc = ref("");
const showInviteUserModal = ref(false);
const showDeleteGroupModal = ref(false);
const searchKeyword = ref("");

const authUser = usePage().props.auth.user;

const isCurrentUserAdmin = computed(() => props.group.role === "admin");
const isJoinedToGroup = computed(
    () => props.group.role && props.group.status === "approved"
);

const props = defineProps({
    errors: Object,
    success: {
        type: String,
    },
    group: {
        type: Object,
    },
    posts: Object,
    users: Array,
    requests: Array,
    photos: Array,
});

const aboutForm = useForm({
    name: usePage().props.group.name,
    auto_approval: !!parseInt(usePage().props.group.auto_approval),
    about: usePage().props.group.about,
});

function onCoverChange(event) {
    imagesForm.cover = event.target.files[0];
    if (imagesForm.cover) {
        const reader = new FileReader();
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        };
        reader.readAsDataURL(imagesForm.cover);
    }
}

function onThumbnailChange(event) {
    imagesForm.thumbnail = event.target.files[0];
    if (imagesForm.thumbnail) {
        const reader = new FileReader();
        reader.onload = () => {
            thumbnailImageSrc.value = reader.result;
        };
        reader.readAsDataURL(imagesForm.thumbnail);
    }
}

function resetCoverImage() {
    imagesForm.cover = null;
    coverImageSrc.value = null;
}

function resetThurmbnailImage() {
    imagesForm.thumbnail = null;
    thumbnailImageSrc.value = null;
}

function submitCoverImage() {
    imagesForm.post(route("group.updateImages", props.group.slug), {
        preserveScroll: true,
        onSuccess: () => {
            showNotification.value = true;
            resetCoverImage();
            setTimeout(() => {
                showNotification.value = false;
            }, 3000);
        },
    });
}

function submitThurmbnailImage() {
    imagesForm.post(route("group.updateImages", props.group.slug), {
        preserveScroll: true,
        onSuccess: () => {
            showNotification.value = true;
            resetThurmbnailImage();
            setTimeout(() => {
                showNotification.value = false;
            }, 3000);
        },
    });
}

function joinToGroup() {
    const form = useForm({});

    form.post(route("group.join", props.group.slug), {
        preserveScroll: true,
    });
}

function approveUser(user) {
    const form = useForm({
        user_id: user.id,
        action: "approve",
    });
    form.post(route("group.approveRequest", props.group.slug), {
        preserveScroll: true,
    });
}

function rejectUser(user) {
    const form = useForm({
        user_id: user.id,
        action: "reject",
    });
    form.post(route("group.approveRequest", props.group.slug), {
        preserveScroll: true,
    });
}

function deleteUser(user) {
    console.log("111");
    if (
        !window.confirm(
            `Are you sure you want to remove user "${user.name}" from this group?`
        )
    ) {
        return false;
    }

    const form = useForm({
        user_id: user.id,
    });
    form.delete(route("group.removeUser", props.group.slug), {
        preserveScroll: true,
    });
}

function onRoleChange(user, role) {
    console.log(user, role);
    const form = useForm({
        user_id: user.id,
        role,
    });
    form.post(route("group.changeRole", props.group.slug), {
        preserveScroll: true,
    });
}

function updateGroup() {
    aboutForm.put(route("group.update", props.group.slug), {
        preserveScroll: true,
    });
}

// function for count group member
function countGroupMember() {
    const users = usePage().props.users; // get users from props
    return users.length
}

// get image users from props
const imageUser = computed(() => {
    const users = usePage().props.users; // get users from props
    users.filter((user, index) => index < 8).map((user) => {
        if (!user.avatar_url) {
            return '/img/default_avatar.webp';
        }
        return user.avatar_url;
    });
});

console.log(imageUser.value);




</script>

<template>
    <AuthenticatedLayout>
        <!-- <div class="max-w-[768px] min-h-screen mx-auto h-full overflow-auto"> -->
        <div class="min-h-screen mx-auto h-full overflow-auto">
            <div class="">
                <div
                    v-show="showNotification && success"
                    class="my-2 py-2 px-3 font-medium text-sm bg-emerald-500 text-white"
                >
                    {{ success }}
                </div>
                <div
                    v-if="errors.cover"
                    class="my-2 py-2 px-3 font-medium text-sm bg-red-400 text-white"
                >
                    {{ errors.cover }}
                </div>
                <div
                    class="group relative bg-white dark:bg-black md:dark:bg-zinc-950 dark:text-gray-100"
                >
                    <img
                        :src="
                            coverImageSrc ||
                            group.cover_url ||
                            '/img/default_cover.jpg'
                        "
                        class="w-full h-[200px] object-cover"
                    />
                    <div
                        v-if="isCurrentUserAdmin"
                        class="absolute top-2 right-2"
                    >
                        <button
                            v-if="!coverImageSrc"
                            class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center opacity-0 group-hover:opacity-100"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-3 h-3 mr-2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                />
                            </svg>

                            Update Cover Image
                            <input
                                type="file"
                                class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                                @change="onCoverChange"
                            />
                        </button>
                        <div
                            v-else
                            class="flex gap-2 bg-white p-2 opacity-0 group-hover:opacity-100"
                        >
                            <button
                                @click="resetCoverImage"
                                class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center"
                            >
                                <XMarkIcon class="h-3 w-3 mr-2" />
                                Cancel
                            </button>
                            <button
                                @click="submitCoverImage"
                                class="bg-gray-800 hover:bg-gray-900 text-gray-100 py-1 px-2 text-xs flex items-center"
                            >
                                <CheckCircleIcon class="h-3 w-3 mr-2" />
                                Submit
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col max-w-4xl m-auto">
                        <!-- for image -->
                        <div
                            class="flex items-center justify-center relative group/thumbnail -mt-[64px] w-[128px] translate-x-4 h-[128px] rounded-full"
                        >
                            <img
                                :src="
                                    thumbnailImageSrc ||
                                    group.thumbnail_url ||
                                    '/img/default_avatar.webp'
                                "
                                class="w-full h-full object-cover rounded-full"
                            />
                            <button
                                v-if="isCurrentUserAdmin && !thumbnailImageSrc"
                                class="absolute left-0 top-0 right-0 bottom-0 bg-black/50 text-gray-200 rounded-full opacity-0 flex items-center justify-center group-hover/thumbnail:opacity-100"
                            >
                                <CameraIcon class="w-8 h-8" />

                                <input
                                    type="file"
                                    class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                                    @change="onThumbnailChange"
                                />
                            </button>

                            <div
                                v-else-if="isCurrentUserAdmin"
                                class="absolute top-1 right-0 flex flex-col gap-2"
                            >
                                <button
                                    @click="resetThurmbnailImage"
                                    class="w-7 h-7 flex items-center justify-center bg-red-500/80 text-white rounded-full"
                                >
                                    <XMarkIcon class="h-5 w-5" />
                                </button>
                                <button
                                    @click="submitThurmbnailImage"
                                    class="w-7 h-7 flex items-center justify-center bg-emerald-500/80 text-white rounded-full"
                                >
                                    <CheckCircleIcon class="h-5 w-5" />
                                </button>
                            </div>
                        </div>

                        <!-- for image -->

                        <div
                            class="flex flex-wrap gap-y-2 items-start md:justify-between m-auto w-full md:items-center p-4"
                        >
                            <div>
                                <h2 class="font-extrabold text-xl">{{ group.name }}</h2>
                                <span class="flex gap-1">
                                    <p
                                        class="text-sm text-slate-500"
                                    >
                                        <span v-if="group.auto_approval" class="flex items-center">
                                            <EyeIcon class="w-3 mr-1 py-1 inline"/>
                                            Grup Publik
                                        </span>
                                        <span v-else class="flex items-center">
                                            <EyeSlashIcon class="w-3 mr-1 py-1 inline"/>
                                            Grup Privat
                                        </span>
                                    </p>

                                    <!-- member -->
                                    ·
                                    <span
                                        v-if="group.role"
                                        class="text-sm text-slate-500"
                                    >
                                        {{ countGroupMember() }} Members

                                        <span
                                            v-if="group.num_of_users > 0"
                                            class="text-xs text-slate-500"
                                        >
                                            &middot;
                                            <span
                                                v-if="group.num_of_users > 1"
                                                class="text-xs text-slate-500"
                                            >
                                                {{ group.num_of_posts }} Posts
                                            </span>
                                            <span
                                                v-else
                                                class="text-xs text-slate-500"
                                            >
                                                {{ group.num_of_posts }} Post
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </div>

                            

                            <div class="flex gap-2 w-full md:w-auto">
                                <div>
                                    <button
                                        @click="showDeleteGroupModal = true"
                                        v-if="isCurrentUserAdmin"
                                        class="text-red-600 dark:text-red-400 font-semibold text-xs bg-red-100 hover:bg-red-600 dark:bg-red-950 dark:hover:bg-red-900 h-full p-4 rounded-full hover:text-slate-100 dark:hover:text-slate-300 transition-all uppercase" title="hapus grup"
                                    >
                                        <TrashIcon class="w-5" />
                                    </button>
                                </div>

                                <PrimaryButton class="m-auto w-full flex justify-center"
                                        v-if="!authUser"
                                        :href="route('login')"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                    </svg>
                                    Login
                                </PrimaryButton>

                                <PrimaryButton class="m-auto w-full flex justify-center"
                                    v-if="isCurrentUserAdmin"
                                    @click="showInviteUserModal = true"
                                >
                                <UserGroupIcon class="w-4 mr-1 py-1"/>
                                    Invite Users
                                </PrimaryButton>

                                <PrimaryButton class="m-auto w-full flex justify-center"
                                    v-if="
                                        authUser &&
                                        !group.role &&
                                        group.auto_approval
                                    "
                                    @click="joinToGroup"
                                >
                                <UserGroupIcon class="w-4 mr-1 py-1"/>

                                    Gabung ke Grup
                                </PrimaryButton>
                                <PrimaryButton class="m-auto w-full flex justify-center"
                                    v-if="
                                        authUser &&
                                        !group.role &&
                                        !group.auto_approval
                                    "
                                    @click="joinToGroup"
                                >
                                <UserGroupIcon class="w-4 mr-1 py-1"/>
                                    minta bergabung
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pemisah tab -->
            <div>
            <!-- <div class=" mx-4 mt-0"> -->
                <TabGroup>
                    <div class="bg-white dark:bg-black md:dark:bg-zinc-950 overflow-auto scrollbar-hide">
                        <TabList
                            class="flex w-[130vw] overflow-x-auto m-auto md:max-w-4xl dark:bg-black md:dark:bg-zinc-950 dark:text-white"
                        >
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="Posts" :selected="selected" />
                            </Tab>
                            <Tab
                                v-if="isJoinedToGroup"
                                v-slot="{ selected }"
                                as="template"
                            >
                                <TabItem text="Orang" :selected="selected" />
                            </Tab>
                            <Tab
                                v-if="isCurrentUserAdmin"
                                v-slot="{ selected }"
                                as="template"
                            >
                                <TabItem
                                    text="Pending Requests"
                                    :selected="selected"
                                />
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="Photos" :selected="selected" />
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="About" :selected="selected" />
                            </Tab>
                        </TabList>
                    </div>

                        <TabPanels class="mt-1 md:mt-2 col-span-3 md:col-span-2 max-w-4xl m-auto">
                            <TabPanel>
                                <template v-if="posts && isJoinedToGroup">
                                    <div class="grid grid-cols-5 md:gap-x-3">
                                        <div class="col-span-5 md:col-span-3">
                                            <CreatePost :group="group" />
                                            <PostList
                                                v-if="posts.data.length"
                                                :posts="posts.data"
                                                class="flex-1"
                                            />
                                            <div
                                                v-else
                                                class="py-8 text-center dark:text-gray-100"
                                            >
                                                There are no posts in this group. Be the
                                                first and create it.
                                            </div>
                                        </div>
                                        <div class="hidden md:inline-block md:col-span-2 w-full">
                                            <div class="bg-white dark:bg-zinc-950 dark:text-white border dark:border-none p-4 rounded-2xl">
                                                <div class="flex items-center justify-between">
                                                    <h3 class="font-medium">Tentang</h3>
                                                    <span class="text-xs text-gray-500">
                                                        <InformationCircleIcon class="w-4 h-4 mr-1"/>
                                                    </span>
                                                </div>
                                                <div class="mt-2 text-sm">
                                                    <ReadMoreReadLess :content="group.about" />
                                                </div>

                                                <div class="mt-4">
                                                    <h3 class="font-bold flex items-center">
                                                        <UserCircleIcon class="w-5 h-5 mr-1"/>
                                                        Anggota
                                                    </h3>
                                                    <div class="mt-2 text-sm">
                                                        <div class="flex mt-1 -space-x-4 rtl:space-x-reverse">
                                                            <div
                                                                v-for="user in users"
                                                                :key="user.id"
                                                                class="w-8 h-8 rounded-full overflow-hidden border-2 border-white dark:border-black"
                                                            >
                                                                <img
                                                                    :src="user.avatar_url"
                                                                    :alt="user.name"
                                                                    class="w-full h-full object-cover"
                                                                />
                                                            </div>
                                                        </div>
                                                        <p>
                                                            <span class="text-xs">{{ countGroupMember() }} User</span> 
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- privat -->
                                                <div class="mt-4">
                                                    <h3 class="font-bold flex items-center">
                                                        <span v-if="group.auto_approval">
                                                            <LockOpenIcon class="w-4 mr-1" />
                                                        </span>
                                                        <span v-else>
                                                            <LockClosedIcon class="w-4 mr-1" />
                                                        </span>
                                                        {{ group.auto_approval ? 'Grup Publik' : 'Grup Privat' }}
                                                    </h3>
                                                    <div class="mt-2 text-sm">
                                                        <p>
                                                            <!-- <span class="text-xs">Hanya anggota yang bisa melihat postingan</span>  -->
                                                            {{ group.auto_approval ? 'Siapa pun bisa melihat siapa saja anggota grup ini dan apa yang mereka posting.' : 'Hanya anggota yang bisa melihat siapa saja anggota grup ini dan apa yang mereka posting.'}}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- <div class="mt-4">
                                                    <h3 class="font-bold flex items-center">
                                                        <CameraIcon class="w-5 h-5 mr-1"/>
                                                        Foto
                                                    </h3>
                                                    <div class="mt-2 text-sm">
                                                        <div class="flex mt-1 -space-x-4 rtl:space-x-reverse">
                                                            <div
                                                                v-for="photo in photos"
                                                                :key="photo.id"
                                                                class="w-8 h-8 rounded-full overflow-hidden border-2 border-white dark:border-black"
                                                            >
                                                                <img
                                                                    :src="photo.url"
                                                                    :alt="photo.name"
                                                                    class="w-full h-full object-cover"
                                                                />
                                                            </div>
                                                        </div>
                                                        <p>
                                                            <span class="text-xs">{{ photos.length }} Foto</span> 
                                                        </p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                
                                <div
                                    v-if="!isJoinedToGroup && !group.auto_approval"
                                    class="py-8 text-center dark:text-gray-100"
                                >
                                    You don't have permission to view these posts.
                                </div>
                                <div v-if="!isJoinedToGroup && group.auto_approval">
                                    <template v-if="posts">
                                        <!-- <CreatePost :group="group" /> -->
                                        <PostList
                                            v-if="posts.data.length"
                                            :posts="posts.data"
                                            class="flex-1"
                                        />
                                        <div
                                            v-else
                                            class="py-8 text-center dark:text-gray-100"
                                        >
                                            There are no posts in this group. Be the
                                            first and create it.
                                        </div>
                                    </template>
                                </div>
                            </TabPanel>
                            <TabPanel v-if="isJoinedToGroup">
                                <div class="mt-2 md:mt-0 px-2 md:px-0">
                                    <div class="mb-3">
                                        <TextInput
                                            :model-value="searchKeyword"
                                            placeholder="Type to search"
                                            class="w-full"
                                        />
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3">
                                        <UserListItem
                                            v-for="user of users"
                                            :user="user"
                                            :key="user.id"
                                            :show-role-dropdown="isCurrentUserAdmin"
                                            :disable-role-dropdown="
                                                group.user_id === user.id
                                            "
                                            class="shadow rounded-lg"
                                            @role-change="onRoleChange"
                                            @delete="deleteUser"
                                        />
                                    </div>
                                </div>
                            </TabPanel>
                            <TabPanel v-if="isCurrentUserAdmin" class="">
                                <div
                                    v-if="requests.length"
                                    class="grid grid-cols-2 gap-3"
                                >
                                <!-- request anggota -->
                                    <UserListItem
                                        v-for="user of requests"
                                        :user="user"
                                        :key="user.id"
                                        :for-approve="true"
                                        class="shadow rounded-lg"
                                        @approve="approveUser"
                                        @reject="rejectUser"
                                    />
                                </div>
                                <div class="py-8 text-center dark:text-gray-100">
                                    There are no pending requests.
                                </div>
                            </TabPanel>
                            <TabPanel>
                                <TabPhotos :photos="photos" />
                            </TabPanel>
                            <TabPanel>
                                <template v-if="isCurrentUserAdmin">
                                    <GroupForm :form="aboutForm" />
                                    <PrimaryButton @click="updateGroup">
                                        Submit
                                    </PrimaryButton>
                                </template>
                                <div v-else class="bg-white dark:bg-black md:dark:bg-zinc-950 md:border dark:border-zinc-800 md:rounded-2xl px-4 py-3">
                                    <h3 class="font-medium dark:text-white mb-2">Tentang</h3>
                                    <div
                                        class="ck-content-output dark:text-gray-100 -mt-4"
                                        v-html="group.about"
                                    ></div>
                                </div>
                            </TabPanel>
                        </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>
    <InviteUserModal v-model="showInviteUserModal" />
    <DeleteGroupModal v-model="showDeleteGroupModal" />
</template>

<style scoped></style>
