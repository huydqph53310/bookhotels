import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: null,
        loading: false,
        error: null,
        validationErrors: {}
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },

    actions: {
        async register(userData) {
            this.loading = true;
            this.error = null;
            this.validationErrors = {};

            try {
                const response = await axios.post('/register', userData);
                if (response.data.token) {
                    this.setAuth(response.data);
                    return response.data;
                }
            } catch (error) {
                if (error.response?.status === 422) {
                    this.validationErrors = error.response.data.errors;
                    this.error = 'Vui lòng kiểm tra lại thông tin đăng ký';
                } else {
                    this.error = error.response?.data?.message || 'Đã có lỗi xảy ra';
                }
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async login(credentials) {
            this.loading = true;
            this.error = null;
            this.validationErrors = {};

            try {
                const response = await axios.post('/login', credentials);
                if (response.data.token) {
                    this.setAuth(response.data);
                    return response.data;
                }
            } catch (error) {
                if (error.response?.status === 422) {
                    this.validationErrors = error.response.data.errors;
                    this.error = 'Vui lòng kiểm tra lại thông tin đăng nhập';
                } else {
                    this.error = error.response?.data?.message || 'Đã có lỗi xảy ra';
                }
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async logout() {
            try {
                await axios.post('/logout');
                this.clearAuth();
            } catch (error) {
                console.error('Logout error:', error);
            }
        },

        setAuth(data) {
            this.user = data.user;
            this.token = data.token;
            localStorage.setItem('token', data.token);
            localStorage.setItem('user', JSON.stringify(data.user));
            axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
        },

        clearAuth() {
            this.user = null;
            this.token = null;
            this.error = null;
            this.validationErrors = {};
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            delete axios.defaults.headers.common['Authorization'];
        },

        initAuth() {
            const token = localStorage.getItem('token');
            const user = localStorage.getItem('user');
            if (token && user) {
                this.token = token;
                this.user = JSON.parse(user);
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            }
        }
    }
});
