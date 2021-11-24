<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="/dashboard">
            Kedungpuji Siaga
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span class="absolute inset-y-0 left-0 w-1 {{ request()->routeIs('dashboard') ? 'bg-purple-600' : '' }} rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dashboard">
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <li x-data="{isKependudukanMenuOpen : {{ request()->routeIs('people.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKependudukanMenuOpen = ! isKependudukanMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    <span class="ml-4">Kependudukan</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKependudukanMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->routeIs('people.create') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/people/create">Tambah Penduduk</a>
                        </li>
                        <li class="{{ request()->routeIs('people.childbirths.*') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/childbirths">Tambah Kelahiran</a>
                        </li>
                        <li class="{{ request()->routeIs('people.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/people">Penduduk Kedungpuji</a>
                        </li>
                        
                        <li class="{{ request()->routeIs('people.dead') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="{{ route('people.dead') }}">Pindah atau Mati</a>
                        </li>
                    </ul>
                </template>
            </li>

            <li x-data="{isKbMenuOpen : {{ request()->routeIs('kb.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKbMenuOpen = ! isKbMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    <span class="ml-4">Keluarga Berencana</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKbMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->routeIs('kb.families.create') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/families/create">Tambah Keluarga</a>
                        </li>
                        <li class="{{ request()->routeIs('kb.couples.create') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/couples/create">Tambah Pasangan</a>
                        </li>
                        <li class="{{ request()->routeIs('kb.families.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/families">Semua Keluarga</a>
                        </li>
                        <li class="{{ request()->routeIs('kb.couples.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/couples">Semua Pasangan</a>
                        </li>
                        
                        <li class="{{ request()->routeIs('kb.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/keluarga-berencana">Tabel KB</a>
                        </li>
                    </ul>
                </template>
            </li>

            <li x-data="{isKesehatanIbuMenuOpen : {{ request()->routeIs('pregnancies.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKesehatanIbuMenuOpen = ! isKesehatanIbuMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    <span class="ml-4">Kesehatan Ibu</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKesehatanIbuMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->routeIs('pregnancies.create') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/pregnancies/create">Tambah Kehamilan</a>
                        </li>
                        <li class="{{ request()->routeIs('pregnancies.ibu-hamil') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/ibu-hamil">Ibu Hamil</a>
                        </li>
                        <li class="{{ request()->routeIs('pregnancies.ibu-nifas') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/ibu-nifas">Ibu Nifas</a>
                        </li>
                        <li class="{{ request()->routeIs('pregnancies.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/pregnancies">Semua Kehamilan</a>
                        </li>
                       
                    </ul>
                </template>
            </li>

            <li x-data="{isKesehatanAnakMenuOpen : {{ request()->routeIs('posyandu.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKesehatanAnakMenuOpen = ! isKesehatanAnakMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    <span class="ml-4">Kesehatan Anak</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKesehatanAnakMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->routeIs('posyandu.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/posyandu">Balita</a>
                        </li>
                    </ul>
                </template>
            </li>

            @can('unduh laporan')
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="/reports">
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor" >
                        <path
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                        ></path>
                        </svg>
                    <span class="ml-4">Laporan</span>  
                </a>
            </li>
            @endcan
            
            @can('restore objek')
            <li x-data="{isDeletedMenuOpen : {{ request()->routeIs('deleted.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isDeletedMenuOpen = ! isDeletedMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    <span class="ml-4">Terhapus</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isDeletedMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->routeIs('deleted.people.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/people">Penduduk</a>
                        </li>
                        <li class="{{ request()->routeIs('deleted.families.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/families">Keluarga</a>
                        </li>
                        <li class="{{ request()->routeIs('deleted.couples.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/couples">Pasangan</a>
                        </li>
                        <li class="{{ request()->routeIs('deleted.pregnancies.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/pregnancies">Kehamilan</a>
                        </li>
                        <li class="{{ request()->routeIs('deleted.childbirths.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/childbirths">Kelahiran</a>
                        </li>
                        <li class="{{ request()->routeIs('deleted.puerperals.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/puerperals">Data Nifas</a>
                        </li>
                        <li class="{{ request()->routeIs('deleted.puerperals.index') ? 'border-b-2 border-t-2 text-gray-800' : '' }} px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/posyandu">Posyandu Balita</a>
                        </li>
                    </ul>
                </template>
            </li>
            @endcan
            
            
        </ul>
        @hasanyrole('admin|bidan desa')
        <div class="px-6 my-6">
            <a href="/users" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Kelola Akun
                <span class="ml-2" aria-hidden="true">+</span>
            </a>
        </div>
        @endhasanyrole
       
    </div>
</aside>


  <!-- Mobile sidebar -->
  <!-- Backdrop -->
<div
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
</div>
<aside
    class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="/dashboard">
            Kedungpuji Siaga
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span class="absolute inset-y-0 left-0 w-1 {{ request()->routeIs('dashboard') ? 'bg-purple-600' : '' }} rounded-tr-lg rounded-br-lg" aria-hidden="true">
                </span>
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="/dashboard">
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor" >
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" >
                        </path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <li x-data="{isKependudukanMenuOpen : {{ request()->routeIs('people.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKependudukanMenuOpen = ! isKependudukanMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor" >
                            <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                            ></path>
                        </svg>
                        <span class="ml-4">Kependudukan</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20" >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKependudukanMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/people">Penduduk Kedungpuji</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/people/create">Tambah Penduduk</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/childbirths">Tambah Kelahiran</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="{{ route('people.dead') }}">Pindah atau Mati</a>
                        </li>
                    </ul>
                </template>
            </li>

            <li x-data="{isKbMenuOpen : {{ request()->routeIs('kb.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKbMenuOpen = ! isKbMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor" >
                            <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                            ></path>
                        </svg>
                        <span class="ml-4">Keluarga Berencana</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20" >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKbMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/families">Semua Keluarga</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/couples">Semua Pasangan</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/families/create">Tambah Keluarga</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/couples/create">Tambah Pasangan</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/keluarga-berencana">Tabel KB</a>
                        </li>
                    </ul>
                </template>
            </li>

            <li x-data="{isKesehatanIbuMenuOpen : {{ request()->routeIs('pregnancies.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKesehatanIbuMenuOpen = ! isKesehatanIbuMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor" >
                            <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                            ></path>
                        </svg>
                        <span class="ml-4">Kesehatan Ibu</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20" >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKesehatanIbuMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/ibu-hamil">Ibu Hamil</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/ibu-nifas">Ibu Nifas</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/pregnancies">Semua Kehamilan</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/pregnancies/create">Tambah Kehamilan</a>
                        </li>
                    </ul>
                </template>
            </li>

            <li x-data="{isKesehatanAnakMenuOpen : {{ request()->routeIs('posyandu.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isKesehatanAnakMenuOpen = ! isKesehatanAnakMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor" >
                            <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                            ></path>
                        </svg>
                        <span class="ml-4">Kesehatan Anak</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20" >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isKesehatanAnakMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/posyandu">Balita</a>
                        </li>
                    </ul>
                </template>
            </li>

            @can('unduh laporan')
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="forms.html">
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="ml-4">Laporan</span>
                </a>
            </li>
            @endcan
            

            <li x-data="{isDeletedMenuOpen : {{ request()->routeIs('deleted.*') ? 'true' : 'false' }} }" class="relative px-6 py-3">
                <button x-on:click="isDeletedMenuOpen = ! isDeletedMenuOpen"
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    aria-haspopup="true" >
                    <span class="inline-flex items-center">
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor" >
                            <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                            ></path>
                        </svg>
                        <span class="ml-4">Terhapus</span>
                    </span>
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20" >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" >
                        </path>
                    </svg>
                </button>
                <template x-if="isDeletedMenuOpen">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/people">Penduduk</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/families">Keluarga</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/couples">Pasangan</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/pregnancies">Kehamilan</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/puerperals">Data Nifas</a>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" >
                            <a class="w-full" href="/deleted/posyandu">Posyandu Balita</a>
                        </li>
                    </ul>
                </template>
            </li>

        </ul>

        @hasanyrole('admin|bidan desa')
        <div class="px-6 my-6">
            <a href="/users" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Kelola Akun
            <span class="ml-2" aria-hidden="true">+</span>
            </a>
        </div>
        @endhasanyrole
      </div>
</aside>