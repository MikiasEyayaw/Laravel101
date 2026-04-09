<template>
  <section class="relative overflow-hidden bg-[#0f0e0c]" style="min-height: 480px;">

    <!-- Background Image Layer -->
    <div class="absolute inset-0 z-0">
      <img
        src="/public/images/background.avif"
        alt=""
        class="w-full h-full object-cover"
        style="opacity: 0.12; filter: sepia(60%) saturate(80%);"
      />
      <!-- Gradient vignette -->
      <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 0%, rgba(240,160,71,0.07) 0%, transparent 70%), linear-gradient(to bottom, rgba(15,14,12,0.3) 0%, rgba(15,14,12,0.85) 70%, #0f0e0c 100%);"></div>
      <!-- Subtle grid texture -->
      <div class="absolute inset-0 opacity-[0.03]" style="background-image: repeating-linear-gradient(0deg, #f0a047 0, #f0a047 1px, transparent 1px, transparent 60px), repeating-linear-gradient(90deg, #f0a047 0, #f0a047 1px, transparent 1px, transparent 60px);"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 py-24 sm:py-32">

      <!-- Eyebrow label -->
      <div class="inline-flex items-center gap-2 mb-6 px-4 py-1.5 rounded-full border text-xs font-semibold tracking-[0.15em] uppercase" style="border-color: rgba(240,160,71,0.3); color: #f0a047; background: rgba(240,160,71,0.06);">
        <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background: #f0a047;"></span>
        The Laravel Job Board
      </div>

      <!-- Main Title -->
      <h1 class="font-black leading-none tracking-tight mb-4" style="font-family: 'Playfair Display', serif; font-size: clamp(4rem, 12vw, 7rem); color: #f0f0ec;">
        Lara<span style="color: #f0a047;">Jobs</span>
      </h1>

      <!-- Subtitle -->
      <p class="text-lg sm:text-xl font-light max-w-md mb-10" style="color: #9a8a76; letter-spacing: 0.01em; line-height: 1.6;">
        Find or post <em class="font-medium not-italic" style="color: #c9a97a;">Laravel</em> jobs &amp; projects
      </p>

      <!-- CTA Button (ONLY WHEN NOT LOGGED IN) -->
      <Link
        v-if="!user"
        href="/login"
        class="inline-flex items-center gap-2.5 px-8 py-4 rounded-xl font-bold text-base transition-all duration-300 group"
        style="background: #f0a047; color: #0f0e0c; box-shadow: 0 0 0 0 rgba(240,160,71,0.4);"
        @mouseover="e => { e.currentTarget.style.background='#f5b46a'; e.currentTarget.style.boxShadow='0 8px 32px rgba(240,160,71,0.35)'; e.currentTarget.style.transform='translateY(-2px)'; }"
        @mouseleave="e => { e.currentTarget.style.background='#f0a047'; e.currentTarget.style.boxShadow='0 0 0 0 rgba(240,160,71,0.4)'; e.currentTarget.style.transform='translateY(0)'; }"
      >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Sign Up to List a Job
      </Link>

    </div>

    <!-- Bottom fade into search bar -->
    <div class="absolute bottom-0 left-0 right-0 h-16 z-10" style="background: linear-gradient(to bottom, transparent, #0f0e0c);"></div>

  </section>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.auth?.user)
</script>