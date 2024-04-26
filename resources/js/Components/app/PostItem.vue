<script setup>
import {
    ChatBubbleLeftRightIcon,
    HandThumbUpIcon,
    HeartIcon,
    ChatBubbleOvalLeftEllipsisIcon,
} from "@heroicons/vue/24/outline";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import PostUserHeader from "@/Components/app/PostUserHeader.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import axiosClient from "@/axiosClient.js";
import ReadMoreReadLess from "@/Components/app/ReadMoreReadLess.vue";
import EditDeleteDropdown from "@/Components/app/EditDeleteDropdown.vue";
import PostAttachments from "@/Components/app/PostAttachments.vue";
import CommentList from "@/Components/app/CommentList.vue";
import { computed } from "vue";
import UrlPreview from "@/Components/app/UrlPreview.vue";
import { MapPinIcon } from "@heroicons/vue/24/outline/index.js";

const props = defineProps({
    post: Object,
});

const authUser = usePage().props.auth.user;
const group = usePage().props.group;

const emit = defineEmits(["editClick", "attachmentClick"]);

const postBody = computed(() => {
    let content = props.post.body.replace(
        /(?:(\s+)|<p>)((#\w+)(?![^<]*<\/a>))/g,
        (match, group1, group2) => {
            const encodedGroup = encodeURIComponent(group2);
            return `${
                group1 || ""
            }<a href="/search/${encodedGroup}" class="hashtag">${group2}</a>`;
        }
    );

    return content;
});
const isPinned = computed(() => {
    if (group?.id) {
        return group?.pinned_post_id === props.post.id;
    }

    return authUser?.pinned_post_id === props.post.id;
});

function openEditModal() {
    emit("editClick", props.post);
}

function deletePost() {
    if (window.confirm("Are you sure you want to delete this post?")) {
        router.delete(route("post.destroy", props.post), {
            preserveScroll: true,
        });
    }
}

function pinUnpinPost() {
    const form = useForm({
        forGroup: group?.id,
    });
    let isPinned = false;
    if (group?.id) {
        isPinned = group?.pinned_post_id === props.post.id;
    } else {
        isPinned = authUser?.pinned_post_id === props.post.id;
    }

    form.post(route("post.pinUnpin", props.post.id), {
        preserveScroll: true,
        onSuccess: () => {
            if (group?.id) {
                group.pinned_post_id = isPinned ? null : props.post.id;
            } else {
                authUser.pinned_post_id = isPinned ? null : props.post.id;
            }
        },
    });
}

function openAttachment(ind) {
    emit("attachmentClick", props.post, ind);
}

function sendReaction() {
    axiosClient
        .post(route("post.reaction", props.post), {
            reaction: "like",
        })
        .then(({ data }) => {
            props.post.current_user_has_reaction =
                data.current_user_has_reaction;
            props.post.num_of_reactions = data.num_of_reactions;
        });
}


</script>

<template>
    <div
        class="bg-white md:border shadow dark:bg-black md:dark:bg-zinc-950 dark:border-zinc-800 md:dark:border-none md:border-slate-200 dark:text-gray-100 md:rounded-2xl p-4 md:p-4 md:pb-1.5 border-t-[0.5px] border-slate-100 md:mb-3 hover:bg-slate-50 dark:hover:bg-zinc-950 md:hover:bg-white md:dark:hover:bg-black overflow-x-hidden">
        <div class="flex items-center justify-between ">
            <PostUserHeader :post="post" />
            <div class="flex items-center gap-2">
                <div v-if="isPinned" class="flex items-center text-xs">
                    <MapPinIcon class="h-3 w-3" aria-hidden="true" />
                    pinned
                </div>
                <EditDeleteDropdown :user="post.user" :post="post" @edit="openEditModal" @delete="deletePost"
                    @pin="pinUnpinPost" />
            </div>
        </div>
        <div class="pl-12 -mt-3">
            <div class="mb-3">
                <ReadMoreReadLess :content="postBody" />
                <UrlPreview :preview="post.preview" :url="post.preview_url" />
            </div>
            <div class="grid gap-3 mb-3" :class="[
                    post.attachments.length === 1 ? 'grid-cols-1' : 'grid-cols-2',
                ]">
                <PostAttachments :attachments="post.attachments" @attachmentClick="openAttachment" />
            </div>
            <Disclosure v-slot="{ open }">
                <!--            Like & Comment buttons-->
                <!-- jangan beri nilai null pada jumlah reaction ketika -->
                <div class="flex gap-2 md:border-t border-slate-300 dark:border-gray-800">
                    <button @click="sendReaction"
                        class="text-gray-800 dark:text-gray-100 flex gap-1 items-center md:justify-center rounded-full py-2.5 md:px-4 md:flex-1 md:mt-1.5"
                        :class="[
                            post.current_user_has_reaction
                                ? ' md:hover:bg-red-100 hover:text-red-600 md:dark:hover:bg-gray-900  text-red-500 dark:text-red-500'
                                : ' md:hover:bg-red-100 hover:text-red-600 hover:dark:text-red-600 md:dark:hover:bg-gray-900 ',
                        ]">
                        <HeartIcon :class="[
                            post.current_user_has_reaction
                                ? 'fill-red-600 dark:fill-red-600 w-5 stroke-none'
                                : 'w-5 ',
                        ]" />
                        <p class="mr-0.5">{{ post.num_of_reactions }}</p>
                        {{ post.current_user_has_reaction ? "Suka" : "Suka" }}
                    </button>
                    <DisclosureButton
                        class="text-zinc-800 dark:text-gray-100 flex gap-1 items-center md:justify-center dark:hover:bg-slate-800 rounded-full hover:bg-gray-200 py-2.5 px-4 md:flex-1 md:mt-1.5">
                        <ChatBubbleOvalLeftEllipsisIcon class="w-5 h-5 " />
                        <span class="mr-2">{{ post.num_of_comments }}</span>
                        Komentar
                    </DisclosureButton>
                </div>

                <DisclosurePanel class="comment-list mt-3 max-h-[400px] overflow-auto rounded-xl scrollbar-hide">
                    <CommentList :post="post" :data="{ comments: post.comments }" />
                </DisclosurePanel>
            </Disclosure>
        </div>
    </div>
</template>
