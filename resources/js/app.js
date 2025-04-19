import './bootstrap';
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import '../css/app.css'

// Import components
import Header from './components/layout/Header.vue'
import Footer from './components/layout/Footer.vue'
import Navigation from './components/layout/Navigation.vue'

// Import pages
import Home from './pages/Home.vue'
import Hotels from './pages/Hotels.vue'
import Promotions from './pages/Promotions.vue'
import Blog from './pages/Blog.vue'
import Contact from './pages/Contact.vue'
import Login from './pages/auth/Login.vue'
import Register from './pages/auth/Register.vue'

// Create Vue app
const app = createApp(App)

// Create and use Pinia
const pinia = createPinia()
app.use(pinia)

// Register global components
app.component('app-header', Header)
app.component('app-footer', Footer)
app.component('app-navigation', Navigation)

// Use router
app.use(router)

// Initialize auth store
import { useAuthStore } from './stores/auth'
const authStore = useAuthStore()
authStore.initAuth()

// Mount app
app.mount('#app')
