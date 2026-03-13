<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">User Profile</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            User Activity
          </h1>
          <p class="text-sm text-[#8a7a66] mt-1">
            <span class="text-[#c9b99a] font-medium">{{ user.name }}</span>
            <span class="mx-1.5 text-[#4a3f32]">·</span>
            {{ user.email }}
          </p>
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

      <!-- User Stat Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <!-- Total Listings -->
        <div class="relative bg-[#16140f] border border-[#2a2520] hover:border-[#f0a047]/30 rounded-2xl p-6 transition-all duration-200">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-black text-[#e8e0d0]">{{ listings.total }}</p>
              <p class="text-sm text-[#8a7a66]">Total Listings</p>
            </div>
          </div>
        </div>

        <!-- Active Status -->
        <div class="relative bg-[#16140f] border border-[#2a2520] hover:border-emerald-500/30 rounded-2xl p-6 transition-all duration-200">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent"></div>
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-black text-[#e8e0d0]">{{ user.is_active ? 'Active' : 'Inactive' }}</p>
              <p class="text-sm text-[#8a7a66]">Active Status</p>
            </div>
          </div>
        </div>

        <!-- Approval Status -->
        <div class="relative bg-[#16140f] border border-[#2a2520] hover:border-[#f0a047]/30 rounded-2xl p-6 transition-all duration-200">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>
          <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-black text-[#e8e0d0]">{{ user.is_approved ? 'Approved' : 'Pending' }}</p>
              <p class="text-sm text-[#8a7a66]">Approval Status</p>
            </div>
          </div>
        </div>

      </div>

      <!-- Listings Table -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">

        <!-- Table header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-[#2a2520]">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
              <svg class="w-4 h-4 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <h3 class="text-sm font-bold text-[#e8e0d0]">Submitted Listings</h3>
          </div>
          <span class="text-xs text-[#8a7a66]">{{ listings.total }} total</span>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="border-b border-[#2a2520]">
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Title</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Company</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Applications</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Created</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#2a2520]">
              <tr
                v-for="listing in listings.data"
                :key="listing.id"
                class="hover:bg-[#1a1815] transition-colors duration-150"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <Link
                    :href="`/listings/${listing.id}`"
                    class="text-sm font-semibold text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                  >
                    {{ listing.title }}
                  </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#c9b99a]">
                  {{ listing.company }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="inline-flex items-center text-xs font-semibold text-[#f0a047] bg-[#f0a047]/10 border border-[#f0a047]/20 px-2.5 py-1 rounded-lg">
                    {{ listing.applications_count || 0 }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#8a7a66]">
                  {{ new Date(listing.created_at).toLocaleDateString() }}
                </td>
              </tr>

              <tr v-if="!listings.data?.length">
                <td colspan="4" class="px-6 py-16 text-center text-sm text-[#8a7a66]">
                  This user has not submitted any listings yet.
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-[#2a2520] flex items-center justify-between">
          <p class="text-xs text-[#8a7a66]">
            Page <span class="text-[#c9b99a] font-semibold">{{ listings.current_page }}</span>
            of <span class="text-[#c9b99a] font-semibold">{{ listings.last_page }}</span>
          </p>
          <div class="flex gap-2">
            <Link
              v-if="listings.prev_page_url"
              :href="listings.prev_page_url"
              class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150"
            >← Prev</Link>
            <Link
              v-if="listings.next_page_url"
              :href="listings.next_page_url"
              class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150"
            >Next →</Link>
          </div>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Layout/AdminLayout.vue'
import { Link } from '@inertiajs/vue3'
import AdminCard from '../Components/AdminCard.vue'

const props = defineProps({
  user: Object,
  listings: Object
})
</script>