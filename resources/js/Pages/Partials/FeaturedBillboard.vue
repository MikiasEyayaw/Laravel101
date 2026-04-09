<template>
  <section v-if="featuredListing" class="max-w-6xl mx-auto px-6 pb-4">

    <!-- Billboard wrapper — matches ListingCard's palette but hero-scale -->
    <div
      class="relative overflow-hidden rounded-2xl cursor-pointer transition-all duration-300 group"
      style="background: #16140f; border: 1px solid #2a2520;"
      @click="goToListing"
      @mouseover="e => { e.currentTarget.style.borderColor='rgba(240,160,71,0.35)'; e.currentTarget.style.transform='translateY(-2px)'; e.currentTarget.style.boxShadow='0 16px 48px rgba(0,0,0,0.5)'; }"
      @mouseleave="e => { e.currentTarget.style.borderColor='#2a2520'; e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='none'; }"
    >

      <!-- Top amber accent line (same as ListingCard hover line but always-on) -->
      <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(to right, transparent, rgba(240,160,71,0.45), transparent);"></div>

      <!-- Subtle ambient glow — very restrained -->
      <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(240,160,71,0.05) 0%, transparent 70%);"></div>

      <!-- HEADER BAR — same rhythm as ListingCard header -->
      <div class="flex items-center justify-between px-6 py-3 border-b" style="border-color: #2a2520; background: #131109;">
        <div class="flex items-center gap-2">
          <!-- Star icon matching the purple featured theme but amber-tinted for cohesion -->
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color: #f0a047;">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
          <span class="text-xs font-bold tracking-[0.15em] uppercase" style="color: #f0a047;">Featured Jobs</span>
        </div>
        <span class="text-xs font-medium" style="color: #4a3f32;">Sponsored</span>
      </div>

      <!-- MAIN BODY -->
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-0">

        <!-- Left: company info -->
        <div class="p-6 sm:p-8">
          <div class="flex items-start gap-5">

            <!-- Logo — same style as ListingCard but larger -->
            <div
              class="flex-shrink-0 w-14 h-14 rounded-xl overflow-hidden flex items-center justify-center"
              style="background: #1f1c15; border: 1px solid #2a2520;"
            >
              <img
                v-if="featuredListing.logo"
                :src="`/storage/${featuredListing.logo}`"
                :alt="featuredListing.company"
                class="w-full h-full object-contain p-2"
              />
              <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #4a3f32;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
              </svg>
            </div>

            <!-- Title + company + details -->
            <div class="flex-1 min-w-0">

              <!-- Title -->
              <h3
                class="text-lg font-black leading-snug mb-0.5 transition-colors duration-200 group-hover:text-[#f0a047]"
                style="color: #e8e0d0; font-family: 'Playfair Display', serif;"
              >
                {{ featuredListing.title }}
              </h3>

              <!-- Company name -->
              <p class="text-sm font-semibold mb-4" style="color: #f0a047;">
                {{ featuredListing.company }}
              </p>

              <!-- Description -->
              <p class="text-sm leading-relaxed mb-5 line-clamp-2" style="color: #6b5f4e;">
                {{ featuredListing.description }}
              </p>

              <!-- Meta row: location + tags — same chips as ListingCard -->
              <div class="flex flex-wrap items-center gap-2">

                <span
                  v-if="featuredListing.location"
                  class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-md"
                  style="background: #1f1c15; border: 1px solid #2a2520; color: #6b5f4e;"
                >
                  <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: #4a3f32;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                  {{ featuredListing.location }}
                </span>

                <span
                  v-for="tag in getTagsArray(featuredListing.tags)"
                  :key="tag"
                  class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-md"
                  style="background: #1f1c15; border: 1px solid #2a2520; color: #c9a97a;"
                >
                  {{ tag }}
                </span>

              </div>
            </div>
          </div>
        </div>

        <!-- Right: CTA — sits flush in the card, same dark footer tone -->
        <div
          class="flex items-center justify-center px-8 py-6 border-t lg:border-t-0 lg:border-l"
          style="border-color: #2a2520; background: #131109; min-width: 200px;"
        >
          <div class="text-center">
            <div
              class="inline-flex items-center gap-2 font-bold rounded-xl py-3 px-6 text-sm transition-all duration-300 group-hover:gap-3"
              style="background: #f0a047; color: #0f0e0c;"
            >
              View Job
              <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
            <p class="text-xs mt-2.5" style="color: #4a3f32;">Limited availability</p>
          </div>
        </div>

      </div>

      <!-- Bottom accent line — same as ListingCard hover line -->
      <div class="absolute bottom-0 left-0 right-0 h-px opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(to right, transparent, #f0a047, transparent);"></div>

    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  featuredListing: {
    type: Object,
    default: null
  }
})

const goToListing = () => {
  if (props.featuredListing) {
    window.location.href = `/listings/${props.featuredListing.id}`
  }
}

const getTagsArray = (tags) => {
  if (!tags) return []
  return tags.split(',').map(tag => tag.trim()).filter(tag => tag)
}
</script>