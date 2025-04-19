<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-lg">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-2">
                    Đăng ký tài khoản
                </h2>
                <p class="text-center text-sm text-gray-600">
                    Đã có tài khoản?
                    <router-link to="/login" class="font-medium text-blue-600 hover:text-blue-500">
                        Đăng nhập
                    </router-link>
                </p>
            </div>

            <div v-if="authStore.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ authStore.error }}
            </div>

            <form class="mt-8 space-y-6" @submit.prevent="handleRegister">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                        <input
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': authStore.validationErrors.name }"
                        >
                        <p v-if="authStore.validationErrors.name" class="mt-1 text-sm text-red-600">
                            {{ authStore.validationErrors.name[0] }}
                        </p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': authStore.validationErrors.email }"
                        >
                        <p v-if="authStore.validationErrors.email" class="mt-1 text-sm text-red-600">
                            {{ authStore.validationErrors.email[0] }}
                        </p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                        <input
                            id="phone"
                            type="tel"
                            v-model="form.phone"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': authStore.validationErrors.phone }"
                        >
                        <p v-if="authStore.validationErrors.phone" class="mt-1 text-sm text-red-600">
                            {{ authStore.validationErrors.phone[0] }}
                        </p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                        <input
                            id="password"
                            type="password"
                            v-model="form.password"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': authStore.validationErrors.password }"
                        >
                        <p v-if="authStore.validationErrors.password" class="mt-1 text-sm text-red-600">
                            {{ authStore.validationErrors.password[0] }}
                        </p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Xác nhận mật khẩu
                        </label>
                        <input
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <div class="flex items-center">
                        <input
                            id="terms"
                            type="checkbox"
                            v-model="form.terms"
                            required
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            Tôi đồng ý với
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                điều khoản sử dụng
                            </a>
                            và
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                chính sách bảo mật
                            </a>
                        </label>
                    </div>
                </div>

                <button
                    type="submit"
                    :disabled="authStore.loading || !form.terms"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
                >
                    <span v-if="authStore.loading">Đang xử lý...</span>
                    <span v-else>Đăng ký</span>
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../stores/auth'

const router = useRouter()
const authStore = useAuthStore()

const form = ref({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    terms: false
})

const handleRegister = async () => {
    if (!form.value.terms) {
        authStore.error = 'Vui lòng đồng ý với điều khoản sử dụng'
        return
    }

    try {
        await authStore.register({
            name: form.value.name,
            email: form.value.email,
            phone: form.value.phone,
            password: form.value.password,
            password_confirmation: form.value.password_confirmation
        })
        router.push('/')
    } catch (error) {
        console.error('Registration error:', error)
    }
}
</script>

