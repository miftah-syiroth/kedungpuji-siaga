<!-- Desktop sidebar -->
<aside class="z-20 flex-shrink-0 hidden w-64 verflow-y-auto bg-white dark:bg-gray-800 md:block">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Windmill
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="#">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        ></path>
                        </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="#">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                  </svg>
                  <span class="ml-4">Tables</span>
                </a>
            </li>

            @hasanyrole('admin|bidan desa')
            <li class="relative px-6 py-3">
                <button class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150hover:text-gray-800"
                    @click="togglePenggunaMenu"
                    aria-haspopup="true"
                >
                    <span class="ml-4 inline-flex items-center">Pengguna</span>
                   
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
                <template x-if="isPenggunaMenuOpen">
                    <ul
                    x-transition:enter="transition-all ease-in-out duration-300"
                    x-transition:enter-start="opacity-25 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-xl"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-xl"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class=" p-2 mt-2 space-y-2 overflow-hidden
                        text-sm
                        font-medium
                        text-gray-500
                        rounded-md
                        shadow-inner
                        bg-gray-50
                    "
                    aria-label="submenu"
                    >
                        <li class="px-2 py-1  transition-colors duration-150 hover:text-gray-800">
                            <a class="w-full" href="{{ route('users.index') }}">Semua Pengguna</a>
                        </li>
                        <li class="px-2 py-1  transition-colors duration-150 hover:text-gray-800">
                            <a class="w-full" href="{{ route('users.create') }}">Tambah Pengguna</a>
                        </li>
                    </ul>
                </template>
            </li>
            @endhasanyrole
            
        </ul>
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
    class="
    fixed
    inset-0
    z-10
    flex
    items-end
    bg-black bg-opacity-50
    sm:items-center sm:justify-center
    ">
</div>
<aside
    class="
    fixed
    inset-y-0
    z-20
    flex-shrink-0
    w-64
    mt-16
    overflow-y-auto
    bg-white
    dark:bg-gray-800
    md:hidden
    "
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
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Windmill
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
            <a
                class="
                inline-flex
                items-center
                w-full
                text-sm
                font-semibold
                transition-colors
                duration-150
                hover:text-gray-800
                dark:hover:text-gray-200
                "
                href="index.html"
            >
                <svg
                class="w-5 h-5"
                aria-hidden="true"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
                >
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
            </a>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="tables.html" >
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Tables</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <button
                    class="
                    inline-flex
                    items-center
                    justify-between
                    w-full
                    text-sm
                    font-semibold
                    transition-colors
                    duration-150
                    hover:text-gray-800
                    dark:hover:text-gray-200
                    "
                    @click="togglePenggunaMenu"
                    aria-haspopup="true"
                >
                    <span class="inline-flex items-center">
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                        ></path>
                    </svg>
                    <span class="ml-4">Pengguna</span>
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
                        clip-rule="evenodd"
                    ></path>
                    </svg>
                </button>
                <template x-if="isPenggunaMenuOpen">
                    <ul
                    x-transition:enter="transition-all ease-in-out duration-300"
                    x-transition:enter-start="opacity-25 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-xl"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-xl"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50dark:text-gray-400 dark:bg-gray-900"
                    aria-label="submenu"
                    >
                        <li class=" px-2  py-1  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="{{ route('users.index') }}">Semua Pengguna</a>
                        </li>
                        <li class=" px-2  py-1  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="{{ route('users.create') }}">Tambah Pengguna</a>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
    </div>
</aside>