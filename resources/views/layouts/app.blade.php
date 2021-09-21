<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
        />
        {{-- styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- script --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('template/assets/js/init-alpine.js') }}" ></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
        <script src="{{ asset('template/assets/js/charts-lines.js') }}" defer></script>
        
        <script src="{{ asset('template/assets/js/charts-pie.js') }}" defer></script>
    </head>
    <body>
        <div class="flex h-screen bg-gray-100" :class="{ 'overflow-hidden': isSideMenuOpen}">
            @include('layouts.sidebar')

            <div class="flex flex-col flex-1">
                @include('layouts.navbar')

                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <h2 class="my-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                           {{ $header }}
                        </h2>
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
