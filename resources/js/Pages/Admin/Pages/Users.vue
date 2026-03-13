<template>
  <AdminLayout>
    <div class="space-y-6" style="font-family: 'DM Sans', sans-serif;">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-bold tracking-[0.2em] uppercase text-[#8a7a66] mb-1">Management</p>
          <h1 class="text-2xl font-black text-[#e8e0d0] tracking-tight" style="font-family: 'Playfair Display', serif;">
            Users Management
          </h1>
        </div>
        <Link
          href="/admin/users/pending"
          class="inline-flex items-center gap-2 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/25 text-yellow-400 hover:text-yellow-300 font-semibold text-sm px-4 py-2 rounded-xl transition-all duration-150"
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          View Pending ({{ pendingCount }})
        </Link>
      </div>

      <!-- Filters -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl p-4">
        <div class="flex gap-3">
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-[#4a3f32]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
              </svg>
            </div>
            <input
              type="text"
              v-model="search"
              placeholder="Search users..."
              class="w-full bg-[#1a1815] border border-[#2a2520] text-[#e8e0d0] placeholder-[#4a3f32] rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30"
            />
          </div>
          <select
            v-model="statusFilter"
            class="bg-[#1a1815] border border-[#2a2520] text-[#c9b99a] rounded-xl px-4 py-2.5 text-sm outline-none transition-all duration-200 focus:border-[#f0a047]/50 focus:ring-1 focus:ring-[#f0a047]/30 cursor-pointer"
          >
            <option value="">All Users</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
      </div>

      <!-- Table Card -->
      <div class="bg-[#16140f] border border-[#2a2520] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead>
              <tr class="border-b border-[#2a2520]">
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Name</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Email</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Approval Status</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Active Status</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Joined</th>
                <th class="px-6 py-3.5 text-left text-[10px] font-bold text-[#8a7a66] uppercase tracking-[0.15em]">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#2a2520]">
              <tr
                v-for="user in users.data"
                :key="user.id"
                class="hover:bg-[#1a1815] transition-colors duration-150"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <Link
                    :href="`/admin/users/${user.id}/activity`"
                    class="text-sm font-semibold text-[#f0a047] hover:text-[#f5b46a] hover:underline transition-colors duration-150"
                  >
                    {{ user.name }}
                  </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#c9b99a]">
                  {{ user.email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg border',
                    user.is_approved
                      ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                      : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20'
                  ]">
                    {{ user.is_approved ? 'Approved' : 'Pending' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-lg border',
                    user.is_active
                      ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20'
                      : 'bg-red-500/10 text-red-400 border-red-500/20'
                  ]">
                    {{ user.is_active ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-[#8a7a66]">
                  {{ new Date(user.created_at).toLocaleDateString() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-1.5 flex-wrap">
                    <Link
                      :href="`/admin/users/${user.id}/edit`"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] hover:bg-[#252118] border border-[#2a2520] px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                      Edit
                    </Link>
                    <button
                      v-if="!user.is_approved"
                      @click="approveUser(user.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                      Approve
                    </button>
                    <button
                      v-if="user.is_approved"
                      @click="rejectUser(user.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-yellow-400 hover:text-yellow-300 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                      Reject
                    </button>
                    <button
                      v-if="user.is_active"
                      @click="deactivateUser(user.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-orange-400 hover:text-orange-300 bg-orange-500/10 hover:bg-orange-500/20 border border-orange-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                      Deactivate
                    </button>
                    <button
                      v-if="!user.is_active"
                      @click="activateUser(user.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-400 hover:text-emerald-300 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                      Activate
                    </button>
                    <button
                      @click="deleteUser(user.id)"
                      class="inline-flex items-center gap-1 text-xs font-semibold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-2.5 py-1.5 rounded-lg transition-all duration-150"
                    >
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                      Delete
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="!users.data?.length">
                <td colspan="6" class="px-6 py-16 text-center text-sm text-[#8a7a66]">No users found</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-[#2a2520] flex items-center justify-between">
          <p class="text-xs text-[#8a7a66]">
            Page <span class="text-[#c9b99a] font-semibold">{{ users.current_page }}</span>
            of <span class="text-[#c9b99a] font-semibold">{{ users.last_page }}</span>
          </p>
          <div class="flex gap-2">
            <Link
              v-if="users.prev_page_url"
              :href="users.prev_page_url"
              class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150"
            >← Prev</Link>
            <Link
              v-if="users.next_page_url"
              :href="users.next_page_url"
              class="text-xs font-semibold text-[#c9b99a] hover:text-white bg-[#1a1815] border border-[#2a2520] px-3 py-1.5 rounded-lg hover:bg-[#252118] transition-all duration-150"
            >Next →</Link>
          </div>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../Layout/AdminLayout.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  users: Object,
  pendingCount: Number
})

const search = ref('')
const statusFilter = ref('')

const approveUser = (userId) => {
  router.post(`/admin/users/${userId}/approve`)
}

const rejectUser = (userId) => {
  const reason = prompt('Please provide rejection reason:')
  if (reason) {
    router.post(`/admin/users/${userId}/reject`, { rejection_reason: reason })
  }
}

const activateUser = (userId) => {
  router.post(`/admin/users/${userId}/activate`)
}

const deactivateUser = (userId) => {
  if (confirm('Are you sure you want to deactivate this user?')) {
    router.post(`/admin/users/${userId}/deactivate`)
  }
}

const deleteUser = (userId) => {
  if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
    router.delete(`/admin/users/${userId}`)
  }
}
</script>