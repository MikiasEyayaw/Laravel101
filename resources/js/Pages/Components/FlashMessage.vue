<template>
  <Transition
    enter-active-class="transition-all duration-300 ease-out"
    enter-from-class="opacity-0 translate-y-[-12px]"
    enter-to-class="opacity-100 translate-y-0"
    leave-active-class="transition-all duration-200 ease-in"
    leave-from-class="opacity-100 translate-y-0"
    leave-to-class="opacity-0 translate-y-[-12px]"
  >
    <div
      v-if="visible && message"
      class="fixed top-5 left-1/2 -translate-x-1/2 z-[200] w-full max-w-sm px-4"
    >
      <div
        class="flex items-center gap-3 px-5 py-4 rounded-xl text-sm font-medium shadow-2xl border"
        :style="styles"
      >
        <!-- Icon -->
        <div class="flex-shrink-0">
          <svg v-if="type === 'success'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
          <svg v-else-if="type === 'error'" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
          </svg>
          <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>

        <span class="flex-1">{{ message }}</span>

        <!-- Dismiss -->
        <button @click="visible = false" class="flex-shrink-0 opacity-50 hover:opacity-100 transition-opacity">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'

const props = defineProps({
  message: { type: String, default: '' },
  type: { type: String, default: 'success' },
  duration: { type: Number, default: 4000 },
})

const visible = ref(false)
let timer = null

const styles = computed(() => {
  if (props.type === 'success') return 'background: #1c180f; border-color: rgba(240,160,71,0.4); color: #f0a047;'
  if (props.type === 'error') return 'background: #1a0f0f; border-color: rgba(220,80,80,0.4); color: #e07070;'
  return 'background: #101520; border-color: rgba(80,140,220,0.4); color: #7ab0e0;'
})

function show() {
  if (!props.message) return
  visible.value = true
  clearTimeout(timer)
  if (props.duration > 0) timer = setTimeout(() => (visible.value = false), props.duration)
}

onMounted(show)
watch(() => props.message, show)
</script>