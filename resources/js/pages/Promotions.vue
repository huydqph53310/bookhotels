<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Khuyến mãi đặc biệt</h1>

        <!-- Promotions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="promo in promotions" :key="promo.id"
                 class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <!-- Promotion Image -->
                <div class="relative">
                    <img :src="promo.image" :alt="promo.title"
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full">
                        Giảm {{ promo.discount }}%
                    </div>
                </div>

                <!-- Promotion Content -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ promo.title }}</h3>
                    <p class="text-gray-600 mb-4">{{ promo.description }}</p>

                    <!-- Validity Period -->
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>Hiệu lực đến: {{ formatDate(promo.validUntil) }}</span>
                    </div>

                    <!-- Promotion Code -->
                    <div class="bg-gray-100 p-3 rounded-lg flex items-center justify-between mb-4">
                        <span class="font-mono text-lg">{{ promo.code }}</span>
                        <button @click="copyCode(promo.code)"
                                class="text-primary hover:text-primary-dark">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>

                    <!-- Action Button -->
                    <router-link :to="promo.link"
                               class="block w-full text-center bg-primary text-white py-2 rounded-lg hover:bg-primary-dark transition-colors">
                        Đặt ngay
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const promotions = ref([
    {
        id: 1,
        title: 'Kỳ nghỉ mùa hè tại Hạ Long',
        description: 'Giảm giá đặc biệt cho kỳ nghỉ 3 ngày 2 đêm tại Vinpearl Resort & Spa Ha Long',
        discount: 30,
        code: 'SUMMER2024',
        validUntil: '2024-08-31',
        image: '/images/promotions/halong-summer.jpg',
        link: '/hotels/vinpearl-halong'
    },
    // Thêm các khuyến mãi khác
])

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('vi-VN')
}

const copyCode = (code) => {
    navigator.clipboard.writeText(code)
    alert('Đã sao chép mã khuyến mãi!')
}
</script>
