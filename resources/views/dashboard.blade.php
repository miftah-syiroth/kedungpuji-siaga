<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-8">
        <div class="mx-auto px-4 max-w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h3 class="font-bold text-xl">
                        Selamat Datang : 
                        <span class="text-indigo-700">{{ Auth::user()->name }}</span>
                    </h3>
                    <p class="font-semibold text-lg">
                        Anda login dengan hak akses sebagai : <span class="text-indigo-700">{{ Auth::user()->getRoleNames()->first()}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
