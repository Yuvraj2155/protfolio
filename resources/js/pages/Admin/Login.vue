<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({ password: '' })

function login() {
    form.post('/admin/login')
}
</script>

<template>
    <div class="min-h-screen bg-[#0a0a0f] flex items-center justify-center">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8 w-80">
            <h1 class="font-black text-2xl text-[#ff6b2b] mb-1">YS. Admin</h1>
            <p class="text-white/40 text-sm mb-6">Enter your password to continue</p>

            <div v-if="form.errors.password" class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl px-4 py-3 mb-4">
                {{ form.errors.password }}
            </div>

            <form @submit.prevent="login" class="flex flex-col gap-4">
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Password"
                    autofocus
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-500/50 transition-colors"
                />
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="bg-[#ff6b2b] text-white py-3 rounded-xl font-medium hover:opacity-90 transition-opacity disabled:opacity-50"
                >
                    {{ form.processing ? 'Logging in...' : 'Login' }}
                </button>
            </form>
        </div>
    </div>
</template>