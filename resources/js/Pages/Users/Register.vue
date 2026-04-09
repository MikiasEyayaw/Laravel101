<template>

  <div class="min-h-screen bg-[#0f0e0c] flex items-start justify-center pt-24 px-4 pb-16" style="font-family: 'DM Sans', sans-serif;">

    <div class="w-full max-w-lg">



      <!-- Card -->

      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-10 relative overflow-hidden">



        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>



        <header class="text-center mb-8">

          <h2 class="text-2xl font-black uppercase mb-1 tracking-tight text-[#e8e0d0]" style="font-family: 'Playfair Display', serif;">

            Register

          </h2>

          <p class="text-[#c9beaf] text-sm">Create an account to post jobs</p>

        </header>



        <!-- Form -->

        <form @submit.prevent="handleSubmit" novalidate>



          <!-- Name -->

          <div class="mb-6">

            <label for="name" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">Name</label>

            <input

              id="name"

              v-model="form.name"

              type="text"

              name="name"

              autocomplete="name"

              placeholder="Your full name"

              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"

              :class="errors.name ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"

            />

            <p v-if="errors.name" class="text-red-400 text-xs mt-1.5">{{ errors.name }}</p>

          </div>



          <!-- Email -->

          <div class="mb-6">

            <label for="email" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">Email</label>

            <input

              id="email"

              v-model="form.email"

              type="email"

              name="email"

              autocomplete="email"

              placeholder="you@example.com"

              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"

              :class="errors.email ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"

            />

            <p v-if="errors.email" class="text-red-400 text-xs mt-1.5">{{ errors.email }}</p>

          </div>



          <!-- Password -->

          <div class="mb-6">

            <label for="password" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">Password</label>

            <input

              id="password"

              v-model="form.password"

              type="password"

              name="password"

              autocomplete="new-password"

              placeholder="••••••••"

              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"

              :class="errors.password ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"

            />

            <p v-if="errors.password" class="text-red-400 text-xs mt-1.5">{{ errors.password }}</p>

          </div>



          <!-- Confirm Password -->

          <div class="mb-6">

            <label for="password_confirmation" class="inline-block text-base font-semibold mb-2 text-[#c9a97a]">

              Confirm Password

            </label>

            <input

              id="password_confirmation"

              v-model="form.password_confirmation"

              type="password"

              name="password_confirmation"

              autocomplete="new-password"

              placeholder="••••••••"

              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl p-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"

              :class="errors.password_confirmation ? 'border-red-500/60 focus:border-red-500/60 focus:ring-red-500/20' : ''"

            />

            <p v-if="errors.password_confirmation" class="text-red-400 text-xs mt-1.5">{{ errors.password_confirmation }}</p>

          </div>



          <!-- Submit -->

          <div class="mb-6">

            <button

              type="submit"

              :disabled="submitting"

              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200"

            >

              {{ submitting ? 'Creating account...' : 'Sign Up' }}

            </button>

          </div>



          <!-- Login link -->

          <div class="mt-8 border-t border-[#2a2520] pt-6">

            <p class="text-sm text-[#6b5f4e]">

              Already have an account?

              <Link

                href="/login"

                class="text-[#f0a047] font-semibold hover:text-[#f5b46a] hover:underline transition-colors duration-150 ml-1"

              >

                Login

              </Link>

            </p>

          </div>



        </form>

      </div>

    </div>

  </div>



  <!-- Success Modal -->

  <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-8 max-w-md w-full mx-4 relative overflow-hidden">

      <!-- Top amber glow line -->

      <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/30 to-transparent"></div>

      

      <!-- Success Icon -->

      <div class="text-center mb-6">

        <div class="w-16 h-16 bg-[#f0a047]/20 rounded-full flex items-center justify-center mx-auto mb-4">

          <svg class="w-8 h-8 text-[#f0a047]" fill="none" stroke="currentColor" viewBox="0 0 24 24">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>

          </svg>

        </div>

        <h3 class="text-xl font-bold text-[#e8e0d0] mb-2" style="font-family: 'Playfair Display', serif;">

          Registration Submitted!

        </h3>

      </div>

      

      <!-- Message -->

      <div class="text-center mb-6">

        <p class="text-[#c9beaf] mb-4">

          Your registration request has been submitted successfully.

        </p>

        <p class="text-[#a49988] text-sm">

          Please wait for admin approval before you can log in. You'll be redirected to the login page shortly.

        </p>

      </div>

      

      <!-- Redirect Timer -->

      <div class="text-center">

        <div class="text-[#f0a047] text-sm font-semibold">

          Redirecting in {{ redirectCountdown }} seconds...

        </div>

        <div class="w-full bg-[#2a2520] rounded-full h-2 mt-2">

          <div 

            class="bg-[#f0a047] h-2 rounded-full transition-all duration-1000"

            :style="{ width: (redirectCountdown / 5 * 100) + '%' }"

          ></div>

        </div>

      </div>

    </div>

  </div>

</template>



<script setup>

import { reactive, ref, onMounted, onUnmounted } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'

const page = usePage()

const props = defineProps({
  errors: {
    type: Object,
    default: () => ({}),
  },
  oldInput: {
    type: Object,
    default: () => ({}),
  },
})

onMounted(() => {
  console.log('Flash data on mount:', page.props.flash)
  if (page.props.flash.autoApproved === false || page.props.flash.success) {
    showSuccessModal.value = true
    startCountdown()
  }
})

const submitting = ref(false)

const showSuccessModal = ref(false)

const redirectCountdown = ref(5)

let countdownInterval = null



const form = reactive({

  name: props.oldInput?.name ?? '',

  email: props.oldInput?.email ?? '',

  password: '',

  password_confirmation: '',

})



function handleSubmit() {

  submitting.value = true

  router.post('/users', form, {

    onSuccess: (page) => {

      console.log('Success callback:', page.props.flash)

      // Show modal if there's a success message (manual approval case)

      if (page.props.flash.success && !page.props.flash.autoApproved) {

        showSuccessModal.value = true

        startCountdown()

      }

      // If auto-approved, user is already logged in and redirected by backend

    },

    onError: () => {

      submitting.value = false

    },

    onFinish: () => {

      submitting.value = false

    }

  })

}

function startCountdown() {

  countdownInterval = setInterval(() => {

    redirectCountdown.value--

    if (redirectCountdown.value <= 0) {

      clearInterval(countdownInterval)

      redirectToLogin()

    }

  }, 1000)

}



function redirectToLogin() {

  router.visit('/login')

}



onUnmounted(() => {

  if (countdownInterval) {

    clearInterval(countdownInterval)

  }

})

</script>