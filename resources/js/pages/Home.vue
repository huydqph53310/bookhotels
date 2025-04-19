<template>
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative h-[600px]">
            <div class="absolute inset-0">
                <img src="/images/logo/main.jpg" alt="Hero background" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
            <div class="relative container mx-auto px-4 h-full flex items-center">
                <div class="text-white max-w-2xl">
                    <h1 class="text-5xl font-bold mb-6">Khám phá Miền Bắc Việt Nam</h1>
                    <p class="text-xl mb-8">Trải nghiệm vẻ đẹp thiên nhiên và văn hóa độc đáo của miền Bắc qua những địa điểm du lịch nổi tiếng.</p>
                    <button class="btn-primary text-lg">Khám phá ngay</button>
                </div>
            </div>
        </section>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-20">
            <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-blue-500"></div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="container mx-auto px-4 py-20">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Lỗi!</strong>
                <span class="block sm:inline">{{ error }}</span>
                <button @click="fetchHomeData" class="btn-primary mt-4">
                    Thử lại
                </button>
            </div>
        </div>

        <template v-else>
            <!-- Featured Destinations -->
            <section class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <h2 class="section-title text-center mb-12">Địa điểm nổi bật</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="destination in homeData.featured_destinations"
                            :key="destination.id"
                            class="card-hover bg-white rounded-xl overflow-hidden shadow-sm">
                            <div class="relative overflow-hidden group h-64">
                                <img :src="destination.image"
                                    :alt="destination.name"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h3 class="text-xl font-semibold mb-1">{{ destination.name }}</h3>
                                    <p class="flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        {{ destination.location }}
                                    </p>
                                </div>
                                <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full">
                                    <div class="flex items-center">
                                        <i class="fas fa-star mr-1"></i>
                                        {{ destination.rating }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <router-link to="/destinations" class="btn-primary">
                            Xem tất cả địa điểm
                        </router-link>
                    </div>
                </div>
            </section>

            <!-- Featured Hotels -->
            <section class="py-16">
                <div class="container mx-auto px-4">
                    <h2 class="section-title text-center mb-12">Khách sạn đề xuất</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="hotel in homeData.featured_hotels"
                            :key="hotel.id"
                            class="card-hover bg-white rounded-xl overflow-hidden shadow-sm">
                            <div class="relative overflow-hidden group h-64">
                                <img :src="hotel.image"
                                    :alt="hotel.name"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full text-sm font-semibold text-blue-600">
                                    {{ formatPrice(hotel.price) }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ hotel.location }}
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ hotel.name }}</h3>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex text-yellow-400">
                                            <i v-for="n in hotel.rating" :key="n" class="fas fa-star"></i>
                                        </div>
                                        <span class="ml-2 text-gray-600">{{ hotel.rating }}/5</span>
                                    </div>
                                    <router-link :to="`/hotels/${hotel.slug}`" class="btn-primary">
                                        Chi tiết
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <router-link to="/hotels" class="btn-primary">
                            Xem tất cả khách sạn
                        </router-link>
                    </div>
                </div>
            </section>

            <!-- Latest Blog Posts -->
            <section class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <h2 class="section-title text-center mb-12">Tin tức mới nhất</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div v-for="post in homeData.latest_posts"
                            :key="post.id"
                            class="card-hover bg-white rounded-xl overflow-hidden shadow-sm">
                            <div class="relative overflow-hidden group h-48">
                                <img :src="post.image"
                                    :alt="post.title"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">
                                    {{ formatDate(post.created_at) }}
                                </div>
                                <h3 class="text-xl font-semibold mb-2 line-clamp-2">{{ post.title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ post.excerpt }}</p>
                                <router-link :to="`/blog/${post.slug}`" class="text-blue-600 hover:text-blue-700 font-medium">
                                    Đọc thêm
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <router-link to="/blog" class="btn-primary">
                            Xem tất cả bài viết
                        </router-link>
                    </div>
                </div>
            </section>
        </template>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const homeData = ref({
    featured_destinations: [],
    featured_hotels: [],
    latest_posts: []
});
const loading = ref(true);
const error = ref(null);

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(price);
};

const formatDate = (dateString) => {
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('vi-VN', options);
};

const fetchHomeData = async () => {
    try {
        loading.value = true;
        error.value = null;
        const response = await axios.get('/api/home');
        homeData.value = response.data.data;
    } catch (err) {
        console.error('Error fetching home data:', err);
        error.value = 'Không thể tải dữ liệu. Vui lòng thử lại sau.';
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchHomeData();
});
</script>

<style scoped>
.section-title {
    @apply text-3xl font-bold mb-8 text-gray-800 relative;
}

.section-title::after {
    content: '';
    @apply absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-600;
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    @apply inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg
    hover:bg-blue-700 transition-colors duration-300 font-medium;
}
</style>