<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Review Queue</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            Pending Users
          </h1>
        </div>
        <Link
          href="/admin/users"
          class="inline-flex items-center gap-2 text-sm font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to All Users
        </Link>
      </div>

      <!-- Pending notice banner -->
      <div class="bg-yellow-500/5 border border-yellow-500/20 rounded-2xl px-5 py-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-yellow-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm text-yellow-400 font-medium">
          These users are awaiting approval. Review and approve or reject each one.
        </p>
      </div>

      <!-- Table Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="border-b border-[#2a2520]">
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Name</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Email</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Joined</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#2a2520]">
              <tr
                v-for="user in users.data"
                :key="user.id"
                class="hover:bg-[#1a1815] transition-colors duration-150"
              >
                <!-- Name -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center flex-shrink-0">
                      <span class="text-xs font-bold text-yellow-400">{{ user.name.charAt(0).toUpperCase() }}</span>
                    </div>
                    <Link
                      :href="`/admin/users/${user.id}/activity`"
                      class="text-sm font-semibold text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                    >
                      {{ user.name }}
                    </Link>
                  </div>
                </td>

                <!-- Email -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#c9b99a]">
                  {{ user.email }}
                </td>

                <!-- Joined -->
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#8a7a66]">
                  {{ new Date(user.created_at).toLocaleDateString() }}
                </td>

                <!-- Actions -->
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-2">
                    <button
                      @click="approveUser(user.id)"
                      class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-3 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                      </svg>
                      Approve
                    </button>
                    <button
                      @click="rejectUser(user.id)"
                      class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-3 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                      </svg>
                      Reject
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="!users.data?.length">
                <td colspan="4" class="px-6 py-16 text-center">
                  <div class="flex flex-col items-center gap-2">
                    <svg class="w-8 h-8 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-[#8a7a66]">No pending users — all caught up!</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-[#2a2520] flex items-center justify-between">
          <p class="text-xs text-[#8a7a66]">
            Page <span class="text-[#c9b99a] font-semibold">{{ users.current_page }}</span>
            of <span class="text-[#c9b99a] font-semibold">{{ users.last_page }}</span>
          </p>
          <div class="flex gap-2">
            <Link
              v-if="users.prev_page_url"
              :href="users.prev_page_url"
              class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150"
            >← Prev</Link>
            <Link
              v-if="users.next_page_url"
              :href="users.next_page_url"
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
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  users: Object
})

const approveUser = (userId) => {
  router.post(`/admin/users/${userId}/approve`)
}

const rejectUser = (userId) => {
  const reason = prompt('Please provide rejection reason:')
  if (reason) {
    router.post(`/admin/users/${userId}/reject`, { rejection_reason: reason })
  }
}
</script>