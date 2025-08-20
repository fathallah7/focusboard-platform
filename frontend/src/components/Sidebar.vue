<script setup lang="ts">
import { RouterLink, useRouter } from 'vue-router';

const router = useRouter();

const logout = () => {
    localStorage.removeItem('token');
    router.push('/login');
};
</script>

<template>
    <aside
        class="border-r border-gray-200 dark:border-gray-600 w-64 bg-white dark:bg-gray-800 shadow-xl flex flex-col h-full transition-all duration-300">
        <div class="h-16 flex items-center justify-center px-6 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                FocusBoard
            </h1>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <RouterLink to="/dashboard"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-700 dark:text-gray-200 font-medium transition-all duration-200 group"
                :class="{ 'bg-indigo-100 dark:bg-gray-700 text-indigo-700 dark:text-indigo-300': $route.path === '/dashboard' }">
                <span
                    class="material-icons-outlined mr-3 transform group-hover:scale-110 transition-transform">dashboard</span>
                Dashboard
            </RouterLink>

            <RouterLink to="/tasks"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-700 dark:text-gray-200 font-medium transition-all duration-200 group"
                :class="{ 'bg-indigo-100 dark:bg-gray-700 text-indigo-700 dark:text-indigo-300': $route.path === '/tasks' }">
                <span
                    class="material-icons-outlined mr-3 transform group-hover:scale-110 transition-transform">check_circle</span>
                Tasks
            </RouterLink>

            <RouterLink to="/quotes"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-700 dark:text-gray-200 font-medium transition-all duration-200 group"
                :class="{ 'bg-indigo-100 dark:bg-gray-700 text-indigo-700 dark:text-indigo-300': $route.path === '/quotes' }">
                <span
                    class="material-icons-outlined mr-3 transform group-hover:scale-110 transition-transform">format_quote</span>
                Quotes
            </RouterLink>

            <RouterLink to="/profile"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-700 hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-700 dark:text-gray-200 font-medium transition-all duration-200 group"
                :class="{ 'bg-indigo-100 dark:bg-gray-700 text-indigo-700 dark:text-indigo-300': $route.path === '/profile' }">
                <span
                    class="material-icons-outlined mr-3 transform group-hover:scale-110 transition-transform">person</span>
                Profile
            </RouterLink>
        </nav>

        <div class="p-4 border-t border-gray-200 dark:border-gray-600">
            <RouterLink to="/login" @click.prevent="logout"
                class="flex items-center p-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900 dark:hover:text-white text-red-600 dark:text-red-400 font-medium transition-all duration-200 group">
                <span
                    class="material-icons-outlined mr-3 transform group-hover:scale-110 transition-transform">logout</span>
                Logout
            </RouterLink>
        </div>
    </aside>
</template>
