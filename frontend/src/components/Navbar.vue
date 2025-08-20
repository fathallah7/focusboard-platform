<template>
    <header
        class="border-b border-gray-200 dark:border-gray-600 h-16 bg-white dark:bg-gray-800 shadow-lg flex items-center justify-between px-6 transition-all duration-300">
        <!-- Hamburger Menu for Mobile -->
        <button
            class="md:hidden p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-300"
            @click="$emit('toggle-sidebar')">
            <span class="material-icons-outlined text-gray-600 dark:text-gray-300">menu</span>
        </button>

        <!-- Right Side Content -->
        <div class="flex items-center space-x-4">
            <button @click="toggleDarkMode()"
                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-300">
                <span class="material-icons-outlined text-gray-600 dark:text-gray-300" id="theme-icon">dark_mode</span>
            </button>
            <button class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none group">
                <span class="material-icons-outlined text-gray-600 dark:text-gray-300">notifications</span>
                <span
                    class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 transition-transform group-hover:scale-110">3</span>
            </button>
            <div class="relative group">
                <RouterLink to="/dashboard">
                    <img src="https://i.pravatar.cc/40" alt="user"
                        class="w-10 h-10 rounded-full border-2 border-indigo-200 dark:border-indigo-600 transition-transform group-hover:scale-105" />
                </RouterLink>
            </div>
        </div>
    </header>
</template>

<script>
import { RouterLink } from 'vue-router';
</script>