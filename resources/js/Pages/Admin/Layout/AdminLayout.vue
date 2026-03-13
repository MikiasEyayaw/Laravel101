<template>
  <div class="min-h-screen flex bg-[#0f0e0c]" style="font-family: 'DM Sans', sans-serif;">

    <!-- ===== SIDEBAR ===== -->
    <aside class="w-64 fixed top-0 left-0 h-screen flex flex-col bg-[#0c0b09] border-r border-[#2a2520]">

      <!-- Logo -->
      <div class="px-6 py-5 border-b border-[#2a2520]">
        <Link href="/admin/dashboard" class="flex items-center gap-2 group">
          <span class="text-lg font-black tracking-tight text-[#f0a047]"
            style="font-family: 'Playfair Display', serif;">
            LaraGigs
          </span>
          <span
            class="text-[10px] font-bold tracking-[0.18em] uppercase text-[#8a7a66] bg-[#1a1815] border border-[#2a2520] px-1.5 py-0.5 rounded">
            Admin
          </span>
        </Link>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto">

        <!-- Dashboard -->
        <Link href="/admin/dashboard" :class="[
          'flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-150',
          $page.url === '/admin/dashboard'
            ? 'bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20'
            : 'text-[#c9b99a] hover:text-white hover:bg-[#1a1815]'
        ]">
          <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Dashboard
        </Link>

        <!-- Users Section -->
        <div class="pt-4 pb-1">
          <div class="px-3 text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.18em] mb-1.5">
            Users
          </div>
          <div class="space-y-0.5">
            <Link href="/admin/users" :class="[
              'flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-150',
              $page.url.startsWith('/admin/users') && !$page.url.includes('/pending')
                ? 'bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20'
                : 'text-[#c9b99a] hover:text-white hover:bg-[#1a1815]'
            ]">
              <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              All Users
            </Link>
            <Link href="/admin/users/pending" :class="[
              'flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-150',
              $page.url.includes('/admin/users/pending')
                ? 'bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20'
                : 'text-[#c9b99a] hover:text-white hover:bg-[#1a1815]'
            ]">
              <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Pending Users
            </Link>
          </div>
        </div>

        <!-- Listings Section -->
        <div class="pt-4 pb-1">
          <div class="px-3 text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.18em] mb-1.5">
            Listings
          </div>
          <div class="space-y-0.5">
            <Link href="/admin/listings" :class="[
              'flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-150',
              $page.url.startsWith('/admin/listings') && !$page.url.includes('/pending')
                ? 'bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20'
                : 'text-[#c9b99a] hover:text-white hover:bg-[#1a1815]'
            ]">
              <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              All Listings
            </Link>
            <Link href="/admin/listings/pending" :class="[
              'flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-150',
              $page.url.includes('/admin/listings/pending')
                ? 'bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20'
                : 'text-[#c9b99a] hover:text-white hover:bg-[#1a1815]'
            ]">
              <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Pending Listings
            </Link>
          </div>
        </div>
        <!-- Settings -->
        <div class="pt-4 pb-1">
          <div class="px-3 text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.18em] mb-1.5">
            Settings
          </div>
          <div class="space-y-0.5">
            <Link href="/admin/settings" :class="[
              'flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-150 mt-4',
              $page.url === '/admin/settings'
                ? 'bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20'
                : 'text-[#c9b99a] hover:text-white hover:bg-[#1a1815]'
            ]">
              <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Settings
            </Link>
          </div>
        </div>

      </nav>

      <!-- User Menu at Bottom -->
      <div class="border-t border-[#2a2520] p-3">
        <div class="relative">
          <button @click="showUserMenu = !showUserMenu"
            class="flex items-center w-full text-sm rounded-xl p-2.5 hover:bg-[#1a1815] transition-colors duration-150 group">
            <!-- Avatar -->
            <div
              class="h-8 w-8 rounded-xl bg-[#f0a047]/15 border border-[#f0a047]/30 flex items-center justify-center flex-shrink-0">
              <span class="text-xs font-bold text-[#f0a047]">A</span>
            </div>
            <span
              class="ml-3 text-sm font-medium text-[#d4c4a8] group-hover:text-white transition-colors duration-150">Admin</span>
            <svg class="ml-auto h-4 w-4 text-[#8a7a66] transition-transform duration-200"
              :class="showUserMenu ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <Transition enter-active-class="transition-all duration-150 ease-out"
            enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-100 ease-in" leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-1">
            <div v-show="showUserMenu"
              class="absolute left-0 bottom-full mb-2 w-48 rounded-xl overflow-hidden bg-[#16140f] border border-[#2a2520] shadow-2xl shadow-black/50 z-50"
              role="menu">
              <div class="py-1">
                <Link href="/admin/dashboard"
                  class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-[#c9b99a] hover:text-white hover:bg-[#1a1815] transition-colors duration-150"
                  role="menuitem">
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                  Dashboard
                </Link>
                <div class="h-px bg-[#2a2520] mx-3"></div>
                <button @click="logout"
                  class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-950/30 transition-colors duration-150"
                  role="menuitem">
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  Sign out
                </button>
              </div>
            </div>
          </Transition>
        </div>
      </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 flex flex-col min-w-0 pl-64">

      <!-- Top Bar -->
      <header class="bg-[#0c0b09] border-b border-[#2a2520] sticky top-0 z-40">
        <div class="px-8 py-4 flex items-center justify-between">
          <h1 class="text-xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            {{ getPageTitle() }}
          </h1>
          <!-- Breadcrumb accent -->
          <div class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#f0a047] animate-pulse"></span>
            <span class="text-xs font-semibold tracking-[0.15em] uppercase text-[#8a7a66]">Admin Panel</span>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <div class="flex-1 p-8 bg-[#0f0e0c]">
        <slot />
      </div>

    </main>

    <!-- ===== FLASH MESSAGES ===== -->
    <Transition enter-active-class="transition-all duration-300 ease-out" enter-from-class="opacity-0 translate-y-2"
      enter-to-class="opacity-100 translate-y-0" leave-active-class="transition-all duration-200 ease-in"
      leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-2">
      <div v-if="$page.props.flash.success"
        class="fixed bottom-5 right-5 flex items-center gap-3 bg-[#1c180f] border border-[#f0a047]/40 text-[#f0a047] px-5 py-3.5 rounded-xl shadow-2xl shadow-black/50 z-50 text-sm font-medium max-w-sm">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        {{ $page.props.flash.success }}
      </div>
    </Transition>

    <Transition enter-active-class="transition-all duration-300 ease-out" enter-from-class="opacity-0 translate-y-2"
      enter-to-class="opacity-100 translate-y-0" leave-active-class="transition-all duration-200 ease-in"
      leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-2">
      <div v-if="$page.props.flash.error"
        class="fixed bottom-5 right-5 flex items-center gap-3 bg-[#1a0f0f] border border-red-500/40 text-red-400 px-5 py-3.5 rounded-xl shadow-2xl shadow-black/50 z-50 text-sm font-medium max-w-sm">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
        </svg>
        {{ $page.props.flash.error }}
      </div>
    </Transition>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'

const page = usePage()
const showUserMenu = ref(false)

const getPageTitle = () => {
  const url = page.url

  if (url === '/admin/dashboard') return 'Dashboard'
  if (url === '/admin/users') return 'All Users'
  if (url === '/admin/users/pending') return 'Pending Users'
  if (url.startsWith('/admin/users/') && url.includes('/activity')) return 'User Activity'
  if (url.startsWith('/admin/users/') && url.includes('/edit')) return 'Edit User'
  if (url === '/admin/listings') return 'All Listings'
  if (url === '/admin/listings/pending') return 'Pending Listings'
  if (url.startsWith('/admin/listings/') && url.includes('/edit')) return 'Edit Listing'
  if (url.startsWith('/admin/listings/') && !url.includes('/edit')) return 'View Listing'
  if (url === '/admin/settings') return 'Settings'

  return 'Admin Panel'
}

const logout = () => {
  router.post('/admin/logout')
}
</script>