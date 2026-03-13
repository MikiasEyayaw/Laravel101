<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div>
        <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Admin</p>
        <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
          Settings
        </h1>
      </div>

      <!-- ===== ADMIN PROFILE ===== -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>

        <div class="px-8 py-6 border-b border-[#2a2520]">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
              <svg class="w-4 h-4 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#e8e0d0]">Admin Profile</h3>
              <p class="text-xs text-[#8a7a66]">Update your admin profile information</p>
            </div>
          </div>
        </div>

        <form @submit.prevent="updateProfile">
          <div class="px-8 py-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

              <div>
                <label for="name" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Name</label>
                <input
                  type="text"
                  id="name"
                  v-model="profileForm.name"
                  placeholder="Admin name"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="errors.name ? 'border-red-500/60' : ''"
                />
                <p v-if="errors.name" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                  {{ errors.name }}
                </p>
              </div>

              <div>
                <label for="email" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Email</label>
                <input
                  type="email"
                  id="email"
                  v-model="profileForm.email"
                  placeholder="admin@example.com"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="errors.email ? 'border-red-500/60' : ''"
                />
                <p v-if="errors.email" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                  {{ errors.email }}
                </p>
              </div>

            </div>
          </div>

          <div class="px-8 py-4 bg-[#131109] border-t border-[#2a2520] flex justify-end">
            <button
              type="submit"
              :disabled="profileForm.processing"
              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200"
            >
              <svg v-if="profileForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
              </svg>
              {{ profileForm.processing ? 'Updating...' : 'Update Profile' }}
            </button>
          </div>
        </form>
      </div>

      <!-- ===== CHANGE PASSWORD ===== -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>

        <div class="px-8 py-6 border-b border-[#2a2520]">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
              <svg class="w-4 h-4 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#e8e0d0]">Change Password</h3>
              <p class="text-xs text-[#8a7a66]">Update your admin password</p>
            </div>
          </div>
        </div>

        <form @submit.prevent="updatePassword">
          <div class="px-8 py-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

              <div>
                <label for="current_password" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Current Password</label>
                <input
                  type="password"
                  id="current_password"
                  v-model="passwordForm.current_password"
                  placeholder="Enter current password"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="errors.current_password ? 'border-red-500/60' : ''"
                />
                <p v-if="errors.current_password" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                  {{ errors.current_password }}
                </p>
              </div>

              <div>
                <label for="password" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">
                  New Password <span class="text-[#8a7a66] font-normal">(min 6 characters)</span>
                </label>
                <input
                  type="password"
                  id="password"
                  v-model="passwordForm.password"
                  placeholder="Enter new password"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="errors.password ? 'border-red-500/60' : ''"
                />
                <p v-if="errors.password" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                  {{ errors.password }}
                </p>
              </div>

              <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-[#c9b99a] mb-1.5">Confirm New Password</label>
                <input
                  type="password"
                  id="password_confirmation"
                  v-model="passwordForm.password_confirmation"
                  placeholder="Confirm new password"
                  class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl px-4 py-3 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
                  :class="errors.password_confirmation ? 'border-red-500/60' : ''"
                />
                <p v-if="errors.password_confirmation" class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                  <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                  {{ errors.password_confirmation }}
                </p>
              </div>

            </div>
          </div>

          <div class="px-8 py-4 bg-[#131109] border-t border-[#2a2520] flex justify-end">
            <button
              type="submit"
              :disabled="passwordForm.processing"
              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200"
            >
              <svg v-if="passwordForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
              </svg>
              {{ passwordForm.processing ? 'Updating...' : 'Update Password' }}
            </button>
          </div>
        </form>
      </div>

      <!-- ===== SYSTEM SETTINGS ===== -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#f0a047]/20 to-transparent"></div>

        <div class="px-8 py-6 border-b border-[#2a2520]">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#f0a047]/10 border border-[#f0a047]/20 flex items-center justify-center">
              <svg class="w-4 h-4 text-[#f0a047]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#e8e0d0]">System Settings</h3>
              <p class="text-xs text-[#8a7a66]">Configure system-wide settings</p>
            </div>
          </div>
        </div>

        <form @submit.prevent="updateSystemSettings">
          <div class="px-8 py-6">

            <!-- Auto-approve toggle row -->
            <div class="flex items-center justify-between py-4 border border-[#2a2520] rounded-xl px-5 bg-[#1a1815]">
              <div>
                <p class="text-sm font-semibold text-[#e8e0d0]">Auto-approve Users</p>
                <p class="text-xs text-[#8a7a66] mt-0.5">Automatically approve new user registrations</p>
              </div>
              <button
                type="button"
                @click="toggleAutoApprove"
                class="relative flex-shrink-0"
                aria-label="Toggle auto-approve"
              >
                <div
                  class="w-11 h-6 rounded-full transition-colors duration-200 border"
                  :class="autoApproveUsers
                    ? 'bg-emerald-500 border-emerald-500'
                    : 'bg-[#2a2520] border-[#3a3025]'"
                ></div>
                <div
                  class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-all duration-200"
                  :class="autoApproveUsers ? 'translate-x-5' : 'translate-x-0'"
                ></div>
              </button>
            </div>

          </div>

          <div class="px-8 py-4 bg-[#131109] border-t border-[#2a2520] flex justify-end">
            <button
              type="submit"
              :disabled="settingsForm.processing"
              class="inline-flex items-center gap-2 bg-[#f0a047] hover:bg-[#f5b46a] disabled:opacity-50 disabled:cursor-not-allowed text-[#0f0e0c] font-bold rounded-xl py-2.5 px-6 text-sm transition-all duration-200"
            >
              <svg v-if="settingsForm.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              {{ settingsForm.processing ? 'Saving...' : 'Save Settings' }}
            </button>
          </div>
        </form>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import AdminLayout from '../Layout/AdminLayout.vue'

const page = usePage()
const autoApproveUsers = ref(false)
const errors = ref({})

const currentAdmin = page.props.auth?.admin || {}

const profileForm = useForm({
  name: currentAdmin.name || '',
  email: currentAdmin.email || '',
})

const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const settingsForm = useForm({
  auto_approve_users: false,
})

onMounted(() => {
  autoApproveUsers.value = typeof page.props.autoApproveUsers !== 'undefined' ? page.props.autoApproveUsers : false
  settingsForm.auto_approve_users = autoApproveUsers.value
  if (currentAdmin) {
    profileForm.name = currentAdmin.name || ''
    profileForm.email = currentAdmin.email || ''
  }
})

const toggleAutoApprove = () => {
  autoApproveUsers.value = !autoApproveUsers.value
  settingsForm.auto_approve_users = autoApproveUsers.value
}

const updateProfile = () => {
  profileForm.post('/admin/admin/profile', {
    preserveScroll: true,
    onSuccess: () => { errors.value = {} },
    onError: (errs) => { errors.value = errs },
  })
}

const updatePassword = () => {
  passwordForm.post('/admin/admin/password', {
    preserveScroll: true,
    onSuccess: () => {
      errors.value = {}
      passwordForm.reset()
    },
    onError: (errs) => { errors.value = errs },
  })
}

const updateSystemSettings = () => {
  settingsForm.post('/admin/settings', {
    preserveScroll: true,
  })
}
</script>