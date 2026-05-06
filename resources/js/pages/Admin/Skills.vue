<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ skills: Array })

const form = useForm({ name: '' })

function add() {
    form.post('/admin/skills', {
        onSuccess: () => form.reset()
    })
}

function destroy(id) {
    useForm({}).delete(`/admin/skills/${id}`)
}
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-black mb-8">Skills</h1>

        <!-- ADD FORM -->
        <div class="bg-white/5 border border-white/10 rounded-xl p-6 max-w-md mb-8">
            <form @submit.prevent="add" class="flex gap-3">
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="e.g. Docker"
                    class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-500/50 transition-colors"
                />
                <button type="submit" :disabled="form.processing" class="bg-[#ff6b2b] text-white px-5 py-2 rounded-xl text-sm font-medium hover:opacity-90 disabled:opacity-50">
                    Add
                </button>
            </form>
        </div>

        <!-- SKILLS LIST -->
        <div class="flex flex-wrap gap-3 max-w-2xl">
            <div v-for="skill in skills" :key="skill.id"
                class="flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-2 rounded-full">
                <span class="text-sm">{{ skill.name }}</span>
                <button @click="destroy(skill.id)" class="text-white/30 hover:text-red-400 transition-colors text-lg leading-none">
                    ×
                </button>
            </div>
        </div>
    </AdminLayout>
</template>