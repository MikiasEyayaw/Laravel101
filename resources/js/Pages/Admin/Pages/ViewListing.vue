<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Listings</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            View Listing
          </h1>
        </div>
        <Link
          href="/admin/listings"
          class="inline-flex items-center gap-2 text-sm font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to Listings
        </Link>
      </div>

      <!-- Main Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>

        <div class="px-8 py-7">

          <!-- Title + Status badges -->
          <div class="flex items-start justify-between gap-4 mb-7 pb-6 border-b border-[#2a2520]">
            <div class="flex items-start gap-5">
              <!-- Logo -->
              <div v-if="listing.logo" class="w-16 h-16 rounded-xl overflow-hidden border border-[#2a2520] bg-[#1a1815] flex-shrink-0">
                <img
                  :src="listing.logo.startsWith('http') ? listing.logo : '/storage/' + listing.logo"
                  :alt="listing.company + ' logo'"
                  class="w-16 h-16 object-contain"
                  @error="handleImageError"
                />
              </div>
              <div v-else class="w-16 h-16 rounded-xl bg-[#1a1815] border border-[#2a2520] flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
              </div>
              <div>
                <h2 class="text-xl font-black text-[#e8e0d0]" style="font-family: 'Playfair Display', serif;">
                  {{ listing.title }}
                </h2>
                <p class="text-sm text-[#8a7a66] mt-1">{{ listing.company }}</p>
              </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
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
          </div>

          <!-- Detail grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Company</p>
              <p class="text-sm text-[#e8e0d0] font-medium">{{ listing.company }}</p>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Location</p>
              <p class="text-sm text-[#e8e0d0] font-medium">{{ listing.location }}</p>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Email</p>
              <p class="text-sm text-[#e8e0d0] font-medium">{{ listing.email }}</p>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Website</p>
              <a
                v-if="listing.website"
                :href="listing.website"
                target="_blank"
                class="text-sm text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150 font-medium"
              >
                {{ listing.website }}
              </a>
              <p v-else class="text-sm text-[#4a3f32] italic">Not provided</p>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-2">Tags</p>
              <div class="flex flex-wrap gap-1.5">
                <span
                  v-for="tag in listing.tags.split(',')"
                  :key="tag"
                  class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg bg-[#f0a047]/10 text-[#f0a047] border border-[#f0a047]/20"
                >
                  {{ tag.trim() }}
                </span>
              </div>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-2">Logo</p>
              <div v-if="listing.logo">
                <div class="inline-block rounded-xl overflow-hidden border border-[#2a2520] bg-[#1a1815] p-2">
                  <img
                    :src="listing.logo.startsWith('http') ? listing.logo : '/storage/' + listing.logo"
                    :alt="listing.company + ' logo'"
                    class="h-20 w-auto max-w-xs object-contain rounded-lg"
                    @error="handleImageError"
                  />
                </div>
                <p class="text-xs text-[#8a7a66] mt-2">
                  Source: <code class="bg-[#1a1815] text-[#c9b99a] px-1.5 py-0.5 rounded text-[10px] border border-[#2a2520]">{{ listing.logo.startsWith('http') ? 'External URL' : '/storage/' + listing.logo }}</code>
                </p>
              </div>
              <div v-else class="border-2 border-dashed border-[#2a2520] rounded-xl p-6 text-center">
                <svg class="mx-auto w-10 h-10 text-[#4a3f32] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
                <p class="text-xs text-[#8a7a66]">No logo provided</p>
              </div>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Posted by</p>
              <Link
                :href="`/admin/users/${listing.user.id}/activity`"
                class="text-sm text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150 font-medium"
              >
                {{ listing.user.name }}
              </Link>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Created</p>
              <p class="text-sm text-[#e8e0d0] font-medium">{{ new Date(listing.created_at).toLocaleDateString() }}</p>
            </div>

            <div>
              <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-1">Last Updated</p>
              <p class="text-sm text-[#e8e0d0] font-medium">{{ new Date(listing.updated_at).toLocaleDateString() }}</p>
            </div>

          </div>

          <!-- Description -->
          <div class="mt-7 pt-6 border-t border-[#2a2520]">
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-[#8a7a66] mb-3">Description</p>
            <div class="bg-[#1a1815] border border-[#2a2520] rounded-xl p-5">
              <p class="text-sm text-[#c9b99a] leading-relaxed whitespace-pre-wrap">{{ listing.description }}</p>
            </div>
          </div>

          <!-- Rejection reason -->
          <div v-if="listing.rejection_reason" class="mt-5 bg-red-500/5 border border-red-500/20 rounded-xl p-5">
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-red-400 mb-2">Rejection Reason</p>
            <p class="text-sm text-red-300">{{ listing.rejection_reason }}</p>
          </div>

          <!-- Approval date -->
          <div v-if="listing.approved_at" class="mt-5 bg-emerald-500/5 border border-emerald-500/20 rounded-xl p-5">
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-emerald-400 mb-2">Approval Date</p>
            <p class="text-sm text-emerald-300">{{ new Date(listing.approved_at).toLocaleDateString() }}</p>
          </div>

        </div>

        <!-- Footer actions -->
        <div class="px-8 py-4 bg-[#131109] border-t border-[#2a2520] flex items-center justify-end gap-3">
          <Link
            :href="`/admin/listings/${listing.id}/edit`"
            class="inline-flex items-center gap-2 text-sm font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-4 py-2 rounded-xl transition-all duration-150"
          >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
            Edit
          </Link>
          <button
            v-if="!listing.is_approved"
            @click="approveListing"
            class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-4 py-2 rounded-xl transition-all duration-150"
          >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Approve
          </button>
          <button
            v-if="listing.is_approved"
            @click="rejectListing"
            class="inline-flex items-center gap-2 text-sm font-semibold text-yellow-400 hover:text-yellow-300 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/20 px-4 py-2 rounded-xl transition-all duration-150"
          >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            Reject
          </button>
          <button
            @click="deleteListing"
            class="inline-flex items-center gap-2 text-sm font-semibold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-4 py-2 rounded-xl transition-all duration-150"
          >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
            Delete
          </button>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Layout/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  listing: Object
})

const handleImageError = (event) => {
  event.target.style.display = 'none'
}

const approveListing = () => {
  router.post(`/admin/listings/${props.listing.id}/approve`)
}

const rejectListing = () => {
  const reason = prompt('Please provide rejection reason:')
  if (reason) {
    router.post(`/admin/listings/${props.listing.id}/reject`, { rejection_reason: reason })
  }
}

const deleteListing = () => {
  if (confirm('Are you sure you want to delete this listing? This action cannot be undone.')) {
    router.delete(`/admin/listings/${props.listing.id}`)
  }
}
</script>