<script setup>
import PortfolioLayout from '@/layouts/PortfolioLayout.vue'
import { ref, computed } from 'vue'

const props = defineProps({ projects: Array })

const activeFilter = ref('all')
const filters = ['all', 'laravel', 'react', 'vue', 'js', 'other']

const filtered = computed(() =>
    activeFilter.value === 'all'
        ? props.projects
        : props.projects.filter(p => p.stack === activeFilter.value)
)
</script>

<template>
    <PortfolioLayout>

        <section class="max-w-5xl mx-auto px-6 pt-16 pb-20">
            <p class="text-xs uppercase tracking-widest text-[#ff6b2b] font-bold mb-2">My work</p>
            <h1 class="text-4xl font-black mb-8">All Projects</h1>

            <!-- FILTERS -->
            <div class="flex gap-3 mb-10 flex-wrap">
                <button
                    v-for="f in filters"
                    :key="f"
                    @click="activeFilter = f"
                    class="px-4 py-1.5 rounded-full text-sm font-medium border transition-colors capitalize"
                    :class="activeFilter === f
                        ? 'bg-[#ff6b2b] border-[#ff6b2b] text-white'
                        : 'border-white/20 text-white/50 hover:border-white/40 hover:text-white'"
                >
                    {{ f === 'js' ? 'JavaScript' : f }}
                </button>
            </div>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div
                    v-for="project in filtered"
                    :key="project.title"
                    class="bg-white/5 border border-white/10 rounded-xl p-5 flex flex-col gap-3 hover:border-[#ff6b2b]/40 transition-colors"
                >
                    <h3 class="font-bold text-base">{{ project.title }}</h3>
                    <p class="text-sm text-white/50 leading-relaxed flex-1">{{ project.desc }}</p>
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="tag in project.tags"
                            :key="tag"
                            class="text-xs px-2.5 py-1 rounded-full bg-purple-500/15 text-purple-300 border border-purple-500/20"
                        >
                            {{ tag }}
                        </span>
                    </div>
                    <div class="flex gap-3 mt-1">
                        <a :href="project.github" class="text-xs text-emerald-400 border border-emerald-400/25 px-3 py-1.5 rounded-lg hover:bg-emerald-400/10 transition-colors">GitHub</a>
                        <a :href="project.live" class="text-xs text-emerald-400 border border-emerald-400/25 px-3 py-1.5 rounded-lg hover:bg-emerald-400/10 transition-colors">Live</a>
                    </div>
                </div>
            </div>

            <!-- GITHUB SYNC NOTE -->
            <div class="mt-10 border border-white/10 rounded-xl p-5 flex items-center justify-between">
                <div>
                    <p class="font-medium text-sm">GitHub Sync</p>
                    <p class="text-xs text-white/40 mt-0.5">Repos will pull live from GitHub API once connected</p>
                </div>
                <span class="text-xs text-emerald-400">● Ready</span>
            </div>
        </section>

    </PortfolioLayout>
</template>