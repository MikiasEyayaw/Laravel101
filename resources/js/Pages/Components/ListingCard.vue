<template>
  <Link
    :href="`/listings/${listing.id}`"
    class="group block rounded-2xl overflow-hidden transition-all duration-300 relative"
    style="background: #16140f; border: 1px solid #2a2520;"
    @mouseover="e => { e.currentTarget.style.borderColor='rgba(240,160,71,0.35)'; e.currentTarget.style.transform='translateY(-2px)'; e.currentTarget.style.boxShadow='0 12px 40px rgba(0,0,0,0.5)'; }"
    @mouseleave="e => { e.currentTarget.style.borderColor='#2a2520'; e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='none'; }"
  >
    <!-- Top accent line on hover -->
    <div
      class="absolute top-0 left-0 right-0 h-px transition-all duration-300 opacity-0 group-hover:opacity-100"
      style="background: linear-gradient(to right, transparent, #f0a047, transparent);"
    ></div>

    <!-- Card Header -->
    <div class="flex items-start gap-4 p-5 border-b" style="border-color: #2a2520;">

      <!-- Company Logo -->
      <div
        class="flex-shrink-0 w-11 h-11 rounded-xl overflow-hidden flex items-center justify-center"
        style="background: #1f1c15; border: 1px solid #2a2520;"
      >
        <img
          v-if="listing.logo"
          :src="`/storage/${listing.logo}`"
          :alt="listing.company"
          class="w-full h-full object-contain p-1.5"
        />
        <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #4a3f32;">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
        </svg>
      </div>

      <div class="flex-1 min-w-0">
        <!-- Job Title -->
        <h3 class="text-sm font-bold truncate transition-colors duration-200" style="color: #e8e0d0; font-family: 'DM Sans', sans-serif;" :class="{'group-hover:text-[#f0a047]': true}">
          {{ listing.title }}
        </h3>
        <!-- Company -->
        <p class="text-xs mt-0.5 truncate" style="color: #ffffff;">{{ listing.company }}</p>
      </div>

      <!-- Location badge -->
      <span
        v-if="listing.location"
        class="flex-shrink-0 text-white text-xs font-medium px-2 py-1 rounded-md"
        style="background: #1f1c15;  border: 1px solid #2a2520;"
      >
        {{ listing.location }}
      </span>
    </div>

    <!-- Card Body -->
    <div class="p-5 flex-1">
      <!-- Description -->
      <p class="text-sm leading-relaxed mb-4 line-clamp-2 text-white">
        {{ listing.description }}
      </p>

      <!-- Tags -->
      <ListingTags :tags="listing.tags" />
    </div>

    <!-- Card Footer -->
    <div class="flex items-center justify-between px-5 py-3" style="background: #131109; border-top: 1px solid #2a2520;">
      <span class="text-xs font-semibold flex items-center gap-1 transition-all duration-200 group-hover:gap-2" style="color: #f0a047;">
        View Gig
        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </div>

  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingTags from '@/Pages/Components/ListingTags.vue'

defineProps({
  listing: {
    type: Object,
    required: true,
  },
})
</script>