<x-app-layout>
    <x-slot name="header">
        {{ __('Input Laporan Anthropometri') }}
    </x-slot>
    
    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif

    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/anthropometries/{{ $anthropometry->id }}">
                    @csrf
                    @method('PUT')
                    <div class="p-2">
                        <div class="flex flex-row flex-wrap">
                            <!-- mother_weight -->
                            <div class="mx-4">
                                <x-label for="weight" :value="__('Berat Badan (kg)')" />
                                <input type="number" name="weight" id="weight" step="0.01" value="{{ $anthropometry->weight }}" required class="block mt-1 w-28 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
        
                            <!-- panjang badan -->
                            <div class="mx-4 w-auto">
                                <x-label for="height" :value="__('Panjang Badan (cm)')" />
                                <input type="number" name="height" id="height" step="0.01" value="{{ $anthropometry->height }}" required class="block mt-1 w-32 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- lingkar kepala -->
                            <div class="mx-4 w-auto">
                                <x-label for="head_circumference" :value="__('Lingkar Kepala (cm)')" />
                                <input type="number" step="0.01" name="head_circumference" id="head_circumference" value="{{ $anthropometry->head_circumference }}" required class="block mt-1 w-32 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>

                        <!-- tanggal kunjungan -->
                        <div class="mx-4 w-80 mt-4">
                            <x-label for="visited_at" :value="__('Tanggal Kunjungan')" />
                            <input type="date" name="visited_at" id="visited_at" value="{{ $anthropometry->visited_at->isoFormat('YYYY-MM-DD') }}" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <span class="text-sm text-green-800">
                                Lorem, ipsum dolor.
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-4">
                        <x-button class="ml-4">
                            {{ __('Input Kunjungan') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>