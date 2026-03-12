<template>
  <section class="bg-[#0f0e0c] border-b border-[#2a2520]">
    <div class="max-w-3xl mx-auto px-6 py-8">

      <!-- Section label -->
      <p class="text-xs font-semibold tracking-[0.2em] uppercase mb-3 text-white">Search Gigs</p>

      <form @submit.prevent="handleSearch">
        <div class="flex gap-3">

          <!-- Input wrapper -->
          <div class="relative flex-1">
            <!-- Search icon -->
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: #4a3f32;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
              </svg>
            </div>
            <input
              v-model="query"
              type="text"
              name="keywords"
              placeholder="Keywords, technologies, role title..."
              class="w-full pl-11 pr-4 py-3.5 text-sm rounded-xl outline-none transition-all duration-200"
              style="background: #1a1815; border: 1px solid #2a2520; color: #e8e0d0; font-family: 'DM Sans', sans-serif;"
              @focus="e => e.target.style.borderColor='rgba(240,160,71,0.5)'"
              @blur="e => e.target.style.borderColor='#2a2520'"
            />
          </div>

          <!-- Submit -->
          <button
            type="submit"
            class="inline-flex items-center gap-2 px-6 py-3.5 text-sm font-bold rounded-xl transition-all duration-200 flex-shrink-0"
            style="background: #f0a047; color: #0f0e0c;"
            @mouseover="e => e.currentTarget.style.background='#f5b46a'"
            @mouseleave="e => e.currentTarget.style.background='#f0a047'"
          >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <span class="hidden sm:inline">Search</span>
          </button>

        </div>

        <!-- Clear search -->
        <div v-if="query" class="mt-3 flex items-center gap-1.5">
          <button
            type="button"
            @click="clearSearch"
            class="text-xs font-medium transition-colors duration-150 flex items-center gap-1"
            style="color: #ffffff;"
            @mouseover="e => e.currentTarget.style.color='#f0a047'"
            @mouseleave="e => e.currentTarget.style.color='#4a3f32'"
          >
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Clear search
          </button>
        </div>

      </form>
    </div>
  </section>
</template>

<script setup>
import { ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const query = ref(page.props?.filters?.keywords ?? '')

let timeout = null

watch(query, (value) => {
  clearTimeout(timeout)

  timeout = setTimeout(() => {
    router.get(
      '/',
      value ? { keywords: value } : {},
      {
        preserveState: true,
        replace: true,
        preserveScroll: true
      }
    )
  }, 400) // debounce so it doesn't request on every keystroke
})

function clearSearch() {
  query.value = ''

  router.get('/listings', {}, {
    preserveState: true,
    replace: true,
    preserveScroll: true
  })
}
</script>