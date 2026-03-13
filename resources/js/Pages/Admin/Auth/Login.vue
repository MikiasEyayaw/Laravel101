<template>
  <div
    class="min-h-screen bg-[#0f0e0c] flex items-center justify-center px-4 py-16"
    style="font-family: 'DM Sans', sans-serif;"
  >
    <div class="w-full max-w-md">

      <!-- Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-10 relative overflow-hidden">

        <!-- Top amber accent line -->
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>

        <!-- Header -->
        <div class="text-center mb-8">
          <span
            class="text-3xl font-black tracking-tight text-[#f0a047]"
            style="font-family: 'Playfair Display', serif;"
          >
            LaraGigs
          </span>
          <h2
            class="mt-3 text-xl font-black text-[#e8e0d0] tracking-tight"
            style="font-family: 'Playfair Display', serif;"
          >
            Admin Login
          </h2>
          <p class="mt-1 text-sm text-[#8a7a66]">
            Sign in to admin panel
          </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="login" class="space-y-5" novalidate>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">
              Email address
            </label>
            <input
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              required
              placeholder="admin@example.com"
              v-model="form.email"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="form.errors.email ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">
              Password
            </label>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              placeholder="••••••••"
              v-model="form.password"
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
              :class="form.errors.email ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"
            />
          </div>

          <!-- Error message -->
          <div
            v-if="form.errors.email"
            class="flex items-center gap-2 text-sm text-red-400 bg-red-950/40 border border-red-500/20 rounded-xl px-4 py-3"
          >
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            {{ form.errors.email }}
          </div>

          <!-- Submit -->
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full flex items-center justify-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-3 px-6 text-sm transition-all duration-200 mt-2"
          >
            <svg
              v-if="form.processing"
              class="w-4 h-4 animate-spin"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
            </svg>
            {{ form.processing ? 'Signing in...' : 'Sign in' }}
          </button>

        </form>
      </div>

    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: ''
})

const login = () => {
  form.post('/admin/login', {
    onSuccess: (page) => {
      console.log('Login successful, redirecting to dashboard')
    },
    onError: (errors) => {
      console.log('Login errors:', errors)
    },
    onFinish: () => {
      console.log('Request finished')
    }
  })
}
</script>