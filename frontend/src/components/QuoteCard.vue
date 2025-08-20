<script setup>
import { ref } from 'vue';

const props = defineProps({
    quote: {
        type: Object,
        required: true
    },
    formatDate: {
        type: Function,
        required: true
    }
});

console.log('QuoteCard props:', props);

</script>


<template>


    <div
        class="relative bg-white dark:bg-gray-800 shadow-lg sm:shadow-2xl rounded-xl sm:rounded-2xl p-4 sm:p-6 transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 group">
        <div
            class="absolute inset-0 bg-gradient-to-r from-indigo-100/30 to-transparent dark:from-indigo-900/30 rounded-xl sm:rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
        <div class="flex items-start space-x-3 sm:space-x-4 relative z-10">
            <img :src="`https://i.pravatar.cc/48?img=${quote.user.id || 1}`" alt="user"
                class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border-2 border-indigo-300 dark:border-indigo-500 shadow-sm transform group-hover:scale-110 transition-transform duration-300" />
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-base sm:text-lg md:text-xl font-semibold text-gray-900 dark:text-gray-100">
                        {{ quote.user.name }}
                    </h3>
                    <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1 sm:mt-0">
                        {{ formatDate(quote.created_at) }}
                    </span>
                </div>
                <p
                    class="mt-2 sm:mt-3 text-sm sm:text-base md:text-lg text-gray-700 dark:text-gray-200 italic font-light">
                    "{{ quote.quote }}"
                </p>
                <div class="mt-3 sm:mt-5 flex items-center space-x-3 sm:space-x-4">
                    <button @click="likeQuote(quote.id)"
                        class="flex items-center space-x-1 text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 group transition-all duration-200 transform group-hover:scale-105"
                        aria-label="Like quote">
                        <span
                            class="material-icons-outlined text-lg sm:text-2xl transform group-hover:scale-110 transition-transform">thumb_up</span>
                        <span class="text-xs sm:text-sm font-medium">{{ quote.like_count }}</span>
                    </button>
                    <button @click="dislikeQuote(quote.id)"
                        class="flex items-center space-x-1 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 group transition-all duration-200 transform group-hover:scale-105"
                        aria-label="Dislike quote">
                        <span
                            class="material-icons-outlined text-lg sm:text-2xl transform group-hover:scale-110 transition-transform">thumb_down</span>
                        <span class="text-xs sm:text-sm font-medium">{{ quote.dislike_count }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


</template>