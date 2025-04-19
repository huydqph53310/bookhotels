<template>
    <div class="bg-white rounded-xl shadow-2xl p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Location -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Điểm đến
                </label>
                <div class="relative">
                    <select
                        v-model="searchForm.location"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >
                        <option value="">Chọn điểm đến</option>
                        <option v-for="location in locations"
                                :key="location.id"
                                :value="location.id">
                            {{ location.name }}
                        </option>
                    </select>
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            </div>

            <!-- Check-in -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nhận phòng
                </label>
                <div class="relative">
                    <input
                        type="date"
                        v-model="searchForm.checkIn"
                        :min="today"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
            </div>

            <!-- Check-out -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Trả phòng
                </label>
                <div class="relative">
                    <input
                        type="date"
                        v-model="searchForm.checkOut"
                        :min="searchForm.checkIn || today"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                    >
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
            </div>

            <!-- Guests -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Số khách
                </label>
                <button
                    @click="toggleGuestSelect"
                    type="button"
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-left"
                >
                    {{ guestSummary }}
                </button>
                <div class="absolute left-3 top-[42px] text-gray-400">
                    <i class="fas fa-user"></i>
                </div>

                <!-- Guest Selection Dropdown -->
                <div v-if="showGuestSelect"
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-lg p-4 z-10">
                    <div class="space-y-4">
                        <!-- Adults -->
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium">Người lớn</div>
                                <div class="text-sm text-gray-500">Từ 13 tuổi trở lên</div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <button
                                    @click="updateGuests('adults', -1)"
                                    class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center"
                                    :disabled="searchForm.adults <= 1"
                                >
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="w-8 text-center">{{ searchForm.adults }}</span>
                                <button
                                    @click="updateGuests('adults', 1)"
                                    class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center"
                                >
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Children -->
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium">Trẻ em</div>
                                <div class="text-sm text-gray-500">2-12 tuổi</div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <button
                                    @click="updateGuests('children', -1)"
                                    class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center"
                                    :disabled="searchForm.children <= 0"
                                >
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="w-8 text-center">{{ searchForm.children }}</span>
                                <button
                                    @click="updateGuests('children', 1)"
                                    class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center"
                                >
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Button -->
        <div class="mt-6">
            <button
                @click="handleSearch"
                class="w-full bg-primary text-white py-4 rounded-lg text-lg font-semibold hover:bg-primary-dark transition-colors"
            >
                Tìm kiếm
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const showGuestSelect = ref(false)

const locations = [
    { id: 'hanoi', name: 'Hà Nội' },
    { id: 'halong', name: 'Hạ Long' },
    { id: 'sapa', name: 'Sapa' },
    { id: 'ninhbinh', name: 'Ninh Bình' }
]

const searchForm = ref({
    location: '',
    checkIn: '',
    checkOut: '',
    adults: 2,
    children: 0
})

const today = computed(() => {
    const date = new Date()
    return date.toISOString().split('T')[0]
})

const guestSummary = computed(() => {
    const total = searchForm.value.adults + searchForm.value.children
    return `${total} khách (${searchForm.value.adults} người lớn, ${searchForm.value.children} trẻ em)`
})

const toggleGuestSelect = () => {
    showGuestSelect.value = !showGuestSelect.value
}

const updateGuests = (type, value) => {
    if (type === 'adults') {
        const newValue = searchForm.value.adults + value
        if (newValue >= 1 && newValue <= 10) {
            searchForm.value.adults = newValue
        }
    } else {
        const newValue = searchForm.value.children + value
        if (newValue >= 0 && newValue <= 5) {
            searchForm.value.children = newValue
        }
    }
}

const handleSearch = () => {
    router.push({
        name: 'hotels',
        query: {
            location: searchForm.value.location,
            checkIn: searchForm.value.checkIn,
            checkOut: searchForm.value.checkOut,
            adults: searchForm.value.adults,
            children: searchForm.value.children
        }
    })
}
</script>