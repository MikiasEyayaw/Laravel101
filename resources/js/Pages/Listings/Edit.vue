<template>
  <div class="min-h-screen bg-[#0f0e0c] flex items-start justify-center pt-24 px-4 pb-16"
    style="font-family: 'DM Sans', sans-serif;">
    <div class="w-full max-w-lg">

      <!-- Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-10 relative overflow-hidden">

        <!-- Top amber accent line -->
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>

        <!-- Header -->
        <header class="text-center mb-8">
          <h2 class="text-2xl font-black uppercase mb-1 tracking-tight text-[#e8e0d0]"
            style="font-family: 'Playfair Display', serif;">
            Edit Gig
          </h2>
          <p class="text-[#6b5f4e] text-sm">
            Edit: <span class="text-[#c9a97a] font-medium">{{ listing.title }}</span>
          </p>
        </header>

        <!-- Form -->
        <form @submit.prevent="handleSubmit" enctype="multipart/form-data" novalidate>

          <!-- Company Name -->
          <div class="mb-6">
            <label for="company" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Company Name
            </label>
            <input
              id="company"
              v-model="form.company"
              type="text"
              name="company"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.company ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.company" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.company }}
            </p>
          </div>

          <!-- Job Title -->
          <div class="mb-6">
            <label for="title" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Job Title
            </label>
            <input
              id="title"
              v-model="form.title"
              type="text"
              name="title"
              placeholder="Example: Senior Laravel Developer"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.title ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.title" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.title }}
            </p>
          </div>

          <!-- Job Location -->
          <div class="mb-6">
            <label for="location" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Job Location
            </label>
            <input
              id="location"
              v-model="form.location"
              type="text"
              name="location"
              placeholder="Example: Remote, Boston MA, etc"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.location ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.location" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.location }}
            </p>
          </div>

          <!-- Contact Email -->
          <div class="mb-6">
            <label for="email" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Contact Email
            </label>
            <input
              id="email"
              v-model="form.email"
              type="text"
              name="email"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.email ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.email" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.email }}
            </p>
          </div>

          <!-- Website / Application URL -->
          <div class="mb-6">
            <label for="website" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Website / Application URL
            </label>
            <input
              id="website"
              v-model="form.website"
              type="text"
              name="website"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.website ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.website" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.website }}
            </p>
          </div>

          <!-- Tags -->
          <div class="mb-6">
            <label for="tags" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Tags <span class="font-normal text-[#4a3f32]">(Comma Separated)</span>
            </label>
            <input
              id="tags"
              v-model="form.tags"
              type="text"
              name="tags"
              placeholder="Example: Laravel, Backend, Postgres, etc"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.tags ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.tags" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.tags }}
            </p>
          </div>

          <!-- Company Logo -->
          <div class="mb-6">
            <label for="logo" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Company Logo
            </label>

            <!-- File input -->
            <input
              id="logo"
              type="file"
              name="logo"
              accept="image/*"
              @change="handleLogoChange"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#6b5f4e] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50
                file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold
                file:bg-[#f0a047]/10 file:text-[#f0a047] hover:file:bg-[#f0a047]/20 file:cursor-pointer file:transition-all"
              :class="errors.logo ? 'border-red-500/60' : ''"
            />

            <!-- Logo preview -->
            <div class="mt-4">
              <img
                :src="logoPreview || (listing.logo ? `/storage/${listing.logo}` : '/images/no-image.png')"
                alt="Company logo preview"
                class="w-48 mr-6 mb-2 rounded-xl object-contain border border-[#2a2520] bg-[#1a1815] p-2"
              />
            </div>

            <p v-if="errors.logo" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.logo }}
            </p>
          </div>

          <!-- Job Description -->
          <div class="mb-6">
            <label for="description" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Job Description
            </label>
            <textarea
              id="description"
              v-model="form.description"
              name="description"
              rows="10"
              placeholder="Include tasks, requirements, salary, etc"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30 resize-none"
              :class="errors.description ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            ></textarea>
            <p v-if="errors.description" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.description }}
            </p>
          </div>

          <!-- Actions -->
          <div class="mb-6 flex items-center gap-4">
            <button
              type="submit"
              :disabled="submitting"
              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200"
            >
              <svg
                v-if="submitting"
                class="w-4 h-4 animate-spin"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
              </svg>
              {{ submitting ? 'Updating...' : 'Update Gig' }}
            </button>

            <Link
              href="/"
              class="inline-flex items-center gap-1.5 text-sm font-medium text-[#9a8a76] hover:text-[#f0a047] transition-colors duration-150"
            >
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
              </svg>
              Back
            </Link>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  listing: {
    type: Object,
    required: true,
  },
  errors: {
    type: Object,
    default: () => ({}),
  },
})

const submitting = ref(false)
const logoPreview = ref(null)
const logoFile = ref(null)

const form = reactive({
  company: props.listing.company ?? '',
  title: props.listing.title ?? '',
  location: props.listing.location ?? '',
  email: props.listing.email ?? '',
  website: props.listing.website ?? '',
  tags: props.listing.tags ?? '',
  description: props.listing.description ?? '',
})

function handleLogoChange(e) {
  const file = e.target.files[0]
  if (!file) return
  logoFile.value = file
  logoPreview.value = URL.createObjectURL(file)
}

function handleSubmit() {
  submitting.value = true

  const data = new FormData()

  data.append('company', form.company)
  data.append('title', form.title)
  data.append('location', form.location)
  data.append('email', form.email)
  data.append('website', form.website)
  data.append('tags', form.tags)
  data.append('description', form.description)

  // Important for PUT requests
  data.append('_method', 'put')

  if (logoFile.value) {
    data.append('logo', logoFile.value)
  }

  router.post(`/listings/${props.listing.id}`, data, {
    onFinish: () => {
      submitting.value = false
    },
  })
}
</script>