<x-app-layout>
    <x-slot name="header">
        {{ __('Lihat Data Kehamilan') }}
    </x-slot>
    
    @if ($pregnancy)
    <div x-data="{ formOpen: false }" class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <div>
                    <ul>
                        <li>hpth :</li>
                        <li>berat badan (kg) :</li>
                        <li>tinggi badan (cm) :</li>
                        <li>index masa tubuh : </li>
                    </ul>
                    <button x-on:click="formOpen = ! formOpen" class="text-blue-400 underline">edit</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="grid grid-cols-3 gap-4">
            @for ($i = 0; $i < 6; $i++)
                <div class="w-20 h-20 bg-blue-400">
                    
                </div>
            @endfor
        </div>
    </div>

    @else
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <form action="/people/{{ $person->id }}/pregnancies" method="post">
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
    @endif

</x-app-layout>