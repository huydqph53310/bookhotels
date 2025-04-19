<template>
    <div class="min-h-screen flex flex-col">
        <app-header />
        <main class="flex-grow">
            <router-view></router-view>
        </main>
        <app-footer />
    </div>
</template>

<script setup>
// Components are registered globally
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
