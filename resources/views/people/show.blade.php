<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Penduduk') }}
    </x-slot>
    
    <div class="px-2 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <dl>
            {{-- komponen data personal --}}
            <x-people.personal-data :person="$person" />
            {{-- END komponen data personal --}}

            {{-- komponen ringkas keluarga --}}
            <x-people.family-data :person="$person" />
            {{-- komponen ringkas keluarga --}}

            {{-- komponen pasangan dan KB --}}
            <x-people.couple-data :person="$person" />
            {{-- komponen pasangan dan KB --}}

            @if ($person->sex_id == 2)
            {{-- komponen kehamilan dan nifas --}}
            <x-people.pregnancy-data :person="$person" />
            {{-- komponen kehamilan dan nifas --}}
            @endif
            
            {{-- komponen posyandy --}}
            <x-people.posyandu-data :person="$person" />
            {{-- komponen posyandy --}}
        </dl>  
    </div>
</x-app-layout>