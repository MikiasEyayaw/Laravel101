<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <!-- Content -->
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <div :class="iconClasses">
            <!-- Dynamic icon based on type -->
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-html="icon"></svg>
          </div>
        </div>
        <div class="ml-5 w-0 flex-1">
          <dl>
            <dt class="text-sm font-medium text-gray-500 truncate">
              {{ title }}
            </dt>
            <dd class="text-lg font-medium text-gray-900">
              {{ value }}
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: [String, Number],
    required: true
  },
  iconType: {
    type: String,
    default: 'default'
  }
})

const iconClasses = computed(() => {
  const baseClasses = 'flex items-center justify-center w-12 h-12 rounded-md'
  
  switch (props.iconType) {
    case 'users':
      return `${baseClasses} bg-indigo-500`
    case 'approved':
      return `${baseClasses} bg-green-500`
    case 'pending':
      return `${baseClasses} bg-yellow-500`
    case 'listings':
      return `${baseClasses} bg-blue-500`
    default:
      return `${baseClasses} bg-gray-500`
  }
})

const icon = computed(() => {
  switch (props.iconType) {
    case 'users':
      return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v-1m0 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />'
    case 'approved':
      return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'
    case 'pending':
      return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />'
    case 'listings':
      return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />'
    default:
      return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
  }
})
</script>
