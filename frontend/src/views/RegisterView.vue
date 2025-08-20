<script setup>

import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');

const register = async () => {
    try {
        const response = await axios.post('http://127.0.0.1:8000/api/register/', {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        });
        console.log('Registration successful:', response.data);
        router.push('/login');
    } catch (error) {
        console.error('Error registering:', error);
        alert('Registration failed. Please try again.');
    }
};

</script>


<template>
    <div
        class="w-full min-h-screen bg-gradient-to-br from-indigo-50 via-gray-100 to-purple-50 dark:from-indigo-950 dark:via-gray-900 dark:to-purple-950 flex items-center justify-center p-6 transition-all duration-500">
        <div
            class="relative bg-white dark:bg-gray-900 shadow-2xl rounded-3xl p-8 max-w-md w-full transform hover:shadow-3xl transition-all duration-300">

            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-200/20 to-purple-200/20 dark:from-indigo-800/20 dark:to-purple-800/20 rounded-3xl opacity-50 hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="relative z-10">
                <h2
                    class="text-3xl font-extrabold text-indigo-800 dark:text-indigo-300 tracking-tight mb-8 text-center">
                    Join FocusBoard</h2>
                <form class="space-y-6" @submit.prevent="register">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full
                            Name</label>
                        <input v-model="name" type="text" id="name" placeholder="Enter your full name"
                            class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md"
                            required />
                    </div>

                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input v-model="email" type="email" id="email" placeholder="Enter your email"
                            class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md"
                            required />
                    </div>

                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input v-model="password" type="password" id="password" placeholder="Enter your password"
                            class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md"
                            required />
                    </div>

                    <div>
                        <label for="confirm-password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <input v-model="password_confirmation" type="password" id="confirm-password"
                            placeholder="Confirm your password"
                            class="mt-1 w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md"
                            required />
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md">
                            <span class="material-icons-outlined mr-2 text-lg">person_add</span>
                            Sign Up
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <RouterLink to="/login"
                        class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium transition-colors duration-300">
                        Sign In</RouterLink>
                </p>
            </div>
        </div>
    </div>
</template>

<style>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons+Outlined");
</style>