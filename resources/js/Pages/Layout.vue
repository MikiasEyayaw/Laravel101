<template>
  <div class="min-h-screen flex flex-col bg-[#0f0e0c] text-[#e8e0d0]" style="font-family: 'DM Sans', sans-serif;">

    <!-- Flash Message -->
    <FlashMessage
      v-if="page.props.flash?.success"
      :message="page.props.flash.success"
      type="success"
    />
    <FlashMessage
      v-if="page.props.flash?.error"
      :message="page.props.flash.error"
      type="error"
    />
    <FlashMessage
      v-if="page.props.flash?.message"
      :message="page.props.flash.message"
      type="success"
    />

    <!-- ===== NAVIGATION ===== -->
    <header class="sticky top-0 z-50 border-b border-[#2a2520]" style="background: rgba(15,14,12,0.92); backdrop-filter: blur(12px);">
      <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        <!-- Logo -->
        <RouterLink to="/" class="flex items-center gap-2 group">
          <span class="text-xl font-black tracking-tight" style="font-family: 'Playfair Display', serif; color: #f0a047;">
            LaraGigs
          </span>
          <span class="hidden sm:block text-[10px] font-semibold tracking-[0.2em] uppercase text-[#6b5f4e] mt-0.5">
            Laravel Jobs
          </span>
        </RouterLink>

        <!-- Nav Actions -->
        <div class="flex items-center gap-1">

          <!-- GUEST (same as @else) -->
          <template v-if="!user">
            <Link
              href="/register"
              class="px-4 py-2 text-sm font-medium text-[#9a8a76] hover:text-[#e8e0d0] transition-colors duration-200 rounded-lg hover:bg-white/5"
            >
              Register
            </Link>

            <Link
              href="/login"
              class="px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-200"
              style="background: #f0a047; color: #0f0e0c;"
              @mouseover="e => e.currentTarget.style.background='#f5b46a'"
              @mouseleave="e => e.currentTarget.style.background='#f0a047'"
            >
              Login
            </Link>
          </template>

          <!-- AUTHENTICATED (same as @auth) -->
          <template v-else>
            <span class="hidden sm:flex items-center gap-1.5 text-sm text-[#6b5f4e] mr-2">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>

              <span style="color: #c9a97a;">
                Welcome {{ user.name }}
              </span>
            </span>

            <Link
              href="/listings/manage"
              class="px-4 py-2 text-sm font-medium text-[#9a8a76] hover:text-[#e8e0d0] transition-colors duration-200 rounded-lg hover:bg-white/5"
            >
              Manage Listings
            </Link>

            <button
              @click="logout"
              class="px-4 py-2 text-sm font-semibold text-[#e07070] hover:text-white hover:bg-red-900/30 rounded-lg transition-all duration-200"
            >
              Logout
            </button>
          </template>

        </div>
      </nav>
    </header>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1">
      <slot />
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="border-t border-[#2a2520] bg-[#0c0b09] mt-auto">
      <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col sm:flex-row items-center justify-between gap-5">
        <div>
          <span class="text-lg font-black" style="font-family: 'Playfair Display', serif; color: #f0a047;">LaraGigs</span>
          <p class="text-xs text-white mt-0.5">&copy; {{ currentYear }} All rights reserved.</p>
        </div>

        <Link
          href="/listings/create"
          class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold rounded-xl transition-all duration-200 shadow-lg group"
          style="background: #f0a047; color: #0f0e0c;"
          @mouseover="e => e.currentTarget.style.background='#f5b46a'"
          @mouseleave="e => e.currentTarget.style.background='#f0a047'"
        >
          <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
          </svg>
          Post a Job
        </Link>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import FlashMessage from '@/Pages/Components/FlashMessage.vue'

const page = usePage()

const user = computed(() => page.props.auth?.user)

const currentYear = computed(() => new Date().getFullYear())

function logout() {
  router.post('/logout')
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap');
</style>