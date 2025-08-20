<script setup lang="ts">
import { RouterLink } from 'vue-router';
</script>

<template>
    <div
        class="min-h-screen bg-gradient-to-br from-indigo-50 via-gray-100 to-purple-50 dark:from-indigo-950 dark:via-gray-900 dark:to-purple-950 transition-all duration-500 overflow-hidden">
        <!-- Navigation Bar -->
        <nav
            class="fixed top-0 left-0 w-full bg-white/90 dark:bg-gray-900/90 backdrop-blur-lg shadow-sm z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="text-2xl font-extrabold text-indigo-800 dark:text-indigo-300">
                    <RouterLink to="/">FocusBoard</RouterLink>
                </div>
                <div class="flex items-center space-x-6">
                    <RouterLink to="/login"
                        class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300 font-medium">
                        Login
                    </RouterLink>
                    <RouterLink to="/register"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300 shadow-md">
                        Sign Up
                    </RouterLink>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative flex items-center justify-center min-h-screen px-6 pt-20 pb-12 overflow-hidden">
            <div
                class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10">
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-200/30 to-purple-200/30 dark:from-indigo-800/30 dark:to-purple-800/30 rounded-3xl opacity-70 transition-opacity duration-500">
            </div>

            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
                <div class="text-center lg:text-left">
                    <h1
                        class="text-5xl lg:text-6xl font-extrabold text-indigo-800 dark:text-indigo-200 tracking-tight mb-6 animate-fadeIn">
                        Master Your Tasks, Ignite Your Inspiration
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-700 dark:text-gray-200 mb-8 max-w-lg animate-slideUp">
                        FocusBoard empowers you to organize tasks, share motivational quotes, and elevate your
                        productivity to new heights.
                    </p>
                    <RouterLink to="/register"
                        class="inline-flex px-8 py-4 bg-indigo-600 text-white text-xl font-semibold rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-400 focus:outline-none transition-all duration-300 shadow-xl hover:shadow-2xl animate-pulse hover:animate-none">
                        <span class="material-icons-outlined mr-2">person_add</span>
                        Start Your Journey
                    </RouterLink>
                </div>

                <div class="relative">
                    <img src="../assets/logo2.webp" alt="Productivity Illustration"
                        class="rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-500" />
                    <div
                        class="absolute -top-12 -left-12 w-48 h-48 bg-indigo-300/20 dark:bg-indigo-700/20 rounded-full blur-3xl animate-pulse">
                    </div>
                    <div
                        class="absolute -bottom-12 -right-12 w-48 h-48 bg-purple-300/20 dark:bg-purple-700/20 rounded-full blur-3xl animate-pulse">
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Quote Section -->
        <section class="py-16 px-6 bg-white/95 dark:bg-gray-900/95">
            <div class="max-w-5xl mx-auto text-center">
                <h2
                    class="text-3xl lg:text-4xl font-extrabold text-indigo-800 dark:text-indigo-300 tracking-tight mb-12 animate-fadeIn">
                    Quote of the Day
                </h2>
                <div
                    class="relative bg-gray-50 dark:bg-gray-800/80 rounded-2xl p-8 shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-200/20 to-purple-200/20 dark:from-indigo-800/20 dark:to-purple-800/20 rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative z-10">
                        <p class="text-xl italic text-gray-700 dark:text-gray-200 mb-4">
                            "The future belongs to those who believe in the beauty of their dreams."
                        </p>
                        <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                            — Eleanor Roosevelt
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 px-6 bg-white/95 dark:bg-gray-900/95">
            <div class="max-w-5xl mx-auto">
                <h2
                    class="text-3xl lg:text-4xl font-extrabold text-indigo-800 dark:text-indigo-300 tracking-tight text-center mb-12 animate-fadeIn">
                    Why Choose FocusBoard
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1: Task Management -->
                    <div
                        class="relative bg-gray-50 dark:bg-gray-800/80 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-indigo-200/20 to-purple-200/20 dark:from-indigo-800/20 dark:to-purple-800/20 rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative z-10">
                            <span
                                class="material-icons-outlined text-5xl text-indigo-600 dark:text-indigo-400 mb-4">check_circle</span>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                Effortless Task Management
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Plan, prioritize, and track your tasks with intuitive tools designed for efficiency.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 2: Quotes Sharing -->
                    <div
                        class="relative bg-gray-50 dark:bg-gray-800/80 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-indigo-200/20 to-purple-200/20 dark:from-indigo-800/20 dark:to-purple-800/20 rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative z-10">
                            <span
                                class="material-icons-outlined text-5xl text-indigo-600 dark:text-indigo-400 mb-4">format_quote</span>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                Motivational Quotes
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Share and discover quotes to keep your inspiration soaring every day.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 3: User Profile -->
                    <div
                        class="relative bg-gray-50 dark:bg-gray-800/80 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-indigo-200/20 to-purple-200/20 dark:from-indigo-800/20 dark:to-purple-800/20 rounded-2xl opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative z-10">
                            <span
                                class="material-icons-outlined text-5xl text-indigo-600 dark:text-indigo-400 mb-4">person</span>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                Personalized Experience
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Customize your profile to manage tasks and quotes in one intuitive hub.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section
            class="py-16 px-6 bg-gradient-to-br from-indigo-200/50 to-purple-200/50 dark:from-indigo-800/50 dark:to-purple-800/50">
            <div class="max-w-5xl mx-auto text-center">
                <h2
                    class="text-3xl lg:text-4xl font-extrabold text-indigo-800 dark:text-indigo-300 tracking-tight mb-12 animate-fadeIn">
                    Our Community in Numbers
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="p-6 bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <span
                            class="material-icons-outlined text-5xl text-indigo-600 dark:text-indigo-400 mb-4">group</span>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">10,000+</h3>
                        <p class="text-gray-600 dark:text-gray-300">Active Users</p>
                    </div>
                    <div
                        class="p-6 bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <span
                            class="material-icons-outlined text-5xl text-indigo-600 dark:text-indigo-400 mb-4">check_circle</span>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">50,000+</h3>
                        <p class="text-gray-600 dark:text-gray-300">Tasks Completed</p>
                    </div>
                    <div
                        class="p-6 bg-white/80 dark:bg-gray-800/80 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <span
                            class="material-icons-outlined text-5xl text-indigo-600 dark:text-indigo-400 mb-4">format_quote</span>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">5,000+</h3>
                        <p class="text-gray-600 dark:text-gray-300">Quotes Shared</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section
            class="py-16 px-6 bg-gradient-to-br from-indigo-200 to-purple-200 dark:from-indigo-800 dark:to-purple-800 text-center relative">
            <div
                class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10">
            </div>
            <div class="relative z-10">
                <h2
                    class="text-3xl lg:text-4xl font-extrabold text-indigo-800 dark:text-indigo-300 mb-6 animate-fadeIn">
                    Join the FocusBoard Community
                </h2>
                <p class="text-lg text-gray-700 dark:text-gray-200 mb-8 max-w-2xl mx-auto">
                    Transform the way you work and stay inspired. Sign up today to unlock your full potential!
                </p>
                <RouterLink to="/register"
                    class="inline-flex px-8 py-4 bg-indigo-600 text-white text-xl font-semibold rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-400 focus:outline-none transition-all duration-300 shadow-xl hover:shadow-2xl animate-pulse hover:animate-none">
                    <span class="material-icons-outlined mr-2">person_add</span>
                    Create Your Account
                </RouterLink>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-900 py-6 px-6">
            <div class="text-center text-gray-600 dark:text-gray-300">
                <p>&copy; 2025 FocusBoard. All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>

<style>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons+Outlined");

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }

    100% {
        transform: scale(1);
    }
}

.animate-fadeIn {
    animation: fadeIn 1s ease-out forwards;
}

.animate-slideUp {
    animation: slideUp 1s ease-out forwards;
    animation-delay: 0.2s;
}

.animate-pulse {
    animation: pulse 2s infinite;
}
</style>