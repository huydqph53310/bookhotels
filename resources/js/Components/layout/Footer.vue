<template>
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 pt-16 pb-8">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Column 1: About -->
                <div>
                    <div class="flex items-center mb-6">
                        <img src="/images/logo.png" alt="Logo" class="h-8">
                        <span class="ml-2 text-xl font-bold">NorthVN Hotels</span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Khám phá và đặt phòng tại những khách sạn tốt nhất ở miền Bắc Việt Nam với giá ưu đãi và dịch vụ chất lượng.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Liên kết nhanh</h3>
                    <ul class="space-y-3">
                        <li v-for="link in quickLinks" :key="link.path">
                            <router-link
                                :to="link.path"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                {{ link.name }}
                            </router-link>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Liên hệ</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt mt-1 text-primary"></i>
                            <span class="text-gray-400">123 Đường ABC, Quận XYZ, Hà Nội</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-primary"></i>
                            <span class="text-gray-400">1900 1234 567</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-primary"></i>
                            <span class="text-gray-400">contact@northvnhotels.com</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-clock text-primary"></i>
                            <span class="text-gray-400">24/7</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Newsletter -->
                <div>
                    <h3 class="text-lg font-semibold mb-6">Đăng ký nhận tin</h3>
                    <p class="text-gray-400 mb-4">
                        Nhận thông tin ưu đãi mới nhất từ chúng tôi
                    </p>
                    <form @submit.prevent="subscribeNewsletter" class="space-y-4">
                        <div class="relative">
                            <input
                                type="email"
                                v-model="email"
                                placeholder="Email của bạn"
                                class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            <button
                                type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-white px-4 py-1 rounded-md hover:bg-primary-dark transition-colors"
                            >
                                Đăng ký
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        © {{ new Date().getFullYear() }} NorthVN Hotels. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <router-link
                            v-for="link in legalLinks"
                            :key="link.path"
                            :to="link.path"
                            class="text-gray-400 hover:text-white text-sm transition-colors"
                        >
                            {{ link.name }}
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')

const quickLinks = [
    { name: 'Trang chủ', path: '/' },
    { name: 'Giới thiệu', path: '/about' },
    { name: 'Khách sạn', path: '/hotels' },
    { name: 'Khuyến mãi', path: '/promotions' },
    { name: 'Blog', path: '/blog' },
    { name: 'Liên hệ', path: '/contact' }
]

const legalLinks = [
    { name: 'Điều khoản sử dụng', path: '/terms' },
    { name: 'Chính sách bảo mật', path: '/privacy' },
    { name: 'Cookie Policy', path: '/cookies' }
]

const subscribeNewsletter = () => {
    // Implement newsletter subscription logic
    console.log('Subscribe:', email.value)
}
</script>
