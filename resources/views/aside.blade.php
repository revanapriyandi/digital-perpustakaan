 <aside
     class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
     aria-label="Sidenav" id="drawer-navigation">
     <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">

         <ul class="space-y-2">
             <li>
                 <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                     <svg aria-hidden="true"
                         class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                         <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                         <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                     </svg>
                     <span class="ml-3">Dashboard</span>
                 </x-nav-link>
             </li>
         </ul>
         <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700 ">
             <li class="py-2">
                 <x-nav-link href="{{ route('category.index') }}" :active="request()->routeIs('category.index')">
                     <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z">
                         </path>
                     </svg>
                     <span class="ml-3">Data Kategori Buku</span>
                 </x-nav-link>
             </li>
             <li class="py-2">
                 <x-nav-link href="{{ route('books.index') }}" :active="request()->routeIs('books.index')">
                     <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                         data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25">
                         </path>
                     </svg>
                     <span class="ml-3">
                         List Data Buku
                     </span>
                 </x-nav-link>
             </li>
         </ul>
     </div>
 </aside>
