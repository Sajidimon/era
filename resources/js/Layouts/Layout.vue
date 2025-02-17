<template>
   <div>
      <!-- Admin Bar -->
      <div
         class="admin-bar bg-gray-800 text-white flex justify-between items-center px-4 py-2 fixed top-0 left-0 right-0 z-50">
         <div class="flex items-center">
            <button @click="toggleSidebar()" class="text-gray-300 hover:text-white focus:outline-none mr-4">
               <i class="fas fa-bars"></i>
            </button>
            <a href="/" target="_blank" class="text-sm font-semibold">View Site</a>
         </div>
         <div class="flex items-center space-x-4">
            <button @click="logout" class="text-gray-300 hover:text-white focus:outline-none">
               Logout
            </button>
         </div>
      </div>

      <div class="flex mt-12">
         <!-- Sidebar -->
         <div
            class="sidebar bg-gray-800 text-white w-48 min-h-screen fixed inset-y-0 left-0 transition-transform duration-300 ease-in-out z-50"
            :class="{ '-translate-x-full': isSidebarCollapsed, 'translate-x-0': !isSidebarCollapsed }" id="sidebar">
            <div class="p-6 border-b border-gray-700 flex items-center justify-between">
               <span class="text-md font-semibold">Dashboard</span>
               <button @click="toggleSidebar()" class="text-gray-300 hover:text-white focus:outline-none">
                  <i class="fas fa-bars"></i>
               </button>
            </div>
            <nav class="mt-6">
               <ul class="space-y-1">
                  <li>
                     <Link href="/admin/dashboard"
                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-tachometer-alt w-6"></i>
                        <span class="ml-3">Dashboard</span>
                     </Link>
                  </li>
                  <li>
                     <Link href="/admin/products"
                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="ml-3">Products</span>
                     </Link>
                  </li>
                  <li>
                     <Link href="/admin/funnels"
                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-filter"></i>
                        <span class="ml-3">Sales Funnel</span>
                     </Link>
                  </li>
                  <li>
                     <Link href="/admin/orders"
                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-box"></i>
                        <span class="ml-3">Order</span>
                     </Link>
                  </li>
                  <li>
                     <Link href="/admin/settings"
                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-box"></i>
                        <span class="ml-3">Settings</span>
                     </Link>
                  </li>
               </ul>
            </nav>
         </div>

         <!-- Main Content -->
         <div class="main-content flex-1 p-10 transition-all duration-300 ease-in-out"
            :class="{ 'ml-64': !isSidebarCollapsed, 'ml-0': isSidebarCollapsed }" id="main-content">
            <slot></slot>
         </div>
      </div>
   </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const isSidebarCollapsed = ref(false);

function toggleSidebar() {
   isSidebarCollapsed.value = !isSidebarCollapsed.value;
}

//user logout;
function logout() {
   router.post('/logout');
}

</script>

<style scoped>
.admin-bar {
   height: 50px;
}

.sidebar {
   transition: transform 0.3s ease-in-out;
}

/* Mobile Fix */
@media (max-width: 768px) {
   .sidebar {
      transform: translateX(-100%);
   }

   .sidebar.translate-x-0 {
      transform: translateX(0);
   }

   .main-content {
      margin-left: 0 !important;
   }
}
</style>
