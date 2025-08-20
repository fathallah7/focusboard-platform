<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const dashboardData = ref({
    analytics: {
        tasks: {
            all: 0,
            completed: 0,
            pending: 0,
            in_progress: 0
        },
        quotes: {
            all: 0,
            likes: 0,
            dislikes: 0
        }
    },
    content: []
});

const fetchDashboardData = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/dashboard');
        console.log(response.data);
        dashboardData.value = response.data;
        return response.data;
    } catch (error) {
        console.error('Error fetching dashboard data:', error);
        return null;
    }
};

onMounted(() => {
    fetchDashboardData();
});
</script>

<template>
    <div class="space-y-8">
        <!-- Dashboard Title -->
        <div class="flex justify-between items-center">
            <h1
                class="text-2xl sm:text-3xl md:text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                Dashboard
            </h1>
        </div>

        <!-- Tasks Section -->
        <div>
            <!-- Summary Widget -->
            <div class="mb-6 bg-gray-800 glassmorphism p-4 sm:p-6 rounded-xl shadow-lg">
                <h3 class="text-lg sm:text-xl font-semibold text-indigo-300 mb-4">
                    Summary
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-base sm:text-lg text-gray-300">Total Tasks</p>
                        <p class="text-xl sm:text-2xl font-bold text-indigo-400">
                            {{ dashboardData.analytics.tasks.all }}
                        </p>
                    </div>
                    <div>
                        <p class="text-base sm:text-lg text-gray-300">Total Quotes</p>
                        <p class="text-xl sm:text-2xl font-bold text-indigo-400">
                            {{ dashboardData.analytics.quotes.all }}
                        </p>
                    </div>
                </div>
            </div>

            <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-indigo-300 mb-4 sm:mb-6 flex items-center">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                Tasks Overview
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <!-- Completed Tasks -->
                <div class="bg-gray-800 glassmorphism p-4 sm:p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-fade-in"
                    style="animation-delay: 0.1s;">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-300">
                                Completed Tasks
                            </h3>
                            <p class="text-2xl sm:text-4xl font-bold text-green-400" id="tasks-completed">
                                {{ dashboardData.analytics.tasks.completed }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Pending Tasks -->
                <div class="bg-gray-800 glassmorphism p-4 sm:p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-fade-in"
                    style="animation-delay: 0.2s;">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3">
                            </path>
                        </svg>
                        <div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-300">
                                Pending Tasks
                            </h3>
                            <p class="text-2xl sm:text-4xl font-bold text-yellow-400" id="tasks-pending">
                                {{ dashboardData.analytics.tasks.pending }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- In Progress Tasks -->
                <div class="bg-gray-800 glassmorphism p-4 sm:p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-fade-in"
                    style="animation-delay: 0.3s;">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-300">
                                In Progress Tasks
                            </h3>
                            <p class="text-2xl sm:text-4xl font-bold text-purple-400" id="tasks-in-progress">
                                {{ dashboardData.analytics.tasks.in_progress }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quotes Section -->
        <div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-indigo-300 mb-4 sm:mb-6 flex items-center">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l4-4h3.414m-6.414 0A2 2 0 005 12V6a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H5z">
                    </path>
                </svg>
                Quotes Overview
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Liked Quotes -->
                <div class="bg-gray-800 glassmorphism p-4 sm:p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-fade-in"
                    style="animation-delay: 0.1s;">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                        <div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-300">
                                Liked Quotes
                            </h3>
                            <p class="text-2xl sm:text-4xl font-bold text-green-400" id="quotes-likes">
                                {{ dashboardData.analytics.quotes.likes }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Disliked Quotes -->
                <div class="bg-gray-800 glassmorphism p-4 sm:p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-fade-in"
                    style="animation-delay: 0.2s;">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-red-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-300">
                                Disliked Quotes
                            </h3>
                            <p class="text-2xl sm:text-4xl font-bold text-red-400" id="quotes-dislikes">
                                {{ dashboardData.analytics.quotes.dislikes }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quotes Table -->
        <div class="mt-8 sm:mt-10">
            <!-- Desktop Table -->
            <div class="hidden sm:block overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Quote
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Reactions
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr v-for="quote in dashboardData.content" :key="quote.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-200">
                                {{ quote.quote }}
                            </td>
                            <td
                                class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-200 flex items-center gap-4">
                                <span class="flex items-center gap-1 text-green-500">
                                    <span class="material-icons-outlined text-base">thumb_up</span>
                                    {{ quote.like_count }}
                                </span>
                                <span class="flex items-center gap-1 text-red-500">
                                    <span class="material-icons-outlined text-base">thumb_down</span>
                                    {{ quote.dislike_count }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm font-medium space-x-2">
                                <button @click="deleteQuote(quote.id)"
                                    class="p-1 rounded-full hover:bg-red-100 dark:hover:bg-red-900 dark:hover:text-red-200 text-red-600 dark:text-red-400 group transition-all duration-200">
                                    <span class="material-icons-outlined transform group-hover:scale-110">delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card Layout -->
            <div class="block sm:hidden space-y-4">
                <div v-for="quote in dashboardData.content" :key="quote.id"
                    class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-200 mb-2">
                        {{ quote.quote }}
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1 text-green-500">
                                <span class="material-icons-outlined text-base">thumb_up</span>
                                {{ quote.like_count }}
                            </span>
                            <span class="flex items-center gap-1 text-red-500">
                                <span class="material-icons-outlined text-base">thumb_down</span>
                                {{ quote.dislike_count }}
                            </span>
                        </div>
                        <button @click="deleteQuote(quote.id)"
                            class="p-1 rounded-full hover:bg-red-100 dark:hover:bg-red-900 dark:hover:text-red-200 text-red-600 dark:text-red-400 group transition-all duration-200">
                            <span class="material-icons-outlined transform group-hover:scale-110">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.glassmorphism {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>