<x-app-layout>
    <x-slot name="header">
        {{ __('Kelola KB Pasangan')  }}
    </x-slot>

    {{-- komponen data pasangan dan edit pasangan --}}
    <div class="py-4 flex flex-col">
        <div x-data="{ isOpen : true }">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-2 py-2">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Data Pasangan</button>
                    </h3>
                    <div class="flex justify-between">
                        <a href="/couples/{{ $couple->id }}/edit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-700">edit</a>
                        <form action="/couples/{{ $couple->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <select name="marital_status_id" id="marital_status_id" required class="h-auto rounded-md text-xs">
                                <option hidden>pilih status!</option>
                                @foreach ($cerai_statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                            
                            <button type="submit" class="bg-red-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-red-700">cerai/hapus</button>
                        </form>
                    </div>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama Suami
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                               : <a href="/people/{{ $couple->husband->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $couple->husband->name  }}</a>
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Tempat, Tanggal Lahir Suami
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $couple->husband->place_of_birth . ', ' . $couple->husband->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $couple->husband->date_of_birth->age . ' tahun)'  }}
                            </dd>
                        </div>

                        <hr>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Nama Istri
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : <a href="/people/{{ $couple->wife->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $couple->wife->name  }}</a>
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Tempat, Tanggal Lahir Istri
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                : {{ $couple->wife->place_of_birth . ', ' . $couple->wife->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $couple->wife->date_of_birth->age . ' tahun)'  }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Status Perkawinan Istri
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                               : {{ $couple->wife->maritalStatus->status  }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                            <dt class="text-sm font-medium text-gray-500">
                                Peserta KB
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <p class="font-semibold">
                                    : {{ $couple->is_kb == true ?  $couple->kbService->service ?? '-'  : 'non peserta'  }}
                                </p>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    {{-- komponen data pasangan dan edit pasangan --}}

    {{-- komponen input data kb --}}
    {{-- kalau umur istri subur, beri input utk laporan KB --}}
    <div class="py-4">
        <div x-data="{ isOpen : true }">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Laporan KB {{ $current_year }}</button>
                    </h3>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200">
                    <dl>
                        <div class="grid gap-4 mb-8 grid-cols-4 mt-4">
                            @foreach ($months as $month)
                            <div class="p-2 bg-blue-100 rounded-lg shadow-md">
                                <div x-data="{
                                    showForm: false,
                                    editButton: true, 
                                }" class="flex flex-col">
                                    <p class="mb-2 text-sm font-medium text-dark text-left" >
                                        {{ $month->month }}
                                    </p>
                                    <p class="text-md font-semibold text-gray-700 text-center">
                                        @foreach ($couple->keluargaBerencana as $kb)
                                            @if ($kb->month_periode == $month->id)
                                                {{ $kb->kbStatus->status }}
                                                @break
                                            @endif
                                        @endforeach
                                    </p>

                                    
                                    @if ($is_pus == true)
                                    <button x-show="editButton" x-on:click=" showForm=true, editButton=false " class="text-sm text-right text-blue-800 hover:underline">
                                        edit
                                    </button>
                    
                                    <div x-show="showForm" class="flex flex-col">
                                        <form action="/couples/{{ $couple->id }}/keluarga-berencana" method="post" class="flex flex-col items-center">
                                            @csrf
                                            <input type="hidden" name="month_periode" value="{{ $month->id }}">
                                            <input type="hidden" name="year_periode" value="{{ $current_year }}">
                                            <select name="kb_status_id" id="kb_status_id" class="text-sm">s
                                                <option hidden>pilih!</option>
                                                @foreach ($kb_statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-700 rounded-md px-1 text-white mt-2">simpan</button>
                                        </form>
                                        <button x-on:click=" showForm=false, editButton=true " class="text-sm text-right text-blue-800 hover:underline">cancel </button>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                            @endforeach 
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>    
    
</x-app-layout>