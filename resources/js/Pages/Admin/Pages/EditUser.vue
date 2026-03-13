<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Users</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            Edit User
          </h1>
        </div>
        <Link
          href="/admin/users"
          class="inline-flex items-center gap-2 text-sm font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to Users
        </Link>
      </div>

      <!-- Form Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>

        <form @submit.prevent="updateUser">
          <div class="px-8 py-8">

            <!-- User meta info -->
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-[#2a2520]">
              <div class="w-12 h-12 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center flex-shrink-0">
                <span class="text-lg font-black text-[#f0a047]">{{ user.name.charAt(0).toUpperCase() }}</span>
              </div>
              <div>
                <p class="text-sm font-bold text-[#e8e0d0]">{{ user.name }}</p>
                <p class="text-xs text-[#8a7a66]">{{ user.email }}</p>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

              <!-- Name -->
              <div>
                <label for="name" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">
                  Name
                </label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  v-model="form.name"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.name ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.name" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  {{ form.errors.name }}
                </p>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">
                  Email
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  v-model="form.email"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="form.errors.email ? 'border-red-500/60' : ''"
                />
                <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  {{ form.errors.email }}
                </p>
              </div>

              <!-- Active toggle -->
              <div class="sm:col-span-2">
                <label class="flex items-center gap-3 cursor-pointer group w-fit">
                  <div class="relative">
                    <input
                      type="checkbox"
                      id="is_active"
                      name="is_active"
                      v-model="form.is_active"
                      class="sr-only peer"
                    />
                    <div class="w-10 h-6 bg-[#2a2520] peer-checked:bg-emerald-500 rounded-full transition-colors duration-200 border border-[#3a3025] peer-checked:border-emerald-500"></div>
                    <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-[#8a7a66] peer-checked:bg-white rounded-full transition-all duration-200 peer-checked:translate-x-4 peer-checked:bg-white shadow"></div>
                  </div>
                  <span class="text-sm font-semibold text-[#c9b99a] group-hover:text-[#e8e0d0] transition-colors duration-150">
                    Active User
                  </span>
                </label>
                <p v-if="form.errors.is_active" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  {{ form.errors.is_active }}
                </p>
              </div>

            </div>
          </div>

          <!-- Footer actions -->
          <div class="px-8 py-4 bg-[#131109] border-t border-[#2a2520] flex items-center justify-end gap-3">
            <Link
              href="/admin/users"
              class="text-sm font-semibold text-[#8a7a66] hover:text-[#c9b99a] transition-colors duration-150 px-4 py-2"
            >
              Cancel
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200"
            >
              <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
              </svg>
              {{ form.processing ? 'Saving...' : 'Update User' }}
            </button>
          </div>
        </form>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Layout/AdminLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
  user: Object
})

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  is_active: props.user.is_active,
})

const updateUser = () => {
  form.put(`/admin/users/${props.user.id}`, {
    onSuccess: () => {
      // Redirect will happen automatically
    }
  })
}
</script>