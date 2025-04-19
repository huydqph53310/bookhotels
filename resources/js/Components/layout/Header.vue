<template>
    <header class="fixed w-full bg-white shadow-md z-50 transition-all duration-300"
            :class="{ 'py-2': isScrolled, 'py-4': !isScrolled }">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <router-link to="/" class="flex items-center space-x-2">
                        <img src="/images/logo.svg" alt="Logo" class="h-10">
                        <span class="text-2xl font-bold text-primary">NorthVN Hotels</span>
                    </router-link>
                </div>

                <!-- Main Menu -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <router-link
                        v-for="item in menuItems"
                        :key="item.path"
                        :to="item.path"
                        class="text-gray-700 hover:text-primary transition-colors"
                    >
                        {{ item.name }}
                    </router-link>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <router-link
                        to="/login"
                        class="text-gray-700 hover:text-primary transition-colors"
                    >
                        Đăng nhập
                    </router-link>
                    <router-link
                        to="/register"
                        class="bg-primary text-white px-6 py-2 rounded-full hover:bg-primary-dark transition-colors"
                    >
                        Đăng ký
                    </router-link>
                </div>

                <!-- Mobile Menu Button -->
                <button
                    @click="toggleMobileMenu"
                    class="lg:hidden text-gray-700 hover:text-primary"
                >
                    <i class="fas" :class="isMobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            v-show="isMobileMenuOpen"
            class="lg:hidden bg-white border-t"
        >
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col space-y-4">
                    <router-link
                        v-for="item in menuItems"
                        :key="item.path"
                        :to="item.path"
                        class="text-gray-700 hover:text-primary transition-colors"
                        @click="closeMobileMenu"
                    >
                        {{ item.name }}
                    </router-link>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isScrolled = ref(false)
const isMobileMenuOpen = ref(false)

const menuItems = [
    { name: 'Trang chủ', path: '/' },
    { name: 'Khách sạn', path: '/hotels' },
    { name: 'Khuyến mãi', path: '/promotions' },
    { name: 'Blog', path: '/blog' },
    { name: 'Liên hệ', path: '/contact' }
]

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50
}

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.router-link-active {
    color: theme('colors.primary');
}
</style>