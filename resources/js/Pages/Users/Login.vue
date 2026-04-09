<template>
  <div class="min-h-screen bg-[#0f0e0c] flex items-start justify-center pt-24 px-4 pb-16" style="font-family: 'DM Sans', sans-serif;">
    <div class="w-full max-w-lg">

      <!-- Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-10 relative overflow-hidden">

        <!-- Top amber glow line -->
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>

        <!-- Header -->
        <header class="text-center mb-8">
          <h2 class="text-2xl font-black uppercase mb-1 tracking-tight text-[#e8e0d0]" style="font-family: 'Playfair Display', serif;">
            Login
          </h2>
          <p class="text-[#a49988] text-sm">Login into your account to post jobs</p>
        </header>

        <!-- Form -->
        <form @submit.prevent="handleSubmit" novalidate>

          <!-- Email -->
          <div class="mb-6">
            <label for="email" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Email
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              name="email"
              autocomplete="email"
              placeholder="you@example.com"
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

          <!-- Password -->
          <div class="mb-6">
            <label for="password" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">
              Password
            </label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              name="password"
              autocomplete="current-password"
              placeholder="••••••••"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="errors.password ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
            <p v-if="errors.password" class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
              <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ errors.password }}
            </p>
          </div>

          <!-- Submit -->
          <div class="mb-6">
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
              </svg>
              {{ submitting ? 'Signing in...' : 'Sign In' }}
            </button>
          </div>

          <!-- Register link -->
          <div class="mt-8 border-t border-[#2a2520] pt-6">
            <p class="text-sm text-[#6b5f4e]">
              Don't have an account?
              <Link
                href="/register"
                class="text-[#f0a047] font-semibold hover:text-[#f5b46a] hover:underline transition-colors duration-150 ml-1"
              >
                Register
              </Link>
            </p>
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
  errors: {
    type: Object,
    default: () => ({}),
  },
  oldInput: {
    type: Object,
    default: () => ({}),
  },
})

const submitting = ref(false)

const form = reactive({
  email: props.oldInput?.email ?? '',
  password: '',
})

function handleSubmit() {
  submitting.value = true

  router.post('/users/authenticate', form, {
    onFinish: () => {
      submitting.value = false
    }
  })
}
</script>