<template>
    <section class="relative h-[600px] bg-gray-900">
        <!-- Background Slider -->
        <div class="absolute inset-0">
            <swiper
                :modules="[SwiperAutoplay, SwiperEffectFade]"
                :slides-per-view="1"
                :effect="'fade'"
                :autoplay="{
                    delay: 5000,
                    disableOnInteraction: false
                }"
                class="h-full"
            >
                <swiper-slide v-for="slide in heroSlides" :key="slide.id">
                    <div class="relative h-full">
                        <img
                            :src="slide.image"
                            :alt="slide.title"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </swiper-slide>
            </swiper>
        </div>

        <!-- Content -->
        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold mb-4">
                    Khám phá miền Bắc Việt Nam
                </h1>
                <p class="text-xl mb-8">
                    Đặt phòng khách sạn với giá tốt nhất tại các điểm đến hấp dẫn
                </p>
                <router-link
                    to="/hotels"
                    class="inline-block bg-primary text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-primary/90 transition-colors"
                >
                    Đặt ngay
                </router-link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';

const heroSlides = ref([
    {
        id: 1,
        image: '/images/hero/halong.jpg',
        title: 'Vịnh Hạ Long',
        description: 'Di sản thiên nhiên thế giới'
    },
    {
        id: 2,
        image: '/images/hero/sapa.jpg',
        title: 'Sapa',
        description: 'Thành phố trong sương'
    },
    {
        id: 3,
        image: '/images/hero/hanoi.jpg',
        title: 'Hà Nội',
        description: 'Thủ đô ngàn năm văn hiến'
    }
]);
</script>
