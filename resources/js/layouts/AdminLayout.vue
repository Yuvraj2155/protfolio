<script setup>
import { Link } from '@inertiajs/vue3'

const links = [
    { href: '/admin', label: 'Overview' },
    { href: '/admin/projects', label: 'Projects' },
    { href: '/admin/skills', label: 'Skills' },
    { href: '/admin/profile', label: 'Profile' },
]
</script>

<template>
    <div class="min-h-screen bg-[#0a0a0f] text-white flex">

        <!-- SIDEBAR -->
        <aside class="w-52 border-r border-white/10 flex flex-col p-4 fixed h-full">
            <div class="font-black text-xl text-[#ff6b2b] mb-8 px-2">YS. Admin</div>

            <nav class="flex flex-col gap-1 flex-1">
                <Link
                    v-for="link in links"
                    :key="link.href"
                    :href="link.href"
                    class="px-3 py-2 rounded-lg text-sm transition-colors"
                    :class="$page.url === link.href
                        ? 'bg-purple-500/20 text-purple-300'
                        : 'text-white/50 hover:text-white hover:bg-white/5'"
                >
                    {{ link.label }}
                </Link>
            </nav>

            <div class="flex flex-col gap-2 mt-4">
                <Link href="/" class="px-3 py-2 rounded-lg text-sm text-white/40 hover:text-white transition-colors">
                    ← View site
                </Link>
                <Link href="/admin/logout" class="px-3 py-2 rounded-lg text-sm text-red-400/70 hover:text-red-400 transition-colors">
                    Logout
                </Link>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="ml-52 flex-1 p-8">
            <slot />
        </main>

    </div>
</template>