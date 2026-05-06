<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({ projects: Array })

const showForm = ref(false)
const editing = ref(null)

const form = useForm({
    title: '',
    description: '',
    tags: '',
    github_url: '',
    live_url: '',
    stack: 'laravel',
})

function openAdd() {
    editing.value = null
    form.reset()
    showForm.value = true
}

function openEdit(project) {
    editing.value = project
    form.title = project.title
    form.description = project.description
    form.tags = project.tags.join(', ')
    form.github_url = project.github_url ?? ''
    form.live_url = project.live_url ?? ''
    form.stack = project.stack
    showForm.value = true
}

function save() {
    if (editing.value) {
        form.put(`/admin/projects/${editing.value.id}`, {
            onSuccess: () => { showForm.value = false; form.reset() }
        })
    } else {
        form.post('/admin/projects', {
            onSuccess: () => { showForm.value = false; form.reset() }
        })
    }
}

function destroy(id) {
    if (confirm('Delete this project?')) {
        useForm({}).delete(`/admin/projects/${id}`)
    }
}
</script>

<template>
    <AdminLayout>
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-black">Projects</h1>
            <button @click="openAdd" class="bg-[#ff6b2b] text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                + Add project
            </button>
        </div>

        <!-- ADD/EDIT FORM -->
        <div v-if="showForm" class="bg-white/5 border border-white/10 rounded-xl p-6 mb-8 max-w-2xl">
            <h2 class="font-bold mb-5">{{ editing ? 'Edit project' : 'New project' }}</h2>
            <form @submit.prevent="save" class="flex flex-col gap-4">
                <div>
                    <label class="text-xs text-white/40 mb-1 block">Title</label>
                    <input v-model="form.title" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    <p v-if="form.errors.title" class="text-red-400 text-xs mt-1">{{ form.errors.title }}</p>
                </div>
                <div>
                    <label class="text-xs text-white/40 mb-1 block">Description</label>
                    <textarea v-model="form.description" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors resize-none"></textarea>
                </div>
                <div>
                    <label class="text-xs text-white/40 mb-1 block">Tags (comma separated)</label>
                    <input v-model="form.tags" type="text" placeholder="Laravel, Vue, MySQL" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">GitHub URL</label>
                        <input v-model="form.github_url" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Live URL</label>
                        <input v-model="form.live_url" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                </div>
                <div>
                    <label class="text-xs text-white/40 mb-1 block">Stack</label>
                    <select v-model="form.stack" class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors">
                        <option value="laravel">Laravel</option>
                        <option value="react">React</option>
                        <option value="vue">Vue</option>
                        <option value="js">JavaScript</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" :disabled="form.processing" class="bg-[#ff6b2b] text-white px-5 py-2 rounded-lg text-sm font-medium hover:opacity-90 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Save project' }}
                    </button>
                    <button type="button" @click="showForm = false" class="border border-white/20 text-white/60 px-5 py-2 rounded-lg text-sm hover:border-white/40 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- PROJECTS LIST -->
        <div v-if="projects.length === 0" class="text-white/30 text-sm">
            No projects yet. Click "Add project" to get started.
        </div>

        <div class="flex flex-col gap-4 max-w-2xl">
            <div v-for="project in projects" :key="project.id"
                class="bg-white/5 border border-white/10 rounded-xl p-5 flex items-start justify-between gap-4">
                <div class="flex-1">
                    <h3 class="font-bold text-sm">{{ project.title }}</h3>
                    <p class="text-xs text-white/40 mt-1 leading-relaxed">{{ project.description }}</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span v-for="tag in project.tags" :key="tag"
                            class="text-xs px-2.5 py-1 rounded-full bg-purple-500/15 text-purple-300">
                            {{ tag }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <button @click="openEdit(project)" class="text-xs border border-white/20 text-white/60 px-3 py-1.5 rounded-lg hover:border-white/40 transition-colors">
                        Edit
                    </button>
                    <button @click="destroy(project.id)" class="text-xs border border-red-500/30 text-red-400 px-3 py-1.5 rounded-lg hover:bg-red-500/10 transition-colors">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>