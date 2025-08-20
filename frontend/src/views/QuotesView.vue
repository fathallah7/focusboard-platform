<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { format } from 'date-fns';
import QuoteCard from '@/components/QuoteCard.vue';

const quotes = ref([]);
const showModal = ref(false);
const newQuote = ref('');

const addQuote = async () => {
    try {
        await axios.post('http://127.0.0.1:8000/api/quotes', {
            quote: newQuote.value
        });
        await fetchQuotes();
        newQuote.value = '';
        showModal.value = false;
    } catch (error) {
        console.error('Error adding quote:', error);
    }
};

const fetchQuotes = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/api/quotes');
        quotes.value = response.data;
        console.log('Quotes fetched successfully:', quotes.value);
    } catch (error) {
        console.error('Error fetching quotes:', error);
    }
};


const formatDate = (date) => {
    return date ? format(new Date(date), 'MMM dd, yyyy') : 'Unknown';
};

onMounted(() => {
    fetchQuotes();
});
</script>

<template>
    <div class="space-y-6 sm:space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center mt-6 sm:mt-10">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 dark:text-gray-100 tracking-tight">
                Inspiring Quotes
            </h2>
            <button @click="showModal = true"
                class="px-3 py-2 sm:px-4 sm:py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition-all duration-300 flex items-center text-sm sm:text-base shadow-md">
                <span class="material-icons-outlined mr-2 text-lg">add_circle</span>
                Add New Quote
            </button>
        </div>

        <!-- Add Quote Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-gray-700/60 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-lg w-full max-w-md">
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Post New Quote
                </h3>
                <form @submit.prevent="addQuote">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quote</label>
                        <textarea v-model="newQuote" required placeholder="Enter The Quote"
                            class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-400 focus:border-indigo-400 resize-y"
                            rows="4"></textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showModal = false"
                            class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-3 py-2 sm:px-4 sm:py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Post Quote
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Quotes List -->
        <QuoteCard v-for="quote in quotes" :key="quote.id" :quote="quote" :formatDate="formatDate" />
    
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons+Outlined");
</style>