<script setup>
import AdminLayout from '@/layouts/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({ stats: Object })
</script>

<template>
    <AdminLayout>
        <h1 class="text-2xl font-black mb-8">Overview</h1>

        <!-- STATS -->
        <div class="grid grid-cols-2 gap-4 mb-8 max-w-sm">
            <div class="bg-white/5 border border-white/10 rounded-xl p-5">
                <div class="text-3xl font-black text-[#ff6b2b]">{{ stats.projects }}</div>
                <div class="text-xs text-white/40 mt-1">Projects</div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-xl p-5">
                <div class="text-3xl font-black text-purple-400">{{ stats.skills }}</div>
                <div class="text-xs text-white/40 mt-1">Skills</div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="bg-white/5 border border-white/10 rounded-xl p-6 max-w-lg">
            <h2 class="font-bold text-sm text-white/50 mb-4 uppercase tracking-widest">Quick actions</h2>
            <div class="flex flex-wrap gap-3">
                <Link href="/admin/projects" class="bg-[#ff6b2b] text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                    Manage projects
                </Link>
                <Link href="/admin/skills" class="bg-purple-500/20 text-purple-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-500/30 transition-colors">
                    Manage skills
                </Link>
                <Link href="/admin/profile" class="border border-white/20 text-white/70 px-4 py-2 rounded-lg text-sm font-medium hover:border-white/40 transition-colors">
                    Edit profile
                </Link>
            </div>
        </div>

        <!-- NOTE -->
        <div class="mt-6 bg-blue-500/10 border border-blue-500/20 rounded-xl p-5 max-w-lg">
            <p class="text-sm text-blue-300 font-medium mb-1">LinkedIn sync</p>
            <p class="text-xs text-white/40 leading-relaxed">LinkedIn's public API is restricted. Update your profile info manually in the Profile section. GitHub repos sync automatically via the GitHub API once you add your username.</p>
        </div>
    </AdminLayout>
</template>