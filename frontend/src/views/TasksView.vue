<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Spinner from '@/components/Spinner.vue';
import { useToast } from 'vue-toastification';

const toast = useToast();

const tasks = ref([]);
const showModal = ref(false);
const showEditModal = ref(false);

const loading = ref(false);

const newTask = ref({
    title: '',
    description: '',
    status: 'pending',
    priority: 'low',
    due_date: ''
});

const editTask = ref({
    id: null,
    title: '',
    description: '',
    status: 'pending',
    priority: 'low',
    due_date: ''
});

const fetchTasks = async () => {
    loading.value = true;
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/tasks');
        tasks.value = response.data;
        console.log('Tasks fetched successfully:', tasks.value);
    } catch (error) {
        console.error('Error fetching tasks:', error);
    }
    finally {
        loading.value = false;
    }
};

const createTask = async () => {
    try {
        await axios.post('http://127.0.0.1:8000/api/tasks', newTask.value);
        await fetchTasks();
        showModal.value = false;
        newTask.value = { title: '', description: '', status: 'pending', priority: 'low', due_date: '' };
        toast.success('Task created successfully!');
    } catch (error) {
        console.error('Error creating task:', error);
        toast.error('Failed to create task.');  
    }
};

const openEditModal = (task) => {
    editTask.value = { ...task };
    showEditModal.value = true;
};

const updateTask = async () => {
    try {
        await axios.put(`http://127.0.0.1:8000/api/tasks/${editTask.value.id}`, editTask.value);
        await fetchTasks();
        showEditModal.value = false;
        toast.success('Task updated successfully!');
    } catch (error) {
        console.error('Error updating task:', error);
        toast.error('Failed to update task.');
    }
};

const deleteTask = async (id) => {
    try {
        await axios.delete(`http://127.0.0.1:8000/api/tasks/${id}`);
        await fetchTasks();
        toast.success('Task deleted successfully!');
    } catch (error) {
        console.error('Error deleting task:', error);
        toast.error('Failed to delete task.');
    }
};

const updateStatus = async (task) => {
    try {
        const updatedTask = { ...task };
        // Cycle through statuses: pending -> in_progress -> completed -> pending
        if (updatedTask.status === 'pending') {
            updatedTask.status = 'in_progress';
        } else if (updatedTask.status === 'in_progress') {
            updatedTask.status = 'completed';
        } else {
            updatedTask.status = 'pending';
        }
        await axios.put(`http://127.0.0.1:8000/api/tasks/${task.id}`, updatedTask);
        await fetchTasks();
    } catch (error) {
        console.error('Error updating task status:', error);
    }
};

onMounted(() => {
    fetchTasks();
});
</script>

<template>
    <div class="space-y-6 sm:space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center mt-6 sm:mt-10">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 dark:text-gray-100 tracking-tight">
                Tasks
            </h2>
            <button @click="showModal = true"
                class="px-3 py-2 sm:px-4 sm:py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300 flex items-center text-sm sm:text-base">
                <span class="material-icons-outlined mr-2">add</span>
                Add New Task
            </button>
        </div>

        <!-- Add Task Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-gray-700/60 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-lg w-full max-w-md">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Add New Task
                </h3>
                <form @submit.prevent="createTask">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input v-model="newTask.title" type="text" required placeholder="Enter The Title"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description
                            (optional)</label>
                        <textarea v-model="newTask.description" placeholder="Enter The Description"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select v-model="newTask.status"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                        <select v-model="newTask.priority"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                        <input v-model="newTask.due_date" type="date" required
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400" />
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showModal = false"
                            class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-3 py-2 sm:px-4 sm:py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Task Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-gray-700/60 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-lg w-full max-w-md">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Edit Task
                </h3>
                <form @submit.prevent="updateTask">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input v-model="editTask.title" type="text" required
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea v-model="editTask.description"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select v-model="editTask.status"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                        <select v-model="editTask.priority"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                        <input v-model="editTask.due_date" type="date" required
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400" />
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showEditModal = false"
                            class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-3 py-2 sm:px-4 sm:py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <Spinner v-if="loading" />

        <div v-else>
            <!-- Desktop Table -->
            <div class="hidden sm:block overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Title
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Priority
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Due Date
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr v-for="task in tasks" :key="task.id"
                            class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td
                                class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                {{ task.title }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ task.description || 'No description' }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" :class="{
                                    'bg-green-100 text-green-800 dark:bg-green-600 dark:text-green-100': task.status === 'completed',
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100': task.status === 'in_progress',
                                    'bg-red-100 text-red-800 dark:bg-red-600 dark:text-red-100': task.status === 'pending'
                                }">
                                    {{ task.status.replace('_', ' ') }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" :class="{
                                    'bg-red-100 text-red-800 dark:bg-red-600 dark:text-red-100': task.priority === 'high',
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100': task.priority === 'medium',
                                    'bg-green-100 text-green-800 dark:bg-green-600 dark:text-green-100': task.priority === 'low'
                                }">
                                    {{ task.priority }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                {{ task.due_date }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button @click="updateStatus(task)"
                                    class="p-1 rounded-full hover:bg-green-100 dark:hover:bg-green-900 text-green-600 dark:text-green-400 group transition-all duration-200"
                                    aria-label="Update task status">
                                    <span
                                        class="material-icons-outlined transform group-hover:scale-110">check_circle</span>
                                </button>
                                <button @click="openEditModal(task)"
                                    class="p-1 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-400 group transition-all duration-200"
                                    aria-label="Edit task">
                                    <span class="material-icons-outlined transform group-hover:scale-110">edit</span>
                                </button>
                                <button @click="deleteTask(task.id)"
                                    class="p-1 rounded-full hover:bg-red-100 dark:hover:bg-red-900 dark:hover:text-red-200 text-red-600 dark:text-red-400 group transition-all duration-200"
                                    aria-label="Delete task">
                                    <span class="material-icons-outlined transform group-hover:scale-110">delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card Layout -->
            <div class="block sm:hidden space-y-4">
                <div v-for="task in tasks" :key="task.id"
                    class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-200 mb-2">
                        {{ task.title }}
                    </h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                        {{ task.description || 'No description' }}
                    </p>
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full" :class="{
                            'bg-green-100 text-green-800 dark:bg-green-600 dark:text-green-100': task.status === 'completed',
                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100': task.status === 'in_progress',
                            'bg-red-100 text-red-800 dark:bg-red-600 dark:text-red-100': task.status === 'pending'
                        }">
                            {{ task.status.replace('_', ' ') }}
                        </span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full" :class="{
                            'bg-red-100 text-red-800 dark:bg-red-600 dark:text-red-100': task.priority === 'high',
                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100': task.priority === 'medium',
                            'bg-green-100 text-green-800 dark:bg-green-600 dark:text-green-100': task.priority === 'low'
                        }">
                            {{ task.priority }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                        Due: {{ task.due_date }}
                    </p>
                    <div class="flex justify-end space-x-2">
                        <button @click="updateStatus(task)"
                            class="p-1 rounded-full hover:bg-green-100 dark:hover:bg-green-900 text-green-600 dark:text-green-400 group transition-all duration-200"
                            aria-label="Update task status">
                            <span class="material-icons-outlined transform group-hover:scale-110">check_circle</span>
                        </button>
                        <button @click="openEditModal(task)"
                            class="p-1 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-400 group transition-all duration-200"
                            aria-label="Edit task">
                            <span class="material-icons-outlined transform group-hover:scale-110">edit</span>
                        </button>
                        <button @click="deleteTask(task.id)"
                            class="p-1 rounded-full hover:bg-red-100 dark:hover:bg-red-900 dark:hover:text-red-200 text-red-600 dark:text-red-400 group transition-all duration-200"
                            aria-label="Delete task">
                            <span class="material-icons-outlined transform group-hover:scale-110">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons+Outlined");
</style>