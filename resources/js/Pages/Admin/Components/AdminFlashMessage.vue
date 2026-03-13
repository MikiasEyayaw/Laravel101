<template>
  <div
    v-if="show"
    :class="[
      'fixed bottom-4 right-4 px-4 py-2 rounded-md shadow-lg transition-all duration-300',
      type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    ]"
  >
    <div class="flex items-center">
      <!-- Success icon -->
      <svg v-if="type === 'success'" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      
      <!-- Error icon -->
      <svg v-else class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      
      <span>{{ message }}</span>
    </div>
    
    <!-- Close button -->
    <button
      @click="close"
      class="ml-4 text-white hover:text-gray-200"
    >
      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  message: {
    type: String,
    required: true
  },
  type: {
    type: String,
    default: 'success',
    validator: (value) => ['success', 'error'].includes(value)
  },
  autoClose: {
    type: Boolean,
    default: true
  }
})

const show = ref(true)

const close = () => {
  show.value = false
}

// Auto close after 3 seconds if autoClose is true
if (props.autoClose) {
  setTimeout(() => {
    show.value = false
  }, 3000)
}
</script>
