<script setup>
import {computed, ref} from 'vue'
import {XMarkIcon, CheckCircleIcon, CameraIcon} from '@heroicons/vue/24/solid'
import {TabGroup, TabList, Tab, TabPanels, TabPanel} from '@headlessui/vue'
import {usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TabItem from "@/Pages/Profile/Partials/TabItem.vue";
import Edit from "@/Pages/Profile/Edit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from '@inertiajs/vue3'
import DangerButton from "@/Components/DangerButton.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";
import UserListItem from "@/Components/app/UserListItem.vue";
import TextInput from "@/Components/TextInput.vue";
import PostAttachments from "@/Components/app/PostAttachments.vue";
import TabPhotos from "@/Pages/Profile/TabPhotos.vue";


const imagesForm = useForm({
    avatar: null,
    cover: null,
})

const showNotification = ref(true)
const coverImageSrc = ref('')
const avatarImageSrc = ref('')
const searchFollowersKeyword = ref('')
const searchFollowingsKeyword = ref('')
const authUser = usePage().props.auth.user;

const isMyProfile = computed(() => authUser && authUser.id === props.user.id)

const props = defineProps({
    errors: Object,
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    success: {
        type: String,
    },
    isCurrentUserFollower: Boolean,
    followerCount: Number,
    user: {
        type: Object
    },
    posts: Object,
    followers: Array,
    followings: Array,
    photos: Array
});

function onCoverChange(event) {
    imagesForm.cover = event.target.files[0]
    if (imagesForm.cover) {
        const reader = new FileReader()
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        }
        reader.readAsDataURL(imagesForm.cover)
    }
}

function onAvatarChange(event) {
    imagesForm.avatar = event.target.files[0]
    if (imagesForm.avatar) {
        const reader = new FileReader()
        reader.onload = () => {
            avatarImageSrc.value = reader.result;
        }
        reader.readAsDataURL(imagesForm.avatar)
    }
}

function resetCoverImage() {
    imagesForm.cover = null;
    coverImageSrc.value = null
}

function resetAvatarImage() {
    imagesForm.avatar = null;
    avatarImageSrc.value = null
}

function submitCoverImage() {
    imagesForm.post(route('profile.updateImages'), {
        preserveScroll: true,
        onSuccess: (user) => {
            showNotification.value = true
            resetCoverImage()
            setTimeout(() => {
                showNotification.value = false
            }, 3000)
        },
    })
}

function submitAvatarImage() {
    imagesForm.post(route('profile.updateImages'), {
        preserveScroll: true,
        onSuccess: (user) => {
            showNotification.value = true
            resetAvatarImage()
            setTimeout(() => {
                showNotification.value = false
            }, 3000)
        },
    })
}

function followUser() {
    const form = useForm({
        follow: !props.isCurrentUserFollower
    })

    form.post(route('user.follow', props.user.id), {
        preserveScroll: true
    })
}

// function for date joined
function formatDate(date) {
    const today = new Date();
    const postDate = new Date(date);
    const diff = today - postDate;
    const hours = Math.floor(diff / 1000 / 60 / 60);
    if (hours < 24) {
        if (hours < 1) {
            return Math.floor(diff / 1000 / 60) + "m";
        }
        return hours + "j";
    }
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
    <AuthenticatedLayout>
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

                <div class="group relative bg-white dark:bg-black dark:text-gray-100">
                    <img :src="coverImageSrc || user.cover_url || '/img/default_cover.jpg'"
                         class="w-full h-[200px] object-cover">
                    <div class="absolute top-2 right-2" v-if="isMyProfile">
                        <button
                            v-if="!coverImageSrc"
                            class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center opacity-0 group-hover:opacity-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-3 h-3 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/>
                            </svg>

                            Update Cover Image
                            <input type="file" class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                                   @change="onCoverChange"/>
                        </button>
                        <div v-else class="flex gap-2 bg-white p-2 opacity-0 group-hover:opacity-100">
                            <button
                                @click="resetCoverImage"
                                class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center">
                                <XMarkIcon class="h-3 w-3 mr-2"/>
                                Cancel
                            </button>
                            <button
                                @click="submitCoverImage"
                                class="bg-gray-800 hover:bg-gray-900 text-gray-100 py-1 px-2 text-xs flex items-center">
                                <CheckCircleIcon class="h-3 w-3 mr-2"/>
                                Submit
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col max-w-4xl m-auto">
                        <div
                            class="flex items-center justify-center relative group/avatar -mt-[64px] ml-[48px] w-[128px] h-[128px] rounded-full">
                            <img :src="avatarImageSrc || user.avatar_url || '/img/avatar.jpg'"
                                 class="w-full h-full object-cover rounded-full">
                            <button
                                v-if="!avatarImageSrc && isMyProfile"
                                class="absolute left-0 top-0 right-0 bottom-0 bg-black/50 text-gray-200 rounded-full opacity-0 flex items-center justify-center group-hover/avatar:opacity-100">
                                <CameraIcon class="w-8 h-8"/>

                                <input type="file" class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                                       @change="onAvatarChange" v-if="isMyProfile"/>
                            </button>
                            <div v-else class="absolute top-1 right-0 flex flex-col gap-2" v-if="isMyProfile">
                                <button
                                    @click="resetAvatarImage"
                                    class="w-7 h-7 flex items-center justify-center bg-red-500/80 text-white rounded-full">
                                    <XMarkIcon class="h-5 w-5"/>
                                </button>
                                <button
                                    @click="submitAvatarImage"
                                    class="w-7 h-7 flex items-center justify-center bg-emerald-500/80 text-white rounded-full">
                                    <CheckCircleIcon class="h-5 w-5"/>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center flex-1 p-4">
                            <div>
                                <h2 class="font-bold text-lg">{{ user.name }}</h2>
                                <p class="text-xs text-gray-500">
                                    <span class="text-md font-bold text-black dark:text-white">{{ followerCount }}</span> 
                                    followers</p>
                            </div>

                            <div v-if="!isMyProfile">
                                <PrimaryButton v-if="!isCurrentUserFollower" @click="followUser">
                                    Follow
                                </PrimaryButton>
                                <DangerButton v-else @click="followUser">
                                    Unfollow
                                </DangerButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <TabGroup>
                    <div class="bg-white dark:bg-black overflow-auto scrollbar-hide">
                        <TabList class="flex w-[130vw] overflow-x-auto m-auto md:max-w-4xl dark:bg-black dark:text-white">
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="Posts" :selected="selected"/>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="Followers" :selected="selected"/>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="Followings" :selected="selected"/>
                            </Tab>
                            <Tab v-slot="{ selected }" as="template">
                                <TabItem text="Photos" :selected="selected"/>
                            </Tab>
                            <Tab v-if="isMyProfile" v-slot="{ selected }" as="template">
                                <TabItem text="Profile" :selected="selected"/>
                            </Tab>
                        </TabList>
                    </div>
                    <TabPanels class="mt-1 md:mt-2 col-span-3 md:col-span-2 max-w-4xl m-auto">
                        <TabPanel>
                            <template v-if="posts">
                                <div class="grid grid-cols-5 md:gap-x-3">
                                    <div class="col-span-5 md:col-span-3">
                                        <CreatePost />
                                        <PostList :posts="posts.data" v-if="posts.data.length" class="flex-1"/>
                                        <div
                                            v-else
                                            class="py-8 text-center dark:text-gray-100"
                                        >
                                                There are no posts in this profile.
                                        </div>
                                    </div>

                                    <div class="hidden md:inline-block col-span-5 md:col-span-2">
                                        <div class="sticky top
                                        -0">
                                            <div class="bg-white dark:text-white dark:bg-zinc-950 p-3 rounded-2xl shadow">
                                                <h3 class="font-medium">{{ user.name }}</h3>
                                                <!-- follower -->
                                                <div class="flex gap-5">
                                                    <div class="flex justify-between items-center mt-3">
                                                        <p class="font-extrabold">{{ followerCount }}</p>
                                                        <p class="text-gray-500 text-sm ml-1">Followers</p>
                                                    </div>

                                                    <!-- following -->
                                                    <div class="flex justify-between items-center mt-3">
                                                        <p class="font-extrabold">{{ followings.length }}</p>
                                                        <p class="text-gray-500 text-sm ml-1">Following</p>
                                                    </div>
                                                </div>
                                                <!-- joined -->
                                                <hr class="my-3 dark:border-zinc-800">
                                                <!--  -->
                                                <div class="">
                                                    <p class="text-gray-500 text-sm">Bergabung</p>
                                                    <p class="font-medium text-sm">{{ formatDate(user.created_at)  }}</p>
                                                </div>
                                                <!--  -->
                                                <hr class="my-3 dark:border-zinc-800">
                                                <!-- country -->
                                                <div class="">
                                                    <p class="text-gray-500 text-sm">Negara</p>
                                                    <div class="font-medium text-sm">Indonesia</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div v-else class="py-8 text-center dark:text-gray-100">
                                You don't have permission to view these posts.
                            </div>
                        </TabPanel>
                        <TabPanel>
                            <div class="mt-2 md:mt-0 px-2 md:px-0">
                                <div class="mb-3">
                                    <TextInput :model-value="searchFollowersKeyword" placeholder="Type to search"
                                            class="w-full"/>
                                </div>
                                <div v-if="followers.length" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3">
                                    <UserListItem v-for="user of followers"
                                                :user="user"
                                                :key="user.id"
                                                class="shadow rounded-lg"/>
                                </div>
                                <div v-else class="text-center py-8">
                                    User does not have followers.
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel>
                            <div class="mt-2 md:mt-0 px-2 md:px-0">
                                <div class="mb-3">
                                    <TextInput :model-value="searchFollowingsKeyword" placeholder="Type to search"
                                            class="w-full"/>
                                </div>
                                <!-- followw -->
                                <div v-if="followings.length" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3">
                                    <UserListItem v-for="user of followings"
                                                :user="user"
                                                :key="user.id"
                                                class="shadow rounded-lg"/>
                                </div>
                                <div v-else class="text-center py-8">
                                    The user is not following to anybody
                                </div>
                            </div> 
                        </TabPanel>
                        <TabPanel>
                            <TabPhotos :photos="photos" />
                        </TabPanel>
                        <TabPanel v-if="isMyProfile">
                            <Edit :must-verify-email="mustVerifyEmail" :status="status"/>
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
