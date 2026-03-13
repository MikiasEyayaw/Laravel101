<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Listings</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            Edit Listing
          </h1>
        </div>
        <Link
          href="/admin/listings"
          class="inline-flex items-center gap-2 text-sm font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to Listings
        </Link>
      </div>

      <!-- Form Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>

        <form @submit.prevent="updateListing" enctype="multipart/form-data">
          <div class="px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

              <!-- Title (full width) -->
              <div class="sm:col-span-2">
                <label for="title" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Title</label>
                <input
                  type="text"
                  id="title"
                  v-model="form.title"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.title ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.title" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                  {{ form.errors.title }}
                </p>
              </div>

              <!-- Company -->
              <div>
                <label for="company" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Company</label>
                <input
                  type="text"
                  id="company"
                  v-model="form.company"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.company ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.company" class="mt-1.5 text-xs text-red-400">{{ form.errors.company }}</p>
              </div>

              <!-- Location -->
              <div>
                <label for="location" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Location</label>
                <input
                  type="text"
                  id="location"
                  v-model="form.location"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.location ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.location" class="mt-1.5 text-xs text-red-400">{{ form.errors.location }}</p>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Email</label>
                <input
                  type="email"
                  id="email"
                  v-model="form.email"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.email ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-400">{{ form.errors.email }}</p>
              </div>

              <!-- Website -->
              <div>
                <label for="website" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Website</label>
                <input
                  type="text"
                  id="website"
                  v-model="form.website"
                  placeholder="https://example.com"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.website ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.website" class="mt-1.5 text-xs text-red-400">{{ form.errors.website }}</p>
              </div>

              <!-- Tags -->
              <div>
                <label for="tags" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Tags</label>
                <input
                  type="text"
                  id="tags"
                  v-model="form.tags"
                  placeholder="laravel, php, javascript"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.tags ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.tags" class="mt-1.5 text-xs text-red-400">{{ form.errors.tags }}</p>
              </div>

              <!-- Logo Upload -->
              <div>
                <label class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Company Logo</label>

                <!-- Drop zone -->
                <div
                  class="border-2 border-dashed rounded-xl px-4 py-8 text-center cursor-pointer transition-all duration-200"
                  :class="isDragging
                    ? 'border-[#f0a047]/60 bg-[#f0a047]/5'
                    : 'border-[#2a2520] hover:border-[#f0a047]/30 bg-[#1a1815]'"
                  @dragover.prevent="isDragging = true"
                  @dragleave.prevent="isDragging = false"
                  @drop.prevent="handleDrop"
                  @click="$refs.logoInput.click()"
                >
                  <svg class="mx-auto w-9 h-9 mb-2 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                  </svg>
                  <p class="text-sm text-[#8a7a66]">
                    <span class="text-[#f0a047] font-semibold">Click to upload</span> or drag and drop
                  </p>
                  <p class="text-xs text-[#4a3f32] mt-1">PNG, JPG, GIF, SVG up to 2MB</p>
                </div>

                <input
                  ref="logoInput"
                  type="file"
                  class="hidden"
                  accept="image/*"
                  @change="handleFileSelect"
                />

                <!-- Preview -->
                <div v-if="logoPreview || listing.logo" class="mt-3">
                  <div class="relative inline-block">
                    <div class="rounded-xl overflow-hidden border border-[#2a2520] bg-[#1a1815] p-2">
                      <img
                        :src="logoPreview || (listing.logo ? '/storage/' + listing.logo : '')"
                        :alt="form.company + ' logo'"
                        class="h-16 w-auto max-w-xs object-contain rounded-lg"
                        @error="handleImageError"
                      />
                    </div>
                    <button
                      type="button"
                      @click="removeLogo"
                      class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 hover:bg-red-400 text-white rounded-full flex items-center justify-center transition-colors"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                  </div>
                  <p class="mt-1 text-xs text-[#8a7a66]">{{ logoPreview ? 'New logo preview' : 'Current logo' }}</p>
                </div>

                <p v-if="form.errors.logo" class="mt-1.5 text-xs text-red-400">{{ form.errors.logo }}</p>
              </div>

              <!-- Description (full width) -->
              <div class="sm:col-span-2">
                <label for="description" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Description</label>
                <textarea
                  id="description"
                  v-model="form.description"
                  rows="6"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30 resize-none"
                  :class="form.errors.description ? 'border-red-500/60' : ''"
                ></textarea>
                <p v-if="form.errors.description" class="mt-1.5 text-xs text-red-400">{{ form.errors.description }}</p>
              </div>

              <!-- Approved toggle (full width) -->
              <div class="sm:col-span-2">
                <label class="flex items-center gap-3 cursor-pointer group w-fit">
                  <div class="relative">
                    <input
                      type="checkbox"
                      id="is_approved"
                      v-model="form.is_approved"
                      class="sr-only peer"
                    />
                    <div class="w-10 h-6 bg-[#2a2520] peer-checked:bg-emerald-500 rounded-full transition-colors duration-200 border border-[#3a3025] peer-checked:border-emerald-500"></div>
                    <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-[#8a7a66] peer-checked:bg-white rounded-full transition-all duration-200 peer-checked:translate-x-4 shadow"></div>
                  </div>
                  <span class="text-sm font-semibold text-[#c9b99a] group-hover:text-[#e8e0d0] transition-colors duration-150">
                    Approved Listing
                  </span>
                </label>
                <p v-if="form.errors.is_approved" class="mt-1.5 text-xs text-red-400">{{ form.errors.is_approved }}</p>
              </div>

            </div>
          </div>

          <!-- Footer actions -->
          <div class="px-8 py-4 bg-[#131109] border-t border-[#2a2520] flex items-center justify-end gap-3">
            <Link
              href="/admin/listings"
              class="text-sm font-semibold text-[#8a7a66] hover:text-[#c9b99a] transition-colors duration-150 px-4 py-2"
            >
              Cancel
            </Link>
            <button
              type="submit"
              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
              </svg>
              Update Listing
            </button>
          </div>
        </form>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Layout/AdminLayout.vue'
import { useForm, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  listing: Object
})

const isDragging = ref(false)
const logoPreview = ref(null)
const logoInput = ref(null)

const form = useForm({
  title: props.listing?.title || '',
  company: props.listing?.company || '',
  location: props.listing?.location || '',
  email: props.listing?.email || '',
  website: props.listing?.website || '',
  tags: props.listing?.tags || '',
  description: props.listing?.description || '',
  logo: null,
  is_approved: props.listing?.is_approved || false,
})

const handleImageError = (event) => {
  event.target.style.display = 'none'
}

const handleFileSelect = (event) => {
  const file = event.target.files[0]
  if (file) processFile(file)
}

const handleDrop = (event) => {
  isDragging.value = false
  const files = event.dataTransfer.files
  if (files.length > 0) processFile(files[0])
}

const processFile = (file) => {
  if (!file.type.startsWith('image/')) {
    alert('Please select an image file')
    return
  }
  if (file.size > 2 * 1024 * 1024) {
    alert('File size must be less than 2MB')
    return
  }
  form.logo = file
  const reader = new FileReader()
  reader.onload = (e) => { logoPreview.value = e.target.result }
  reader.readAsDataURL(file)
}

const removeLogo = () => {
  form.logo = null
  logoPreview.value = null
  if (logoInput.value) logoInput.value.value = ''
}

const updateListing = () => {
  const formData = new FormData()
  formData.append('_method', 'PUT')
  formData.append('title', form.title)
  formData.append('company', form.company)
  formData.append('location', form.location)
  formData.append('email', form.email)
  formData.append('website', form.website || '')
  formData.append('tags', form.tags)
  formData.append('description', form.description)
  formData.append('is_approved', form.is_approved ? '1' : '0')
  if (form.logo && form.logo instanceof File) {
    formData.append('logo', form.logo)
  }
  router.post(`/admin/listings/${props.listing.id}`, formData, {
    onSuccess: () => {},
    onError: (errors) => { console.log('Validation errors:', errors) },
    forceFormData: true
  })
}
</script>