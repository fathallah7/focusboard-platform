<script setup>
import { ref } from 'vue';
import Sidebar from '@/components/Sidebar.vue';
import Navbar from '@/components/Navbar.vue';

// Reactive state for sidebar visibility on mobile
const isSidebarOpen = ref(false);

// Function to toggle sidebar
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<template>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <div :class="[
            'fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl flex flex-col transition-transform duration-300 transform md:static md:translate-x-0',
            isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
        ]">
            <Sidebar />
        </div>

        <!-- Overlay for mobile when sidebar is open -->
        <div v-if="isSidebarOpen" class="fixed inset-0 bg-gray-900/70 bg-opacity-50 z-40 md:hidden"
            @click="toggleSidebar">
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <Navbar @toggle-sidebar="toggleSidebar" />

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div
                    class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 p-6 transition-all duration-500">
                    <div class="max-w-5xl mx-auto">
                        <slot />
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>