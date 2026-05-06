<script setup>
import PortfolioLayout from '@/layouts/PortfolioLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    skills: Array,
    projects: Array,
    settings: Object,
})
</script>
<template>
    <PortfolioLayout>

        <!-- HERO -->
       <!-- HERO -->
<section class="max-w-5xl mx-auto px-6 pt-20 pb-16">
    <div v-if="settings.open_to_work === 'true'" class="inline-flex items-center gap-2 bg-purple-500/10 border border-purple-500/20 text-purple-300 px-4 py-1.5 rounded-full text-sm mb-6">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        Open to internships & opportunities
    </div>

    <h1 class="text-5xl md:text-6xl font-black leading-tight mb-4">
        Hi, I'm <span class="text-[#ff6b2b]">{{ settings.name }}</span> —<br>
        I build full-stack web systems.
    </h1>

    <p class="text-white/50 text-lg max-w-xl leading-relaxed mb-8">
        {{ settings.bio }}
    </p>

    <div class="flex flex-wrap gap-3">
        <Link href="/contact" class="bg-[#ff6b2b] text-white px-6 py-3 rounded-xl font-medium hover:opacity-90 transition-opacity">
            Connect with me
        </Link>
        <a :href="settings.resume_url" download class="border border-white/20 text-white px-6 py-3 rounded-xl font-medium hover:border-white/40 transition-colors">
            Download Resume
        </a>
        <a :href="'https://github.com/' + settings.github_username" target="_blank" class="border border-white/20 text-white px-6 py-3 rounded-xl font-medium hover:border-white/40 transition-colors">
            GitHub
        </a>
        <a :href="settings.linkedin" target="_blank" class="border border-white/20 text-white px-6 py-3 rounded-xl font-medium hover:border-white/40 transition-colors">
            LinkedIn
        </a>
    </div>
</section>
        <!-- SKILLS -->
<section class="max-w-5xl mx-auto px-6 py-12 border-t border-white/10">
    <p class="text-xs uppercase tracking-widest text-[#ff6b2b] font-bold mb-2">What I know</p>
    <h2 class="text-2xl font-black mb-8">Skills & Technologies</h2>
    <div class="flex flex-wrap gap-3">
        <span
            v-for="skill in skills"
            :key="skill.id"
            class="bg-white/5 border border-white/10 px-4 py-2 rounded-lg text-sm hover:border-purple-500/40 hover:bg-purple-500/10 transition-colors cursor-default"
        >
            {{ skill.name }}
        </span>
    </div>
</section>

        <!-- EXPERIENCE -->
        <section class="max-w-5xl mx-auto px-6 py-12 border-t border-white/10">
            <p class="text-xs uppercase tracking-widest text-[#ff6b2b] font-bold mb-2">Background</p>
            <h2 class="text-2xl font-black mb-8">Experience</h2>
            <div class="flex flex-col gap-4">
                <div
                    v-for="exp in experience"
                    :key="exp.title"
                    class="bg-white/5 border border-white/10 rounded-xl p-5 flex gap-4 items-start hover:border-white/20 transition-colors"
                >
                    <div class="text-2xl w-11 h-11 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0">
                        {{ exp.icon }}
                    </div>
                    <div>
                        <h3 class="font-bold">{{ exp.title }}</h3>
                        <p class="text-sm text-white/40 mt-0.5 mb-2">{{ exp.company }} · {{ exp.period }}</p>
                        <p class="text-sm text-white/50 leading-relaxed">{{ exp.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

    </PortfolioLayout>
</template>