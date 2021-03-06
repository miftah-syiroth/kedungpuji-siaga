<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold">{{ __('Dashboard') }}</h1>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto px-4 max-w-full">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-bold text-xl">
                        Selamat Datang : 
                        <span>{{ Auth::user()->name }}</span>
                    </h3>
                    <p class="font-semibold text-lg">
                        Anda login dengan hak akses sebagai : <span>{{ Auth::user()->getRoleNames()->first()}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
