<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const user = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const profilePicture = ref(null);
const profilePicturePreview = ref('https://i.pravatar.cc/150'); // Default preview

const fetchUserData = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/profile');
        user.value = response.data.user;
        // If API returns profile picture URL, set it; otherwise, keep default
        profilePicturePreview.value = response.data.user.profile_picture || 'https://i.pravatar.cc/150';
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
};

const updateUserData = async () => {
    try {
        // Prepare form data for profile update
        const formData = new FormData();
        formData.append('name', user.value.name);
        formData.append('email', user.value.email);
        if (user.value.password) {
            formData.append('password', user.value.password);
            formData.append('password_confirmation', user.value.password_confirmation);
        }
        if (profilePicture.value) {
            formData.append('profile_picture', profilePicture.value);
        }

        const response = await axios.post('http://127.0.0.1:8000/api/profile', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
        user.value = response.data.user;
        profilePicturePreview.value = response.data.user.profile_picture || profilePicturePreview.value;
        user.value.password = '';
        user.value.password_confirmation = '';
        profilePicture.value = null;
    } catch (error) {
        console.error('Error updating user data:', error);
    }
};

const deleteUserAccount = async () => {
    if (!confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        return;
    }
    try {
        await axios.delete('http://127.0.0.1:8000/api/profile');
        localStorage.removeItem('token');
        router.push('/login');
    } catch (error) {
        console.error('Error deleting user account:', error);
    }
};

const handleProfilePictureChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        profilePicture.value = file;
        // Create a preview URL for the selected image
        profilePicturePreview.value = URL.createObjectURL(file);
    }
};

onMounted(() => {
    fetchUserData();
});
</script>

<template>
    <div class="space-y-6 sm:space-y-8 mt-6 sm:mt-10">
        <!-- Header -->
        <h2
            class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 dark:text-gray-100 tracking-tight text-center">
            My Profile
        </h2>

        <!-- Profile Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
            <!-- Profile Picture and Info -->
            <div class="col-span-1 flex flex-col items-center">
                <img :src="profilePicturePreview" alt="User Profile"
                    class="w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 rounded-full border-4 border-indigo-400 dark:border-indigo-600 shadow-lg transform hover:scale-110 transition-transform duration-300" />
                <h3 class="mt-3 sm:mt-4 text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-gray-100">
                    {{ user.name || 'User' }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ user.email || 'No email' }}
                </p>
            </div>

            <!-- Profile Form -->
            <div class="col-span-1 md:col-span-2">
                <form class="space-y-4 sm:space-y-5" @submit.prevent="updateUserData">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full
                            Name</label>
                        <input type="text" id="name" v-model="user.name" required
                            class="mt-1 w-full px-3 py-2 sm:px-4 sm:py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md" />
                    </div>
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" v-model="user.email" required placeholder="Enter your email"
                            class="mt-1 w-full px-3 py-2 sm:px-4 sm:py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md" />
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                            Password</label>
                        <input type="password" id="password" v-model="user.password" placeholder="Enter new password"
                            class="mt-1 w-full px-3 py-2 sm:px-4 sm:py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md" />
                    </div>
                    <div>
                        <label for="confirm-password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm New
                            Password</label>
                        <input type="password" id="confirm-password" v-model="user.password_confirmation"
                            placeholder="Confirm new password"
                            class="mt-1 w-full px-3 py-2 sm:px-4 sm:py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md" />
                    </div>
                    <div>
                        <label for="profile-picture"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Picture</label>
                        <input type="file" id="profile-picture" accept="image/*" @change="handleProfilePictureChange"
                            class="mt-1 w-full px-3 py-2 sm:px-4 sm:py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md" />
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="fetchUserData"
                            class="px-4 py-2 sm:px-5 sm:py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 sm:px-5 sm:py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300 flex items-center shadow-sm hover:shadow-md">
                            <span class="material-icons-outlined mr-2 text-lg">save</span>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="mt-6 sm:mt-10">
            <h3 class="text-base sm:text-lg font-semibold text-red-600 dark:text-red-400">
                Delete Account
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                This action cannot be undone.
            </p>
            <button @click="deleteUserAccount"
                class="mt-2 sm:mt-3 px-4 py-2 sm:px-5 sm:py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-400 focus:outline-none transition-all duration-300 shadow-sm hover:shadow-md">
                Delete My Account
            </button>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/icon?family=Material+Icons+Outlined');
</style>