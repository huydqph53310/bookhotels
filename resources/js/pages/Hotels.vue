<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section class="relative h-[400px]">
            <div class="absolute inset-0">
                <img src="/images/hero/hotels-hero.jpg" alt="Hotels" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
            <div class="relative container mx-auto px-4 h-full flex items-center">
                <div class="text-white max-w-2xl">
                    <h1 class="text-4xl font-bold mb-4">Khách sạn & Resort</h1>
                    <p class="text-lg">Khám phá những nơi nghỉ dưỡng tuyệt vời tại miền Bắc Việt Nam</p>
                </div>
            </div>
        </section>

        <div class="container mx-auto px-4 py-8">
            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Tìm kiếm</label>
                        <input
                            type="text"
                            v-model="filters.search"
                            placeholder="Tên khách sạn hoặc địa điểm"
                            class="w-full px-4 py-2 border rounded-lg"
                            @input="debounceSearch"
                        >
                    </div>

                    <!-- Price Range -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Khoảng giá</label>
                        <select
                            v-model="filters.priceRange"
                            class="w-full px-4 py-2 border rounded-lg"
                            @change="fetchHotels"
                        >
                            <option value="">Tất cả mức giá</option>
                            <option value="0-1000000">Dưới 1 triệu</option>
                            <option value="1000000-2000000">1 - 2 triệu</option>
                            <option value="2000000-3000000">2 - 3 triệu</option>
                            <option value="3000000-999999999">Trên 3 triệu</option>
                        </select>
                    </div>

                    <!-- Rating -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Xếp hạng</label>
                        <select
                            v-model="filters.rating"
                            class="w-full px-4 py-2 border rounded-lg"
                            @change="fetchHotels"
                        >
                            <option value="">Tất cả xếp hạng</option>
                            <option value="5">5 sao</option>
                            <option value="4">4 sao trở lên</option>
                            <option value="3">3 sao trở lên</option>
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Sắp xếp</label>
                        <select
                            v-model="filters.sortBy"
                            class="w-full px-4 py-2 border rounded-lg"
                            @change="fetchHotels"
                        >
                            <option value="price-asc">Giá: Thấp đến cao</option>
                            <option value="price-desc">Giá: Cao đến thấp</option>
                            <option value="rating-desc">Xếp hạng cao nhất</option>
                            <option value="created_at-desc">Mới nhất</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-blue-500"></div>
            </div>

            <!-- Error State -->
            <div v-else-if="error" class="text-center py-12">
                <p class="text-red-600">{{ error }}</p>
                <button @click="fetchHotels" class="btn-primary mt-4">
                    Thử lại
                </button>
            </div>

            <!-- Hotels Grid -->
            <div v-else-if="hotels.data && hotels.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="hotel in hotels.data"
                    :key="hotel.id"
                    class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
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
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ hotel.description }}</p>
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

            <!-- No Results -->
            <div v-else class="text-center py-12">
                <p class="text-gray-600">Không tìm thấy khách sạn nào phù hợp với tiêu chí tìm kiếm</p>
            </div>

            <!-- Pagination -->
            <div v-if="hotels.meta && hotels.data.length > 0" class="mt-8 flex justify-center space-x-2">
                <button
                    v-for="link in hotels.meta.links"
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
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const hotels = ref({
    data: [],
    meta: null
});
const loading = ref(true);
const error = ref(null);

const filters = ref({
    search: '',
    priceRange: '',
    rating: '',
    sortBy: 'created_at-desc'
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(price);
};

const debounceSearch = (() => {
    let timeout;
    return () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            fetchHotels();
        }, 500);
    };
})();

const fetchHotels = async () => {
    try {
        loading.value = true;
        error.value = null;

        const params = new URLSearchParams();

        if (filters.value.search) {
            params.append('search', filters.value.search);
        }

        if (filters.value.priceRange) {
            const [min, max] = filters.value.priceRange.split('-');
            params.append('price_min', min);
            params.append('price_max', max);
        }

        if (filters.value.rating) {
            params.append('rating', filters.value.rating);
        }

        if (filters.value.sortBy) {
            const [field, order] = filters.value.sortBy.split('-');
            params.append('sort_by', field);
            params.append('sort_order', order);
        }

        console.log('Fetching hotels with params:', params.toString());

        const response = await axios.get(`/api/hotels?${params.toString()}`);
        console.log('API Response:', response.data);

        if (response.data.status === 'success' && response.data.data) {
            hotels.value = response.data.data;
        } else {
            throw new Error(response.data.message || 'Failed to fetch hotels');
        }
    } catch (err) {
        console.error('Error details:', err.response?.data || err);
        error.value = err.response?.data?.message || 'Không thể tải danh sách khách sạn. Vui lòng thử lại sau.';
    } finally {
        loading.value = false;
    }
};

const goToPage = (url) => {
    if (url) {
        window.scrollTo(0, 0);
        fetchHotels(url);
    }
};

onMounted(() => {
    fetchHotels();
});
</script>

<style scoped>
.btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg
    hover:bg-blue-700 transition-colors duration-300 text-sm font-medium;
}
</style>
