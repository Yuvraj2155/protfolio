<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ settings: Object })

const form = useForm({
    name:            props.settings.name ?? '',
    title:           props.settings.title ?? '',
    bio:             props.settings.bio ?? '',
    location:        props.settings.location ?? '',
    linkedin:        props.settings.linkedin ?? '',
    github_username: props.settings.github_username ?? '',
    email:           props.settings.email ?? '',
    resume_url:      props.settings.resume_url ?? '',
    open_to_work:    props.settings.open_to_work ?? 'true',
})

function save() {
    form.post('/admin/profile')
}
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-black mb-8">Profile</h1>

        <form @submit.prevent="save" class="flex flex-col gap-5 max-w-2xl">

            <div v-if="$page.props.flash?.success" class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl px-4 py-3 text-sm">
                Profile saved successfully.
            </div>

            <!-- BASIC INFO -->
            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <h2 class="text-sm font-bold text-white/50 uppercase tracking-widest mb-5">Basic info</h2>
                <div class="flex flex-col gap-4">
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Full name</label>
                        <input v-model="form.name" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Title / tagline</label>
                        <input v-model="form.title" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Bio</label>
                        <textarea v-model="form.bio" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors resize-none"></textarea>
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Location</label>
                        <input v-model="form.location" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                </div>
            </div>

            <!-- LINKS -->
            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <h2 class="text-sm font-bold text-white/50 uppercase tracking-widest mb-5">Links</h2>
                <div class="flex flex-col gap-4">
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">LinkedIn URL</label>
                        <input v-model="form.linkedin" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">GitHub username</label>
                        <input v-model="form.github_username" type="text" placeholder="e.g. yuvrajsingh" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Contact email</label>
                        <input v-model="form.email" type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                    <div>
                        <label class="text-xs text-white/40 mb-1 block">Resume PDF URL</label>
                        <input v-model="form.resume_url" type="text" placeholder="/resume.pdf" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-purple-500/50 transition-colors" />
                    </div>
                </div>
            </div>

            <!-- STATUS -->
            <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                <h2 class="text-sm font-bold text-white/50 uppercase tracking-widest mb-5">Status</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">Open to work badge</p>
                        <p class="text-xs text-white/40 mt-0.5">Shows the green badge on your homepage</p>
                    </div>
                    <select v-model="form.open_to_work" class="bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-2 text-sm text-white focus:outline-none">
                        <option value="true">Visible</option>
                        <option value="false">Hidden</option>
                    </select>
                </div>
            </div>

            <button type="submit" :disabled="form.processing" class="bg-[#ff6b2b] text-white py-3 rounded-xl font-medium hover:opacity-90 transition-opacity disabled:opacity-50 max-w-xs">
                {{ form.processing ? 'Saving...' : 'Save profile' }}
            </button>

        </form>
    </AdminLayout>
</template>