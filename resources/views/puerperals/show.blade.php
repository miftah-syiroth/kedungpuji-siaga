<x-app-layout>
    <x-slot name="header">
        {{ __('Ringkasan Pelayanan Nifas: ') }} 
        <a href="/people/{{ $puerperal->pregnancy->mother->id }}" class="text-blue-400 hover:text-blue-700">{{ $puerperal->pregnancy->mother->name }}</a>
    </x-slot>


    <div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white shadow-lg dark:bg-gray-800">
        <div class="px-4 py-2">
            <h3 class="text-md leading-6 font-medium justify-center text-center">
                <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Ringkasan</button>
            </h3>
            <div x-show="isOpen" class="flex justify-between">
                <a href="/puerperals/{{ $puerperal->id }}/edit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-700">edit nifas</a>
                <a href="/pregnancies/{{ $puerperal->pregnancy->id }}" class=" bg-green-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-green-700">lihat data kehamilan</a>
            </div>
        </div>
        <div x-show="isOpen" class="border-t border-gray-200 flex flex-row">
            <dl>
                <div class="px-4 py-1 grid grid-cols-5 gap-2">
                    <dt class="text-sm font-medium text-gray-500 col-span-2">
                        Kondisi Ibu
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                        : @foreach ($puerperal->motherConditions as $condition)
                            {{ $condition->condition }}, 
                        @endforeach
                    </dd>
                </div>

                <div class="px-4 py-1 grid grid-cols-5 gap-2">
                    <dt class="text-sm font-medium text-gray-500 col-span-2">
                        Kondisi Bayi
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                        : @foreach ($puerperal->babyConditions as $condition)
                            {{ $condition->condition }}, 
                        @endforeach
                    </dd>
                </div>

                <div class="px-4 py-1 grid grid-cols-5 gap-2">
                    <dt class="text-sm font-medium text-gray-500 col-span-2">
                        komplikasi nifas
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                        : @foreach ($puerperal->complications as $complication)
                            {{ $complication->complication }}, 
                        @endforeach
                    </dd>
                </div>

                <div class="px-4 py-1 grid grid-cols-5 gap-2">
                    <dt class="text-sm font-medium text-gray-500 col-span-2">
                        kesimpulan
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                        : {{ $puerperal->conclusion }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>


    {{-- komponen input data kb --}}
    <div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800">
        <div class="px-4 py-2 flex flex-col">
            <h3 class="text-md leading-6 font-medium justify-center text-center">
                <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Layanan Ibu Nifas</button>
            </h3>

            @if (session('message'))
                <span class="text-red-500 text-sm text-center">
                    {{ session('message') }}
                </span>
            @endif

            <div x-show="isOpen">
                @if ($puerperal->conclusion)
                <h3 class="text-sm font-medium">Selesai</h3>
                @elseif ($puerperal_day_to > 42)
                <h3 class="text-sm font-medium">Lebih dari 42 hari ({{ $puerperal_day_to }})</h3>
                @else
                <h3 class="text-sm font-medium">Nifas hari ke {{ $puerperal_day_to }}</h3>
                @endif
            </div>
        </div>
        
        <div x-show="isOpen" class="border-t border-gray-200">
            <div class="grid gap-2 mb-8 grid-cols-2 mt-4">
                @foreach ($periode as $jadwal)
                    
                <div class="rounded-md border-2">
                    <div class="flex flex-col flex-wrap">

                        <div class="mb-2 text-sm font-medium text-dark text-center">
                            <h3 class="text-md font-medium text-dark text-center" >
                                KF {{ $jadwal['nomor'] }}
                            </h3>
                            <h5 class="text-sm text-gray-600 dark:text-gray-500">({{ $jadwal['min'] }} - {{ $jadwal['max'] }})</h5>
                        </div>
                        
                        
                        {{-- kalau ga terisi, button input muncul --}}
                        @php $is_filled = false; @endphp

                        @foreach ($puerperal->puerperalClasses as $data)

                        @if ($data->periode == $jadwal['nomor'])
                        @php $is_filled = true; @endphp
                        <dl>
                            <div class="px-2 py-1 flex flex-col text-sm">
                                <h3 class="font-semibold">Waktu Kunjungan :</h3>
                                <h5 class="ml-4">{{ $data->visited_at->isoFormat('dddd, DD MMMM YYYY') }}</h5>
                            </div>
                            <div class="px-2 py-1 flex flex-col text-sm">
                                <h3 class="font-semibold">Faskes :</h3>
                                <h5 class="ml-4">{{ $data->faskes }}</h5>
                            </div>
                            <div class="px-2 py-1 flex flex-col text-sm">
                                <h3 class="font-semibold">Masalah :</h3>
                                <p class="ml-4">{{ $data->problem }}</p>
                            </div>
                            <div class="px-2 py-1 flex flex-col text-sm">
                                <h3 class="font-semibold">Tindakan :</h3>
                                <p class="ml-4">{{ $data->action }}</p>
                            </div>
                        </dl>

                        <div class="text-center my-2">
                            <a href="/puerperal-classes/{{ $data->id }}/edit" class="text-sm text-center rounded-md py-1 px-4 bg-green-500 hover:bg-green-700 text-white">edit</a>
                        </div>
                        
                        
                        @break
                        @endif
                        
                        @endforeach
                        
                        @if ($is_filled == false && $puerperal->conclusion == null)
                        <div class="flex justify-center my-2">
                            <a href="/puerperals/{{ $puerperal->id }}/periode/{{ $jadwal['nomor'] }}/puerperal-classes/create" class="text-xs rounded-md px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white">input</a>
                        </div>
                        @endif
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
  
</x-app-layout>