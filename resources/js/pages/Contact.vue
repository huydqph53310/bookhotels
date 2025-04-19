<template>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h1 class="section-title text-center mb-12">Liên hệ với chúng tôi</h1>
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Form liên hệ -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Gửi tin nhắn</h2>
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div>
                                <label class="block text-gray-700 mb-2">Họ và tên</label>
                                <input type="text" v-model="form.name" class="input-field"
                                    placeholder="Nhập họ và tên của bạn">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Email</label>
                                <input type="email" v-model="form.email" class="input-field"
                                    placeholder="example@email.com">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" v-model="form.phone" class="input-field"
                                    placeholder="0123 456 789">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Nội dung</label>
                                <textarea v-model="form.message" rows="4" class="input-field"
                                    placeholder="Nhập nội dung tin nhắn của bạn"></textarea>
                            </div>
                            <button type="submit" class="btn-primary w-full">
                                Gửi tin nhắn
                            </button>
                        </form>
                    </div>

                    <!-- Thông tin liên hệ -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-8 text-white">
                        <h2 class="text-2xl font-semibold mb-8">Thông tin liên hệ</h2>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Địa chỉ</h3>
                                    <p class="text-blue-100">123 Đường ABC, Quận XYZ, Hà Nội</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Điện thoại</h3>
                                    <p class="text-blue-100">+84 123 456 789</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Email</h3>
                                    <p class="text-blue-100">contact@northvnhotels.com</p>
                                </div>
                            </div>

                            <!-- Social Media Links -->
                            <div class="pt-6 mt-6 border-t border-white/20">
                                <h3 class="font-semibold mb-4">Kết nối với chúng tôi</h3>
                                <div class="flex space-x-4">
                                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-colors">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-colors">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-colors">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add success and error messages -->
    <div v-if="success" class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        Tin nhắn đã được gửi thành công!
    </div>

    <div v-if="error" class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        {{ error }}
    </div>
</template>

<script setup>
import { ref } from 'vue';
import api from '../services/api';

const form = ref({
    name: '',
    email: '',
    phone: '',
    message: ''
});

const loading = ref(false);
const success = ref(false);
const error = ref(null);

const submitForm = async () => {
    try {
        loading.value = true;
        error.value = null;

        await api.post('/contact', form.value);

        success.value = true;
        form.value = {
            name: '',
            email: '',
            phone: '',
            message: ''
        };

        setTimeout(() => {
            success.value = false;
        }, 5000);
    } catch (err) {
        error.value = err.response?.data?.message || 'Có lỗi xảy ra. Vui lòng thử lại sau.';
    } finally {
        loading.value = false;
    }
};
</script>
