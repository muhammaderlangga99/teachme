<script setup>
defineProps({
    selected: Boolean,
    text: String
})
</script>

<template>
    <button
        :class="[
          'px-3 py-2.5 outline-none font-bold focus:outline-none focus:ring-none',
          selected
            ? 'bg-white dark:bg-black md:dark:bg-zinc-950 text-blue-500 font-bold border-b-2 border-blue-500'
            : 'text-gray-700 dark:text-gray-200',
        ]"
    >
        {{ text }}
    </button>
</template>

<style scoped>

</style>
