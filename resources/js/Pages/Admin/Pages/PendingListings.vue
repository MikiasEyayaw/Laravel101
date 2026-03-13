<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Review Queue</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            Pending Listings
          </h1>
        </div>
        <Link
          href="/admin/listings"
          class="inline-flex items-center gap-2 text-sm font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to All Listings
        </Link>
      </div>

      <!-- Notice banner -->
      <div class="bg-yellow-500/5 border border-yellow-500/20 rounded-2xl px-5 py-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-yellow-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm text-yellow-400 font-medium">
          These listings are awaiting moderation. Review and approve or reject each one.
        </p>
      </div>

      <!-- Table Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="border-b border-[#2a2520]">
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Title</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Company</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Location</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Posted by</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Created</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Actions</th>
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
                    :href="`/admin/listings/${listing.id}`"
                    class="text-sm font-semibold text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                  >
                    {{ listing.title }}
                  </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#c9b99a]">{{ listing.company }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#c9b99a]">{{ listing.location }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <Link
                    :href="`/admin/users/${listing.user.id}/activity`"
                    class="text-sm text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                  >
                    {{ listing.user.name }}
                  </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#8a7a66]">
                  {{ new Date(listing.created_at).toLocaleDateString() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-1.5">
                    <Link
                      :href="`/admin/listings/${listing.id}`"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                      View
                    </Link>
                    <Link
                      :href="`/admin/listings/${listing.id}/edit`"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                      Edit
                    </Link>
                    <button
                      @click="approveListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                      Approve
                    </button>
                    <button
                      @click="rejectListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                      Reject
                    </button>
                    <button
                      @click="deleteListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                      Delete
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="!listings.data?.length">
                <td colspan="6" class="px-6 py-16 text-center">
                  <div class="flex flex-col items-center gap-2">
                    <svg class="w-8 h-8 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-[#8a7a66]">No pending listings — queue is clear!</p>
                  </div>
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
            <Link v-if="listings.prev_page_url" :href="listings.prev_page_url" class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150">← Prev</Link>
            <Link v-if="listings.next_page_url" :href="listings.next_page_url" class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150">Next →</Link>
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
  listings: Object
})

const approveListing = (listingId) => {
  router.post(`/admin/listings/${listingId}/approve`)
}

const rejectListing = (listingId) => {
  const reason = prompt('Please provide rejection reason:')
  if (reason) {
    router.post(`/admin/listings/${listingId}/reject`, { rejection_reason: reason })
  }
}

const deleteListing = (listingId) => {
  if (confirm('Are you sure you want to delete this listing? This action cannot be undone.')) {
    router.delete(`/admin/listings/${listingId}`)
  }
}
</script>