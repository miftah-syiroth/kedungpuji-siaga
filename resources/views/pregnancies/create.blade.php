<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Kehamilan') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                @if (session('message'))
                    <p class="text-red-500 text-sm mx-4">
                        {{ session('message') }}
                    </p>
                @endif
                <form action="/pregnancies" method="post">
                    @csrf
                    <div class="flex mx-4">
                        {{-- input nama ibu --}}
                        @livewire('pregnancies.search-mother')
                        
                        {{-- hpht --}}
                        <div class="ml-4">
                            <x-label for="hpht" :value="__('HPHT')" />
                            <input type="date" name="hpht" id="hpht" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                        </div>
                    </div>
                    
                    <div class="flex mt-4 mx-4">
                        <div>
                            <x-label for="mother_weight" :value="__('Berat Badan Ibu Hamil')" />
                            <input type="number" name="mother_weight" id="mother_weight" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"" required>
                        </div>
                        <div class="ml-4">
                            <x-label for="mother_height" :value="__('Tinggi Badan Ibu Hamil')" />
                            <input type="number" name="mother_height" id="mother_height" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" required>
                        </div>
                    </div>
                    
                    <div class="mx-4 mt-4">
                        <button type="submit" class="rounded-lg px-2 py-1 border bg-blue-500 hover:bg-blue-700 text-white">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>