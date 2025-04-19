<template>
    <div class="fixed inset-0 bg-white z-50 flex items-center justify-center" v-if="show">
        <div class="text-center">
            <!-- Logo Animation -->
            <div class="mb-8">
                <div class="animate-bounce">
                    <img src="/images/logo.svg" alt="Logo" class="h-24 mx-auto">
                </div>
            </div>

            <!-- Brand Name -->
            <h1 class="text-4xl font-bold text-primary mb-4 animate-fade-in">
                NorthVN Hotels
            </h1>

            <!-- Loading Indicator -->
            <div class="flex justify-center space-x-2">
                <div v-for="i in 3" :key="i"
                     class="w-3 h-3 bg-primary rounded-full animate-pulse"
                     :style="{ animationDelay: `${i * 0.2}s` }">
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const show = ref(true)

onMounted(() => {
    setTimeout(() => {
        show.value = false
    }, 2000)
})
</script>

<style scoped>
.animate-fade-in {
    animation: fadeIn 1s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
