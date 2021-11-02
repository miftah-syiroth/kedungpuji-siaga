<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Laporan Anthropometri') }}
    </x-slot>
    
    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif

 
    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/anthropometries/{{ $anthropometry->id }}">
            @csrf
            @method('PUT')
            <div class="p-2">
                <div class="flex flex-wrap mt-4">
                    <!-- mother_weight -->
                    <label class="block text-sm mr-2" for="weight">
                        <span class="text-gray-700 dark:text-gray-400">Berat Badan (gram)</span>
                        <input type="number" name="weight" id="weight" value="{{ $anthropometry->weight }}" step="any" min="500" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- panjang badan -->
                    <label class="block text-sm mx-2" for="height">
                        <span class="text-gray-700 dark:text-gray-400">Panjang Badan (cm)</span>
                        <input type="number" name="height" id="height" value="{{ $anthropometry->height }}" step="any" min="10" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- lingkar kepala -->
                    <label class="block text-sm mx-2" for="head_circumference">
                        <span class="text-gray-700 dark:text-gray-400">Lingkar Kepala (cm)</span>
                        <input type="number" name="head_circumference" id="head_circumference" value="{{ $anthropometry->head_circumference }}" step="any" min="10" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>
                </div>

                <!-- tanggal kunjungan -->
                <label class="block text-sm mr-2 mt-4 w-auto" for="visited_at">
                    <span class="text-gray-700 dark:text-gray-400">Waktu Kunjungan</span>
                    <input type="datetime-local" name="visited_at" id="visited_at" value="{{ $anthropometry->visited_at->isoFormat('YYYY-MM-DD') }}" required class="block w-auto mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    <span class="text-sm text-green-800 dark:text-gray-500">
                        {{-- {{ $waktu_awal->isoFormat('DD MMM YYYY HH:mm') }} s.d. {{ $waktu_akhir->isoFormat('DD MMM YYYY HH:mm') }} --}}
                    </span>
                </label>
            </div>
            
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Edit Laporan</button>
            </div>
        </form>
    </div>

</x-app-layout>