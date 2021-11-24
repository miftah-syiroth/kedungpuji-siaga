<x-app-layout>
    <x-slot name="header">
        {{ __('Pelayanan Neonatus dan Posyandu') }} 
    </x-slot>

    <div x-data="{ isNeonatusOpen : false, isAntropometriOpen : false }">
        <div x-data="{ isRingkasanOpen : true }" class="px-4 py-3 mb-4 bg-white shadow-md dark:bg-gray-800"> 
            <div class="px-2 py-2">
                <h3 class="text-md leading-6 font-medium justify-center text-center">
                    <button x-on:click="isRingkasanOpen = ! isRingkasanOpen" class="w-full hover:text-blue-700">Ringkasan</button>
                </h3>
                <div x-show="isRingkasanOpen" class="flex justify-between">
                    <a href="/posyandu/{{ $posyandu->id }}/edit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-700">edit</a>
                </div>
            </div>
            <div x-show="isRingkasanOpen" class="border-t border-gray-200 grid grid-cols-7">
                <dl class="col-span-3 capitalize">
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nama 
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : <a href="/people/{{ $posyandu->person->id }}" class="text-blue-500 dark:text-light hover:text-blue-700 hover:underline">{{ $posyandu->person->name }}</a>
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Waktu Lahir 
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : {{ $posyandu->person->date_of_birth->isoFormat('dddd, DD MMM YYYY hh:mm A') }}
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Umur 
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : {{ $posyandu->person->date_of_birth->age }} tahun atau {{ $posyandu->person->date_of_birth->diffInMonths(now()) }} bulan
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Ibu Kandung
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : @isset($posyandu->person->mother)
                            <a href="/people/{{ $posyandu->person->mother->id }}" class="text-blue-500 dark:text-light hover:text-blue-700 hover:underline">
                                {{ $posyandu->person->mother->name }}
                            </a>
                            @endisset
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Kesimpulan Neonatus
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : {{ $posyandu->neonatus_conclusion }}
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Kesimpulan Antropometri
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : {{ $posyandu->posyandu_conclusion }}
                        </dd>
                    </div>
                </dl>
                <dl class="col-span-4">
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Umur Kehamilan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : @isset($posyandu->person->childbirth)
                                {{ $posyandu->person->childbirth->pregnancy->gestational_age }}
                            @endisset
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Berat Badan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : @isset($posyandu->person->childbirth)
                                {{ $posyandu->person->childbirth->weight }} gram
                            @endisset
                        </dd>
                    </div>
    
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Panjang Badan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : @isset($posyandu->person->childbirth)
                                {{ $posyandu->person->childbirth->length }} cm
                            @endisset
                        </dd>
                    </div>
    
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Lingkar Kepala
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : @isset($posyandu->person->childbirth)
                            {{ $posyandu->person->childbirth->head_circumference }} cm
                            @endisset
                        </dd>
                    </div>
                    <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Metode Persalinan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            : @isset($posyandu->person->childbirth)
                            {{ $posyandu->person->childbirth->childbirth_method }}
                            @endisset
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="flex justify-center">
            <button x-on:click="isNeonatusOpen = ! isNeonatusOpen" class="mx-4 text-white text-sm py-1 px-8 bg-blue-500 rounded-md hover:bg-blue-600">Neonatus</button>
            <button x-on:click="isAntropometriOpen = ! isAntropometriOpen" class="mx-4 text-white text-sm py-1 px-8 bg-blue-500 rounded-md hover:bg-blue-600">Antropometri</button>
        </div>
    
        <div x-show="isNeonatusOpen">
            <x-posyandu.neonatus :posyandu="$posyandu" />
        </div>
    
        {{-- komponen antropometri --}}
        <div x-show="isAntropometriOpen">
            @livewire('posyandu.anthropometries', ['posyandu' => $posyandu])
        </div>
        {{-- komponen antropometri --}}
    </div>
    
</x-app-layout>