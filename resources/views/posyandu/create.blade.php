<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Balita Posyandu') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-start">
            <div x-data="{ person: ''}" class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/posyandu">
                    @csrf
                    <!-- kompone pencarian balita -->
                    @livewire('posyandu.search-balita')
                    {{-- end komponen --}}
                    
                    <div class="flex items-center justify-between mt-4">
                        <x-button class="ml-4">
                            {{ __('Tambah Bayi Posyandu') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>