<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GroupList from "@/Components/app/GroupList.vue";
import FollowingList from "@/Components/app/FollowingList.vue";
import CreatePost from "@/Components/app/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Swipe from "@/Components/Swipe.vue";

defineProps ({
    posts: Object,
    groups: Array,
    followings: Array,
});

</script>

<template>
    <Head title="Social Media Website" />

    <AuthenticatedLayout>
        <!-- <pre>{{ posts }}</pre> -->
        <!-- <div class="grid lg:grid-cols-12 gap-3 p-4 h-full">
            <div class="lg:col-span-3 lg:order-1 h-full overflow-hidden">
                <GroupList :groups="groups" />
            </div>
            <div class="lg:col-span-3 lg:order-3 h-full overflow-hidden">
                <FollowingList :users="followings" />
            </div>
            <div
                class="lg:col-span-6 lg:order-2 h-full overflow-hidden flex flex-col"
            >
                <CreatePost />
                <PostList :posts="posts.data" class="flex-1" />
            </div>
        </div> -->
        <div class="min-h-screen">
            <!-- left -->
            <div class="max-w-3xl scrollbar-hide hover:scrollbar-default py-4 overflow-y-auto h-[90vh] px-3 fixed hidden lg:inline-block">
                <GroupList :groups="groups" />
            </div>

            <div
            class="m-auto md:px-2 lg:px-0 max-w-xl lg:order-2 h-full overflow-hidden flex flex-col md:py-4"
            >
                <!-- <div class="mb-2">
                    <GroupList :groups="groups" />
                </div> -->

                <div class="w-full shadow md:inline-block h-52 md:h-60 bg-white dark:bg-black md:dark:bg-zinc-950 md:mb-1.5 md:rounded-3xl overflow-hidden">
                    <Swipe class="mt-10 md:mt-2" />
                </div>

                <CreatePost />
            
                <PostList :posts="posts.data" class="flex-1" />
            </div>


        </div>
    </AuthenticatedLayout>
</template>

<style></style>
