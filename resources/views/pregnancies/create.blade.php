<x-app-layout>
    <x-slot name="header">
        {{ __('Show Penduduk') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <form action="/people/{{ $mother->id }}/pregnancies" method="post">
                    {{-- @csrf('PUT') --}}
                    @csrf
                    <div>
                        <x-label for="hpht" :value="__('HPHT')" />
                        <input type="date" name="hpht" id="hpht">
                    </div>
                    <div>
                        <x-label for="mother_weight" :value="__('Berat Badan Ibu Hamil')" />
                        <input type="number" name="mother_weight" id="mother_weight" class="block mt-1 w-full border" required>
                    </div>
                    <div>
                        <x-label for="mother_height" :value="__('Tinggi Badan Ibu Hamil')" />
                        <input type="number" name="mother_height" id="mother_height" class="block mt-1 w-full border" required>
                    </div>
                    <button type="submit" class="rounded-lg px-2 py-1 border bg-blue-500 text-white">simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>