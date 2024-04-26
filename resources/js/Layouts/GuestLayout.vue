<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import {CommandLineIcon} from '@heroicons/vue/24/solid'
</script>

<template>
    <!-- warning, website still developing -->
    <div class="flex gap-x-1 items-center justify-center text-sm bg-yellow-500 text-gray-100">
        <CommandLineIcon class="w-5 inline-block" />
        <h1 class="py-1">
            website masih dalam tahap pengembangan
        </h1>
    </div>
    <div class="min-h-screen grid grid-cols-2 bg-white dark:bg-black">
       
        <div class="w-full col-span-2  hidden md:inline-block md:col-span-1 overflow-hidden bg-slate-600">
            <div class="bg-slate-400 h-screen w-full overflow-hidden" >
                <img src="https://images.pexels.com/photos/7438099/pexels-photo-7438099.jpeg?auto=compress&cs=tinysrgb" class="w-full h-full object-cover" alt="teachme">
            </div>
        </div>
        

        <div
            class="w-full col-span-2 md:col-span-1 flex"
        >
            <div class="m-auto w-full px-5 md:max-w-lg">
                <img src="/img/graduated.png" class="w-20" alt="teachme">
                <slot />
            </div>
        </div>
        
    </div>
</template>
