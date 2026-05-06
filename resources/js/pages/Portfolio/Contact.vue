<script setup>
import PortfolioLayout from '@/layouts/PortfolioLayout.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ settings: Object })

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: ''
})

const submitted = ref(false)

function send() {
    form.post('/contact', {
        onSuccess: () => {
            submitted.value = true
            form.reset()
        }
    })
}
</script>

<template>
    <PortfolioLayout>
        <section class="max-w-5xl mx-auto px-6 pt-16 pb-20">
            <p class="text-xs uppercase tracking-widest text-[#ff6b2b] font-bold mb-2">Let's talk</p>
            <h1 class="text-4xl font-black mb-12">Connect with me</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <!-- LEFT — LINKS -->
                <div>
                    <h2 class="font-bold text-lg mb-6">Find me here</h2>

                    <div class="flex flex-col gap-1">
                       <a :href="props.settings.linkedin" target="_blank"
    class="flex items-center gap-4 py-4 border-b border-white/10 hover:text-[#ff6b2b] transition-colors group">
    <div class="w-9 h-9 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center text-sm font-bold flex-shrink-0">in</div>
    <div>
        <p class="font-medium text-sm">LinkedIn</p>
        <p class="text-xs text-white/40">{{ props.settings.linkedin }}</p>
    </div>
</a>

<a :href="'https://github.com/' + props.settings.github_username" target="_blank"
    class="flex items-center gap-4 py-4 border-b border-white/10 hover:text-[#ff6b2b] transition-colors group">
    <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-sm font-bold flex-shrink-0">gh</div>
    <div>
        <p class="font-medium text-sm">GitHub</p>
        <p class="text-xs text-white/40">github.com/{{ props.settings.github_username }}</p>
    </div>
</a>

<a :href="'mailto:' + props.settings.email"
    class="flex items-center gap-4 py-4 border-b border-white/10 hover:text-[#ff6b2b] transition-colors group">
    <div class="w-9 h-9 rounded-lg bg-[#ff6b2b]/15 text-[#ff6b2b] flex items-center justify-center text-sm font-bold flex-shrink-0">@</div>
    <div>
        <p class="font-medium text-sm">Email</p>
        <p class="text-xs text-white/40">{{ props.settings.email }}</p>
    </div>
</a>
                    </div>

                 <a :href="props.settings.resume_url" download
    class="mt-8 w-full block text-center bg-[#ff6b2b] text-white py-3 rounded-xl font-medium hover:opacity-90 transition-opacity">
    Download Resume (PDF)
</a>

                    <p class="text-xs text-white/30 mt-4 leading-relaxed">
                        Based in New York. Available for internships, part-time roles, and freelance projects.
                    </p>
                </div>

                <!-- RIGHT — FORM -->
                <div>
                    <h2 class="font-bold text-lg mb-6">Send a message</h2>

                    <!-- SUCCESS STATE -->
                    <div v-if="submitted" class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl p-5 text-sm text-center">
                        Message sent! I'll get back to you soon.
                    </div>

                    <!-- FORM -->
                    <form v-else @submit.prevent="send" class="flex flex-col gap-4">
                        <div>
                            <input
                                v-model="form.name"
                                type="text"
                                placeholder="Your name"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-500/50 transition-colors"
                            />
                            <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
                        </div>

                        <div>
                            <input
                                v-model="form.email"
                                type="email"
                                placeholder="Your email"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-500/50 transition-colors"
                            />
                            <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
                        </div>

                        <div>
                            <input
                                v-model="form.subject"
                                type="text"
                                placeholder="Subject (e.g. Internship opportunity)"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-500/50 transition-colors"
                            />
                        </div>

                        <div>
                            <textarea
                                v-model="form.message"
                                placeholder="What's on your mind?"
                                rows="4"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/30 focus:outline-none focus:border-purple-500/50 transition-colors resize-none"
                            ></textarea>
                            <p v-if="form.errors.message" class="text-red-400 text-xs mt-1">{{ form.errors.message }}</p>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="bg-[#ff6b2b] text-white py-3 rounded-xl font-medium hover:opacity-90 transition-opacity disabled:opacity-50"
                        >
                            {{ form.processing ? 'Sending...' : 'Send Message' }}
                        </button>
                    </form>
                </div>

            </div>
        </section>
    </PortfolioLayout>
</template>