<template>
  <Layout>

    <!-- Hero Section -->
    <Hero />

    <!-- Search Section -->
    <Search />

    <!-- ===== LISTINGS GRID ===== -->
    <section class="max-w-6xl mx-auto px-6 py-12">

      <!-- Results bar -->
      <div class="flex items-center justify-between mb-7">
        <div class="flex items-baseline gap-3">
          <h2 class="text-base font-bold" style="color: #e8e0d0; font-family: 'DM Sans', sans-serif;">
            Available Gigs
          </h2>
          <span class="text-sm" style="color: #4a3f32;">
            {{ listings.length }} listing{{ listings.length !== 1 ? 's' : '' }}
            <template v-if="searchKeywords"> for "<em class="not-italic" style="color: #c9a97a;">{{ searchKeywords }}</em>"</template>
            <template v-else-if="tagFilter"> tagged "<em class="not-italic" style="color: #c9a97a;">{{ tagFilter }}</em>"</template>
          </span>
        </div>

        <Link
          v-if="searchKeywords || tagFilter"
          :href="'/'"
          preserve-scroll
          class="inline-flex items-center gap-1.5 text-xs font-medium transition-colors duration-150"
          style="color: #4a3f32;"
          @mouseover="e => e.currentTarget.style.color='#f0a047'"
          @mouseleave="e => e.currentTarget.style.color='#4a3f32'"
        >
          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
          Clear filter
        </Link>
      </div>

      <!-- Empty State -->
      <div v-if="listings.length === 0" class="flex flex-col items-center justify-center py-28 text-center">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5" style="background: #1a1815; border: 1px solid #2a2520;">
          <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #4a3f32;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
          </svg>
        </div>
        <h3 class="text-base font-bold mb-1" style="color: #e8e0d0;">No listings found</h3>
        <p class="text-sm mb-6" style="color: #4a3f32;">
          Try different keywords or
          <RouterLink to="/listings/create" class="transition-colors" style="color: #f0a047;" @mouseover="e => e.currentTarget.style.textDecoration='underline'" @mouseleave="e => e.currentTarget.style.textDecoration='none'">post a new gig</RouterLink>.
        </p>
      </div>

      <!-- Grid -->
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <ListingCard
          v-for="listing in listings"
          :key="listing.id"
          :listing="listing"
        />
      </div>

      <!-- ===== PAGINATION ===== -->
      <div
        v-if="pagination && pagination.last_page > 1"
        class="flex items-center justify-center gap-2 mt-12"
      >
        <!-- Previous -->
        <button
          :disabled="pagination.current_page === 1"
          @click="changePage(pagination.current_page - 1)"
          class="flex items-center justify-center w-9 h-9 rounded-lg text-sm transition-all duration-150 disabled:opacity-30 disabled:cursor-not-allowed"
          style="background: #1a1815; border: 1px solid #2a2520; color: #6b5f4e;"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
        </button>

        <!-- Page numbers -->
        <button
          v-for="page in pagination.last_page"
          :key="page"
          @click="changePage(page)"
          class="w-9 h-9 rounded-lg text-sm font-semibold transition-all duration-150"
          :style="page === pagination.current_page
            ? 'background: #f0a047; color: #0f0e0c; border: 1px solid #f0a047;'
            : 'background: #1a1815; border: 1px solid #2a2520; color: #6b5f4e;'"
        >
          {{ page }}
        </button>

        <!-- Next -->
        <button
          :disabled="pagination.current_page === pagination.last_page"
          @click="changePage(pagination.current_page + 1)"
          class="flex items-center justify-center w-9 h-9 rounded-lg text-sm transition-all duration-150 disabled:opacity-30 disabled:cursor-not-allowed"
          style="background: #1a1815; border: 1px solid #2a2520; color: #6b5f4e;"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </button>
      </div>

    </section>

  </Layout>
</template>

<script setup>
import { computed } from 'vue'
import { router, usePage, Link } from '@inertiajs/vue3'
import Layout from '@/Pages/Layout.vue'
import Hero from '@/Pages/Partials/_Hero.vue'
import Search from '@/Pages/Partials/_Search.vue'
import ListingCard from '@/Pages/Components/ListingCard.vue'

const page = usePage()

const props = defineProps({
  listings: {
    type: Array,
    default: () => [],
  },
  pagination: {
    type: Object,
    default: null,
  },
})

const searchKeywords = computed(() => page.props.filters?.keywords ?? '')
const tagFilter = computed(() => page.props.filters?.tag ?? '')

function changePage(p) {
  router.get(
    '/',
    { ...page.props.filters, page: p },
    { preserveState: true, preserveScroll: true }
  )
}
</script>