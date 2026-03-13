<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Management</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            Listings Management
          </h1>
        </div>
        <Link
          href="/admin/listings/pending"
          class="inline-flex items-center gap-2 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/25 text-yellow-400 hover:text-yellow-300 font-semibold text-sm px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          View Pending ({{ pendingCount }})
        </Link>
      </div>

      <!-- Filters -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-4">
        <div class="flex gap-3">
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
              </svg>
            </div>
            <input
              type="text"
              v-model="search"
              placeholder="Search listings..."
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
            />
          </div>
          <select
            v-model="statusFilter"
            class="bg-[#1a1815] border border-[#2a2520] text-[#c9b99a] rounded-xl px-4 py-2.5 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30 cursor-pointer"
          >
            <option value="">All Listings</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="featured">Featured</option>
          </select>
        </div>
      </div>

      <!-- Table Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="border-b border-[#2a2520]">
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Logo</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Title</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Company</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Location</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Posted by</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Status</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Created</th>
                <th class="px-5 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#2a2520]">
              <tr
                v-for="listing in listings.data"
                :key="listing.id"
                class="hover:bg-[#1a1815] transition-colors duration-150"
              >
                <!-- Logo -->
                <td class="px-5 py-4 whitespace-nowrap">
                  <div v-if="listing.logo" class="w-10 h-10 rounded-xl overflow-hidden border border-[#2a2520] bg-[#1a1815] flex-shrink-0">
                    <img
                      :src="listing.logo.startsWith('http') ? listing.logo : '/storage/' + listing.logo"
                      :alt="listing.company + ' logo'"
                      class="w-10 h-10 object-cover"
                      @error="handleImageError"
                    />
                  </div>
                  <div v-else class="w-10 h-10 rounded-xl bg-[#1a1815] border border-[#2a2520] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                  </div>
                </td>

                <!-- Title -->
                <td class="px-5 py-4 whitespace-nowrap">
                  <Link
                    :href="`/admin/listings/${listing.id}`"
                    class="text-sm font-semibold text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                  >
                    {{ listing.title }}
                  </Link>
                </td>

                <!-- Company -->
                <td class="px-5 py-4 whitespace-nowrap text-sm text-[#c9b99a]">
                  {{ listing.company }}
                </td>

                <!-- Location -->
                <td class="px-5 py-4 whitespace-nowrap text-sm text-[#c9b99a]">
                  {{ listing.location }}
                </td>

                <!-- Posted by -->
                <td class="px-5 py-4 whitespace-nowrap">
                  <Link
                    :href="`/admin/users/${listing.user.id}/activity`"
                    class="text-sm text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                  >
                    {{ listing.user.name }}
                  </Link>
                </td>

                <!-- Status -->
                <td class="px-5 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-1.5 flex-wrap">
                    <span v-if="listing.is_featured" class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg border bg-purple-500/10 text-purple-400 border-purple-500/20">
                      ★ Featured
                    </span>
                    <span :class="[
                      'inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg border',
                      listing.is_approved
                        ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                        : 'bg-red-500/10 text-red-400 border-red-500/20'
                    ]">
                      {{ listing.is_approved ? 'Approved' : 'Rejected' }}
                    </span>
                  </div>
                </td>

                <!-- Created -->
                <td class="px-5 py-4 whitespace-nowrap text-sm text-[#8a7a66]">
                  {{ new Date(listing.created_at).toLocaleDateString() }}
                </td>

                <!-- Actions -->
                <td class="px-5 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-1.5 flex-wrap">
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
                      v-if="!listing.is_approved"
                      @click="approveListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                      Approve
                    </button>
                    <button
                      v-if="listing.is_approved"
                      @click="rejectListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-yellow-400 hover:text-yellow-300 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                      Reject
                    </button>
                    <button
                      v-if="!listing.is_featured"
                      @click="featureListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-purple-400 hover:text-purple-300 bg-purple-500/10 hover:bg-purple-500/20 border border-purple-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                      Feature
                    </button>
                    <button
                      v-if="listing.is_featured"
                      @click="unfeatureListing(listing.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-orange-400 hover:text-orange-300 bg-orange-500/10 hover:bg-orange-500/20 border border-orange-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                      Unfeature
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
                <td colspan="8" class="px-6 py-16 text-center text-sm text-[#8a7a66]">No listings found</td>
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
import { ref } from 'vue'

const props = defineProps({
  listings: Object,
  pendingCount: Number
})

const search = ref('')
const statusFilter = ref('')

const handleImageError = (event) => {
  event.target.style.display = 'none'
}

const approveListing = (listingId) => {
  router.post(`/admin/listings/${listingId}/approve`)
}

const rejectListing = (listingId) => {
  const reason = prompt('Please provide rejection reason:')
  if (reason) {
    router.post(`/admin/listings/${listingId}/reject`, { rejection_reason: reason })
  }
}

const featureListing = (listingId) => {
  const days = prompt('How many days to feature this listing? (1-365):')
  if (days && days >= 1 && days <= 365) {
    router.post(`/admin/listings/${listingId}/feature`, { days: parseInt(days) })
  }
}

const unfeatureListing = (listingId) => {
  if (confirm('Are you sure you want to unfeature this listing?')) {
    router.post(`/admin/listings/${listingId}/unfeature`)
  }
}

const deleteListing = (listingId) => {
  if (confirm('Are you sure you want to delete this listing? This action cannot be undone.')) {
    router.delete(`/admin/listings/${listingId}`)
  }
}
</script>