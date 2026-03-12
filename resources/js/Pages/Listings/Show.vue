<template>
    <div>
        <FlashMessage :message="page.props.flash.success" type="success" />
        <!-- Search Partial -->
        <Search />

        <div class="p-4" style="background: #16140f; border: 1px solid #2a2520;">

            <!-- Back Link -->
            <Link href="/"
                class="inline-flex items-center gap-2 text-sm font-medium ml-4 mt-4 mb-4 transition-colors duration-150"
                style="color: #ffffff;" @mouseover="e => e.currentTarget.style.color = '#f0a047'"
                @mouseleave="e => e.currentTarget.style.color = '#9a8a76'">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </Link>

            <div class="flex flex-col items-center justify-center text-center">

                <!-- Company Logo -->
                <img class="w-48 mr-6 mb-6 rounded-xl object-contain"
                    :src="listing.logo ? `/storage/${listing.logo}` : '/images/no-image.png'" alt="Company logo" />

                <!-- Title -->
                <h3 class="text-2xl mb-2 font-bold" style="font-family: 'Playfair Display', serif; color: #e8e0d0;">
                    {{ listing.title }}
                </h3>

                <!-- Company -->
                <div class="text-xl font-bold mb-4" style="color: #c9a97a;">
                    {{ listing.company }}
                </div>

                <!-- Tags -->
                <ListingTags :tagsCsv="listing.tags" />

                <!-- Location -->
                <div class="flex items-center gap-2 text-lg my-4" style="color: #9a8a76;">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-2.079 3.218-4.512 3.218-7.158C19.5 6.105 16.075 3 12 3S4.5 6.105 4.5 10.17c0 2.646 1.274 5.08 3.217 7.157a19.58 19.58 0 002.683 2.282 16.975 16.975 001.144.742zM12 12.75a2.25 2.25 100-4.5 2.25 2.25 000 4.5z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ listing.location }}
                </div>

                <div class="border w-full mb-6" style="border-color: #2a2520;"></div>

                <!-- Job Description -->
                <div class="w-full text-left">
                    <h3 class="text-3xl font-bold mb-4" style="font-family: 'Playfair Display', serif; color: #e8e0d0;">
                        Job Description
                    </h3>

                    <div class="text-lg space-y-6" style="color: #9a8a76;">

                        <p style="line-height: 1.75;">{{ listing.description }}</p>

                        <!-- Contact Employer -->
                        <button @click="showModal = true"
                            class="flex items-center justify-center gap-2 w-full py-3 rounded-xl font-semibold text-base transition-all duration-200 hover:opacity-80"
                            style="background: #f0a047; color: #0f0e0c; margin-top: 1.5rem;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 01-2.25 2.25h-15a2.25 2.25 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0019.5 4.5h-15a2.25 2.25 00-2.25 2.25" />
                            </svg>
                            Contact Employer
                        </button>

                        <!-- Visit Website -->
                        <a :href="listing.website" target="_blank"
                            class="flex items-center justify-center gap-2 w-full py-3 rounded-xl font-semibold text-base transition-all duration-200 hover:opacity-80"
                            style="background: #1a1815; color: #e8e0d0; border: 1px solid #2a2520;">
                            Visit Website
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-- APPLICATION MODAL -->
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">

            <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 w-full max-w-md">

                <h2 class="text-xl font-bold mb-4" style="color:#e8e0d0">
                    Apply for {{ listing.title }}
                </h2>

                <form @submit.prevent="handleSubmit">

                    <input v-model="form.name" type="text" placeholder="Your Name" required
                        class="w-full mb-3 p-3 rounded-xl bg-[#1a1815] text-[#e8e0d0]" />

                    <input v-model="form.email" type="email" placeholder="Your Email" required
                        class="w-full mb-3 p-3 rounded-xl bg-[#1a1815] text-[#e8e0d0]" />

                    <textarea v-model="form.message" placeholder="Application letter" required
                        class="w-full mb-3 p-3 rounded-xl bg-[#1a1815] text-[#e8e0d0]"></textarea>

                    <!-- IMPROVED DROPZONE -->
                    <div class="border border-dashed rounded-xl p-6 text-center cursor-pointer mb-4 transition-all duration-200"
                        :class="isDragging ? 'border-[#f0a047] shadow-[0_0_12px_rgba(240,160,71,0.6)] bg-[#1a1815]' : 'border-[#2a2520]'"
                        @dragover.prevent="isDragging = true" @dragleave="isDragging = false" @drop.prevent="handleDrop"
                        @click="fileInput.click()">

                        <p class="text-sm" style="color:#9a8a76">
                            Drag & drop CV here or click to upload
                        </p>

                        <p v-if="fileName" class="text-xs mt-2" style="color:#c9a97a">
                            {{ fileName }}
                        </p>

                        <input type="file" ref="fileInput" class="hidden" accept=".pdf,.doc,.docx"
                            @change="handleFileSelect" />
                    </div>

                    <div class="flex gap-2">

                        <button type="submit" :disabled="submitting" class="flex-1 py-3 rounded-xl font-semibold"
                            style="background:#f0a047;color:#0f0e0c">

                            {{ submitting ? 'Sending...' : 'Send Application' }}

                        </button>

                        <button type="button" @click="showModal = false" class="flex-1 py-3 rounded-xl font-semibold"
                            style="background:#1a1815;color:#e8e0d0;border:1px solid #2a2520">

                            Cancel

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import Search from '@/Pages/Partials/_Search.vue'
import ListingTags from '@/Pages/Components/ListingTags.vue'
import SuccessMessage from '@/Pages/Components/FlashMessage.vue'
import { usePage } from '@inertiajs/vue3'
import FlashMessage from '../Components/FlashMessage.vue'

const props = defineProps({
    listing: Object
})

const listing = props.listing

const showModal = ref(false)
const submitting = ref(false)

const fileInput = ref(null)
const fileName = ref(null)
const file = ref(null)

const isDragging = ref(false)

const page = usePage()

const form = reactive({
    name: '',
    email: '',
    message: ''
})

function handleFileSelect(e) {
    file.value = e.target.files[0]
    fileName.value = file.value.name
}

function handleDrop(e) {
    isDragging.value = false
    file.value = e.dataTransfer.files[0]
    fileName.value = file.value.name
}

function handleSubmit() {

    submitting.value = true

    const data = new FormData()

    data.append('name', form.name)
    data.append('email', form.email)
    data.append('message', form.message)

    if (file.value) {
        data.append('cv', file.value)
    }

    router.post(`/listings/${listing.id}/apply`, data, {
        preserveScroll: true,

        onSuccess: () => {

            form.name = ''
            form.email = ''
            form.message = ''

            file.value = null
            fileName.value = null

            showModal.value = false
        },

        onFinish: () => {
            submitting.value = false
        }
    })
}
</script>