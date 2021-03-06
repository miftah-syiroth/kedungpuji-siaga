<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Windmill Dashboard</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('windmill/public/assets/css/tailwind.output.css') }}" />
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('windmill/public/assets/js/init-alpine.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
        <script src="{{ asset('windmill/public/assets/js/charts-lines.js') }}" defer></script>
        <script src="{{ asset('windmill/public/assets/js/charts-pie.js') }}" defer></script>

        {{-- select2 jquery library --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        @livewireStyles
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-200" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('layouts.sidebar')
        {{-- END Desktop Sidebar --}}

        
            <div class="flex flex-col flex-1 w-full">
                {{-- navbar --}}
                @include('layouts.navbar')
                {{-- end navbar --}}

                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ $header }}
                        </h2>
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
