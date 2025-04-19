<template>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-12">
            <h1 class="section-title text-center mb-12">Tin tức & Blog</h1>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-blue-500"></div>
            </div>

            <!-- Error State -->
            <div v-else-if="error" class="text-center py-12">
                <p class="text-red-600">{{ error }}</p>
                <button @click="fetchBlogPosts" class="btn-primary mt-4">
                    Thử lại
                </button>
            </div>

            <!-- Data State -->
            <div v-else>
                <!-- Blog Posts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="post in posts" :key="post.id"
                        class="card-hover bg-white rounded-xl overflow-hidden shadow-sm">
                        <div class="relative overflow-hidden group">
                            <img :src="post.image" :alt="post.title"
                                class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="text-sm text-gray-500">{{ formatDate(post.created_at) }}</span>
                            </div>
                            <h2 class="text-xl font-semibold mb-3 text-gray-800 hover:text-blue-600 transition-colors">
                                {{ post.title }}
                            </h2>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ post.excerpt }}</p>
                            <button class="btn-primary w-full">Đọc thêm</button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="pagination" class="mt-8 flex justify-center space-x-2">
                    <button
                        v-for="link in pagination.links"
                        :key="link.label"
                        @click="goToPage(link.url)"
                        :disabled="!link.url || link.active"
                        :class="[
                            'px-4 py-2 rounded-lg',
                            link.active
                                ? 'bg-blue-600 text-white'
                                : link.url
                                    ? 'bg-white text-blue-600 hover:bg-blue-50'
                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                        ]"
                        v-html="link.label"
                    ></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const posts = ref([]);
const loading = ref(true);
const error = ref(null);
const pagination = ref(null);

const formatDate = (dateString) => {
    try {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('vi-VN', options);
    } catch (error) {
        console.error('Date formatting error:', error);
        return dateString;
    }
};

const goToPage = async (url) => {
    if (!url) return;
    try {
        loading.value = true;
        const response = await axios.get(url);
        posts.value = response.data.data.data;
        pagination.value = {
            current_page: response.data.data.current_page,
            last_page: response.data.data.last_page,
            links: response.data.data.links
        };
    } catch (err) {
        error.value = 'Không thể tải trang. Vui lòng thử lại sau.';
    } finally {
        loading.value = false;
    }
};

const fetchBlogPosts = async () => {
    try {
        loading.value = true;
        error.value = null;
        const response = await axios.get('/api/blog-posts');

        // Kiểm tra và lưu dữ liệu
        if (response.data && response.data.data) {
            posts.value = response.data.data.data; // Lấy mảng bài viết từ response
            pagination.value = {
                current_page: response.data.data.current_page,
                last_page: response.data.data.last_page,
                links: response.data.data.links
            };
        } else {
            throw new Error('Invalid response format');
        }
    } catch (err) {
        console.error('Error fetching blog posts:', err);
        error.value = 'Không thể tải bài viết. Vui lòng thử lại sau.';
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchBlogPosts();
});
</script>

<style scoped>
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Đảm bảo nội dung HTML trong pagination hiển thị đúng */
:deep(.pagination) a {
    text-decoration: none;
}
</style>
