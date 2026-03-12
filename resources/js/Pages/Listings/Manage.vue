<template>
  <div class="min-h-screen bg-[#0f0e0c] px-4 py-12" style="font-family: 'DM Sans', sans-serif;">
    <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-10 relative overflow-hidden">

      <!-- Top amber accent line -->
      <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>

      <!-- Header -->
      <header>
        <h1 class="text-3xl text-center font-black uppercase my-6 tracking-tight text-[#e8e0d0]"
          style="font-family: 'Playfair Display', serif;">
          Manage Gigs
        </h1>
      </header>

      <!-- Table -->
      <table class="w-full table-auto rounded-sm">
        <tbody>

          <!-- Has listings -->
          <template v-if="listings && listings.length > 0">
            <tr
              v-for="listing in listings"
              :key="listing.id"
              class="border-[#2a2520] group"
            >
              <!-- Title -->
              <td class="px-4 py-8 border-t border-b border-[#2a2520] text-lg">
                <Link
                  :href="`/listings/${listing.id}`"
                  class="text-[#e8e0d0] font-medium hover:text-[#f0a047] transition-colors duration-150"
                >
                  {{ listing.title }}
                </Link>
              </td>

              <!-- Edit -->
              <td class="px-4 py-8 border-t border-b border-[#2a2520] text-lg">
                <Link
                  :href="`/listings/${listing.id}/edit`"
                  class="inline-flex items-center gap-2 text-[#f0a047] hover:text-[#f5b46a] font-semibold px-4 py-1.5 rounded-xl border border-[#f0a047]/30 hover:border-[#f0a047]/60 bg-[#f0a047]/5 hover:bg-[#f0a047]/10 transition-all duration-150 text-sm"
                >
                  <!-- Pencil icon -->
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                  </svg>
                  Edit
                </Link>
              </td>

              <!-- Delete -->
              <td class="px-4 py-8 border-t border-b border-[#2a2520] text-lg">
                <button
                  @click="handleDelete(listing.id)"
                  class="inline-flex items-center gap-2 text-red-400 hover:text-red-300 font-semibold px-4 py-1.5 rounded-xl border border-red-500/20 hover:border-red-500/40 bg-red-500/5 hover:bg-red-500/10 transition-all duration-150 text-sm"
                >
                  <!-- Trash icon -->
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                  </svg>
                  Delete
                </button>
              </td>
            </tr>
          </template>

          <!-- Empty state -->
          <tr v-else class="border-[#2a2520]">
            <td class="px-4 py-12 border-t border-b border-[#2a2520] text-lg">
              <div class="flex flex-col items-center justify-center gap-3 text-center">
                <!-- Empty icon -->
                <div class="w-12 h-12 rounded-xl bg-[#1a1815] border border-[#2a2520] flex items-center justify-center">
                  <svg class="w-6 h-6 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                  </svg>
                </div>
                <p class="text-[#6b5f4e] text-base">No Listings Found</p>
                <Link
                  href="/listings/create"
                  class="text-sm font-semibold text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                >
                  Post your first gig →
                </Link>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

defineProps({
  listings: {
    type: Array,
    default: () => [],
  },
})

function handleDelete(id) {
  if (confirm('Are you sure you want to delete this listing?')) {
    router.delete(`/listings/${id}`)
  }
}
</script>