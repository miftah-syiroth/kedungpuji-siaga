<x-app-layout>
    <x-slot name="header">
        {{ __('Ringkasan Pelayanan Nifas: ') }} 
        <a href="/people/{{ $puerperal->pregnancy->mother->id }}" class="text-blue-400 hover:text-blue-700">{{ $puerperal->pregnancy->mother->name }}</a>
    </x-slot>

    <div class="flex flex-row">
        <div x-data="{ isOpen : true }" class="py-4 mr-2 w-full">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Ringkasan</button>
                    </h3>
                    <div x-show="isOpen" class="flex justify-between">
                        <a href="/puerperals/{{ $puerperal->id }}/edit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-700">edit kesimpulan</a>
                        <a href="/pregnancies/{{ $puerperal->pregnancy->id }}" class=" bg-green-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-green-700">lihat data kehamilan</a>
                    </div>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200 flex flex-row">
                    <dl>
                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-8 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Kondisi Ibu
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-6">
                                : @foreach ($puerperal->motherConditions as $condition)
                                    {{ $condition->condition }}, 
                                @endforeach
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-8 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Kondisi Bayi
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-6">
                                : @foreach ($puerperal->babyConditions as $condition)
                                    {{ $condition->condition }}, 
                                @endforeach
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-8 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                komplikasi nifas
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-6">
                                : @foreach ($puerperal->complications as $complication)
                                    {{ $complication->complication }}, 
                                @endforeach
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-8 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                kesimpulan
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-6">
                                : {{ $puerperal->conclusion }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- komponen input data kb --}}
    <div class="py-4">
        <div x-data="{ isOpen : true }">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2 flex flex-col">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Layanan Ibu Nifas</button>
                    </h3>

                    @if (session('message'))
                        <span class="text-red-500 text-sm text-center">
                            {{ session('message') }}
                        </span>
                    @endif

                    <div x-show="isOpen">
                        <h3 class="text-sm font-medium">Nifas hari ke : {{ $puerperal_day_to }}</h3>
                    </div>
                </div>
                
                <div x-show="isOpen" class="border-t border-gray-200">
                    <div class="grid gap-2 mb-8 grid-cols-2 mt-4">
                        @foreach ($periode as $jadwal)
                           
                        <div class="bg-gray-50 rounded-md border-2">
                            <div class="flex flex-col flex-wrap py-2 px-1">

                                <div class="mb-2">
                                    <h3 class="text-md font-medium text-dark text-center" >
                                        KF {{ $jadwal['nomor'] }}
                                    </h3>
                                    <h5 class="text-center text-sm text-gray-600">({{ $jadwal['min'] }} - {{ $jadwal['max'] }})</h5>
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

                                <a href="/puerperal-classes/{{ $data->id }}/edit" class="text-xs text-center rounded-md py-1 bg-green-500 hover:bg-green-700 text-white m-1">edit</a>
                                
                                
                                @break
                                @endif
                                
                                @endforeach
                                
                                @if ($is_filled == false && $puerperal->conclusion == null)
                                <div class="flex justify-center">
                                    <a href="/puerperals/{{ $puerperal->id }}/puerperal-classes/{{ $jadwal['nomor'] }}/create" class="text-xs rounded-md px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white">input</a>
                                </div>
                                @endif
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>