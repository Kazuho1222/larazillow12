<template>
    <div class="flex gap-1 justify-center items-center">
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                class="py-2 px-3 rounded-md text-sm font-medium transition-colors duration-200"
                :href="link.url"
                :class="{
                    'bg-indigo-500 text-white hover:bg-indigo-600': link.active,
                    'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600':
                        !link.active,
                }"
                v-html="link.label"
            />
            <span
                v-else
                class="py-2 px-3 rounded-md text-sm font-medium bg-gray-200 text-gray-400 cursor-not-allowed dark:bg-gray-800 dark:text-gray-600"
                v-html="link.label"
            />
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ links: Array });
</script>
