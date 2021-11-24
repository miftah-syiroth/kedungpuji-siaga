<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Kehamilan Baru') }}
    </x-slot>
    
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @if (session('message'))
        <div class="text-sm text-red-600">
            {{ session('message') }}
        </div>
        @endif

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="/pregnancies" method="post">
            @csrf

            <div class="flex flex-wrap mt-4">
                @livewire('pregnancies.search-mother')

                <label class="block text-sm mx-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">HPHT</span>
                    <input type="date" name="hpht" id="hpht" value="{{ old('hpht') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                </label>
            </div>

            <div class="flex mt-4">
                <label class="block text-sm mx-2" for="nik">
                    <span class="text-gray-700 dark:text-gray-400">Berat Ibu Hamil (kg)</span>
                    <input type="number" name="weight" id="weight" step="any" min="10" value="{{ old('weight') }}" required class="block w-auto mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                </label>

                <label class="block text-sm mx-2" for="nik">
                    <span class="text-gray-700 dark:text-gray-400">Tinggi Ibu Hamil (cm)</span>
                    <input type="number" name="height" id="height" min="100" value="{{ old('height') }}" required class="block w-auto mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                </label>
            </div>
            
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Tambah Kehamilan</button>
            </div>
        </form>
    </div>
</x-app-layout>