<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="min-h-screen bg-[#0a0a0f] text-white font-sans">

        <!-- NAV -->
        <nav class="sticky top-0 z-50 border-b border-white/10 bg-[#0a0a0f]/80 backdrop-blur-md">
            <div class="max-w-5xl mx-auto px-6 h-16 flex items-center justify-between">
                <Link href="/" class="font-black text-xl text-[#ff6b2b] tracking-tight">YS.</Link>
                <div class="flex items-center gap-6">
                    <Link href="/" class="text-sm text-white/50 hover:text-white transition-colors">Home</Link>
                    <Link href="/projects" class="text-sm text-white/50 hover:text-white transition-colors">Projects</Link>
                    <Link href="/contact" class="text-sm text-[#0a0a0f] bg-[#ff6b2b] px-4 py-1.5 rounded-lg hover:opacity-90 transition-opacity font-medium">Connect</Link>
                </div>
            </div>
        </nav>

        <!-- PAGE CONTENT -->
        <main>
            <slot />
        </main>

        <!-- FOOTER -->
        <footer class="border-t border-white/10 mt-20 py-8 text-center text-sm text-white/30">
            Built with Laravel + Vue · Yuvraj Singh © 2025
        </footer>

    </div>
</template>