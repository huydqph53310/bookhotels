import { ref } from 'vue'
import axios from 'axios'

export function useAuth() {
    const user = ref(null)
    const isAuthenticated = ref(false)

    const login = async (credentials) => {
        try {
            const response = await axios.post('/api/login', credentials)
            user.value = response.data.user
            isAuthenticated.value = true
            localStorage.setItem('token', response.data.token)
            return response
        } catch (error) {
            console.error('Login error:', error)
            throw error
        }
    }

    const register = async (userData) => {
        try {
            const response = await axios.post('/api/register', userData)
            user.value = response.data.user
            isAuthenticated.value = true
            localStorage.setItem('token', response.data.token)
            return response
        } catch (error) {
            console.error('Registration error:', error)
            throw error
        }
    }

    const logout = async () => {
        try {
            await axios.post('/api/logout')
            user.value = null
            isAuthenticated.value = false
            localStorage.removeItem('token')
        } catch (error) {
            console.error('Logout error:', error)
            throw error
        }
    }

    const checkAuth = async () => {
        try {
            const token = localStorage.getItem('token')
            if (token) {
                const response = await axios.get('/api/user')
                user.value = response.data
                isAuthenticated.value = true
            }
        } catch (error) {
            user.value = null
            isAuthenticated.value = false
            localStorage.removeItem('token')
        }
    }

    return {
        user,
        isAuthenticated,
        login,
        register,
        logout,
        checkAuth
    }
}
