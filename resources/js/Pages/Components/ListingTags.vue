<template>
  <div class="flex flex-wrap gap-1.5">
    <Link
      v-for="tag in tagList"
      :key="tag"
      :href="`/?tag=${encodeURIComponent(tag)}`"
      preserve-scroll
      class="inline-block text-xs font-semibold px-2.5 py-1 rounded-md transition-all duration-150"
      style="background: rgba(240,160,71,0.1); color: #c9a97a; border: 1px solid rgba(240,160,71,0.15);"
      @click.stop
      @mouseover="e => { e.currentTarget.style.background='rgba(240,160,71,0.18)'; e.currentTarget.style.color='#f0a047'; }"
      @mouseleave="e => { e.currentTarget.style.background='rgba(240,160,71,0.1)'; e.currentTarget.style.color='#c9a97a'; }"
    >
      {{ tag }}
    </Link>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  tags: { type: [String, Array], default: '' },
})

const tagList = computed(() => {
  if (Array.isArray(props.tags)) return props.tags.filter(Boolean)
  if (typeof props.tags === 'string' && props.tags.trim()) {
    return props.tags.split(',').map(t => t.trim()).filter(Boolean)
  }
  return []
})
</script>