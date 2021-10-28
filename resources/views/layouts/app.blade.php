<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>K-WD Dashboard</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('kwd/public/build/css/tailwind.css') }}" />
        <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        

        {{-- livewire --}}
        @livewireStyles
    </head>
    <body>
        <div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
            <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
                <!-- Loading screen -->
                <div x-ref="loading"  class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
                    Loading.....
                </div>

                <!-- Sidebar -->
                @include('layouts.sidebar')

                <div class="flex-1 relative h-full overflow-x-hidden overflow-y-auto">
                    <!-- Navbar -->
                    @include('layouts.navbar')

                    <!-- Main content -->
                    <main>
                        <!-- Content header -->
                        <div class="flex items-center justify-between px-4 py-2 border-b lg:py-4 dark:border-primary-darker">
                            {{ $header }}
                        </div>

                        <!-- Content -->
                        <div class="mt-2">
                            {{ $slot }}
                        </div>
                    </main>
                </div>

                <!-- Panels -->
                @include('layouts.panel')
                
            </div>
        </div>

        @livewireScripts
        @stack('scripts')

        <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
        <script src="{{ asset('kwd/public/build/js/script.js') }}"></script>
        <script src="{{ asset('kwd/public/build/js/initial-alpine.js') }}"></script>
    </body>
</html>
