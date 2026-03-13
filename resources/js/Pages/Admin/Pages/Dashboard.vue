<template>
  <AdminLayout>
    <div class="space-y-8" style="font-family: 'DM Sans', sans-serif;">

      <!-- ===== WELCOME BANNER ===== -->
      <div class="relative rounded-2xl overflow-hidden border border-[#2a2520] bg-[#16140f]">
        <!-- Amber glow background -->
        <div class="absolute inset-0 pointer-events-none">
          <div class="absolute -top-16 -left-16 w-64 h-64 rounded-full bg-[#f0a047]/5 blur-3xl"></div>
          <div class="absolute -bottom-16 -right-16 w-64 h-64 rounded-full bg-[#f0a047]/5 blur-3xl"></div>
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>
          <!-- Grid texture -->
          <div class="absolute inset-0 opacity-[0.025]" style="background-image: repeating-linear-gradient(0deg, #f0a047 0, #f0a047 1px, transparent 1px, transparent 48px), repeating-linear-gradient(90deg, #f0a047 0, #f0a047 1px, transparent 1px, transparent 48px);"></div>
        </div>
        <div class="relative px-8 py-7 flex items-center justify-between">
          <div>
            <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Overview</p>
            <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
              Dashboard
            </h1>
          </div>
          <div class="flex items-center gap-2 bg-[#f0a047]/10 border border-[#f0a047]/20 rounded-xl px-4 py-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#f0a047] animate-pulse"></span>
            <span class="text-xs font-semibold text-[#f0a047] tracking-wide">Live Stats</span>
          </div>
        </div>
      </div>

      <!-- ===== PRIMARY STAT CARDS ===== -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Total Users -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-[#f0a047]/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
              <svg class="w-5 h-5 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
              </svg>
            </div>
            <span class="text-xs font-semibold text-[#8a7a66] bg-[#1a1815] border border-[#2a2520] px-2 py-1 rounded-lg">Users</span>
          </div>
          <p class="text-3xl font-black text-[#e8e0d0] mb-1">{{ totalUsers }}</p>
          <p class="text-sm text-[#8a7a66]">Total Users</p>
        </div>

        <!-- Total Listings -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-[#f0a047]/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
              <svg class="w-5 h-5 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
              </svg>
            </div>
            <span class="text-xs font-semibold text-[#8a7a66] bg-[#1a1815] border border-[#2a2520] px-2 py-1 rounded-lg">Gigs</span>
          </div>
          <p class="text-3xl font-black text-[#e8e0d0] mb-1">{{ totalListings }}</p>
          <p class="text-sm text-[#8a7a66]">Total Listings</p>
        </div>

        <!-- Pending Users -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-yellow-500/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/20 to-transparent"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
              <svg class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <span class="text-xs font-semibold text-yellow-500/70 bg-yellow-500/5 border border-yellow-500/15 px-2 py-1 rounded-lg">Review</span>
          </div>
          <p class="text-3xl font-black text-[#e8e0d0] mb-1">{{ pendingUsers }}</p>
          <p class="text-sm text-[#8a7a66]">Pending Users</p>
        </div>

        <!-- Pending Listings -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-yellow-500/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-500/20 to-transparent"></div>
          <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
              <svg class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <span class="text-xs font-semibold text-yellow-500/70 bg-yellow-500/5 border border-yellow-500/15 px-2 py-1 rounded-lg">Review</span>
          </div>
          <p class="text-3xl font-black text-[#e8e0d0] mb-1">{{ pendingListings }}</p>
          <p class="text-sm text-[#8a7a66]">Pending Listings</p>
        </div>

      </div>

      <!-- ===== SECONDARY STAT CARDS ===== -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        <!-- Approved Users -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-emerald-500/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent"></div>
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-black text-[#e8e0d0]">{{ approvedUsers }}</p>
              <p class="text-sm text-[#8a7a66]">Approved Users</p>
            </div>
          </div>
        </div>

        <!-- Featured Listings -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-[#f0a047]/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-black text-[#e8e0d0]">{{ featuredListings }}</p>
              <p class="text-sm text-[#8a7a66]">Featured Listings</p>
            </div>
          </div>
        </div>

        <!-- Approval Rate -->
        <div class="relative bg-[#16140f] border border-[#2a2520] rounded-2xl p-6 overflow-hidden group hover:border-[#f0a047]/30 transition-all duration-300">
          <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>
          <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
              </svg>
            </div>
            <div>
              <p class="text-2xl font-black text-[#e8e0d0]">
                {{ totalUsers > 0 ? Math.round((approvedUsers / totalUsers) * 100) + '%' : '0%' }}
              </p>
              <p class="text-sm text-[#8a7a66]">Approval Rate</p>
            </div>
          </div>
        </div>

      </div>

      <!-- ===== RECENT ACTIVITY ===== -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Recent Users -->
        <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">
          <!-- Card header -->
          <div class="flex items-center justify-between px-6 py-4 border-b border-[#2a2520]">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                </svg>
              </div>
              <h3 class="text-sm font-bold text-[#e8e0d0]">Recent Users</h3>
            </div>
            <span class="text-xs text-[#8a7a66]">{{ recentUsers?.length ?? 0 }} entries</span>
          </div>

          <!-- User rows -->
          <div class="divide-y divide-[#2a2520]">
            <div
              v-for="user in recentUsers"
              :key="user.id"
              class="flex items-center gap-4 px-6 py-4 hover:bg-[#1a1815] transition-colors duration-150"
            >
              <!-- Avatar -->
              <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
                <span class="text-sm font-bold text-[#f0a047]">
                  {{ user.name.charAt(0).toUpperCase() }}
                </span>
              </div>

              <!-- Info -->
              <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-[#e8e0d0] truncate">{{ user.name }}</p>
                <p class="text-xs text-[#8a7a66] truncate">{{ user.email }}</p>
              </div>

              <!-- Status badge -->
              <span
                :class="[
                  'flex-shrink-0 text-xs font-semibold px-2.5 py-1 rounded-lg border',
                  user.is_approved
                    ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                    : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20'
                ]"
              >
                {{ user.is_approved ? 'Approved' : 'Pending' }}
              </span>
            </div>

            <!-- Empty state -->
            <div v-if="!recentUsers?.length" class="px-6 py-10 text-center">
              <p class="text-sm text-[#8a7a66]">No recent users</p>
            </div>
          </div>
        </div>

        <!-- Recent Listings -->
        <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">
          <!-- Card header -->
          <div class="flex items-center justify-between px-6 py-4 border-b border-[#2a2520]">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
              </div>
              <h3 class="text-sm font-bold text-[#e8e0d0]">Recent Listings</h3>
            </div>
            <span class="text-xs text-[#8a7a66]">{{ recentListings?.length ?? 0 }} entries</span>
          </div>

          <!-- Listing rows -->
          <div class="divide-y divide-[#2a2520]">
            <div
              v-for="listing in recentListings"
              :key="listing.id"
              class="flex items-center gap-4 px-6 py-4 hover:bg-[#1a1815] transition-colors duration-150"
            >
              <!-- Icon -->
              <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-[#1a1815] border border-[#2a2520] flex items-center justify-center">
                <svg class="w-4 h-4 text-[#8a7a66]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
              </div>

              <!-- Info -->
              <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-[#e8e0d0] truncate">{{ listing.title }}</p>
                <p class="text-xs text-[#8a7a66] truncate">
                  {{ listing.company }}
                  <span v-if="listing.location"> · {{ listing.location }}</span>
                </p>
              </div>

              <!-- Posted by -->
              <div class="flex-shrink-0 text-right">
                <p class="text-xs text-[#c9b99a] font-medium">{{ listing.user?.name }}</p>
              </div>
            </div>

            <!-- Empty state -->
            <div v-if="!recentListings?.length" class="px-6 py-10 text-center">
              <p class="text-sm text-[#8a7a66]">No recent listings</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Layout/AdminLayout.vue'

const props = defineProps({
  totalUsers: Number,
  totalListings: Number,
  pendingUsers: Number,
  approvedUsers: Number,
  pendingListings: Number,
  featuredListings: Number,
  recentUsers: Array,
  recentListings: Array
})
</script>