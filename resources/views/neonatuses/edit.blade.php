<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Laporan Pelayanan Neonatus') }}
    </x-slot>
    
    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif

    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/neonatuses/{{ $neonatus->id }}">
                    @csrf
                    @method('PUT')
                    <div class="border border-b-0 p-2">
                        <div class="flex flex-row flex-wrap">
                            <div class="mx-4">
                                <x-label for="visited_at" :value="__('Waktu Pelayanan')" />
                                <input type="datetime-local" name="visited_at" id="visited_at" value="{{ $neonatus->visited_at->isoFormat('YYYY-MM-DDThh:mm') }}" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <span class="text-sm text-green-800">
                                    {{ $waktu_awal->isoFormat('DD-MMM-YYYY') }} hingga {{ $waktu_akhir->isoFormat('DD-MMM-YYYY') }}
                                </span>
                            </div>

                            <!-- baby_weight -->
                            <div class="mx-4">
                                <x-label for="baby_weight" :value="__('Berat Badan (kg)')" />
                                <input type="number" name="baby_weight" id="baby_weight" value="{{ $neonatus->baby_weight }}" required min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- baby_weight -->
                            <div class="mx-4">
                                <x-label for="baby_lenght" :value="__('Panjang Badan (cm)')" />
                                <input type="number" name="baby_lenght" id="baby_lenght" value="{{ $neonatus->baby_lenght }}" required min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- baby_weight -->
                            <div class="mx-4">
                                <x-label for="baby_head_circumference" :value="__('LK (cm)')" />
                                <input type="number" name="baby_head_circumference" id="baby_head_circumference" value="{{ $neonatus->baby_head_circumference }}" required min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div> 
                        <div class="flex flex-row flex-wrap mt-4 ml-2">
                            @if ($neonatus->periode == 1)
                            <!-- imd -->
                            <div class="mx-2 flex items-center">
                                <x-label for="imd" :value="__('Inisiasi Menyusui Dini : ')" />
                                <input class="form-radio ml-1" type="checkbox" value="1" {{ $neonatus->imd == 1 ? 'checked' : '' }} name="imd" id="imd" />
                            </div>
                            @endif
                            
                            @if (in_array($neonatus->periode, [1, 2]))
                            <!-- vit k1 -->
                            <div class="mx-2 flex items-center">
                                <x-label for="vitamin_k1" :value="__('Vitamin K1 : ')" />
                                <input class="form-radio ml-1" type="checkbox" value="1" {{ $neonatus->vitamin_k1 == 1 ? 'checked' : '' }} name="vitamin_k1" id="vitamin_k1" />
                            </div>

                            <!-- salep/tetes mata -->
                            <div class="mx-2 flex items-center">
                                <x-label for="salep_mata" :value="__('Salep/Tetes Mata : ')" />
                                <input class="form-radio ml-1" type="checkbox" value="1" {{ $neonatus->salep_mata == 1 ? 'checked' : '' }} name="salep_mata" id="salep_mata" />
                            </div>
                            @endif
                            

                            @if (in_array($neonatus->periode, [1, 2, 3]))
                            <div class="mx-2 flex items-center">
                                <x-label for="imunisasi_hb" :value="__('Imunisasi HB : ')" />
                                <input class="form-radio ml-1" type="checkbox" {{ $neonatus->imunisasi_hb == 1 ? 'checked' : '' }} value="1" name="imunisasi_hb" id="imunisasi_hb" />
                            </div>
                            @endif
                            
                            <div class="mx-2 flex items-center">
                                <x-label for="perawatan_tali_pusat" :value="__('Perawatan Tali Pusat : ')" />
                                <input class="form-radio ml-1" type="checkbox" {{ $neonatus->perawatan_tali_pusat == 1 ? 'checked' : '' }} value="1" name="perawatan_tali_pusat" id="perawatan_tali_pusat" />
                            </div>
                        </div>
                        <div class="flex flex-row flex-wrap mt-4">
                            <!-- masalah -->
                            <div class="mx-4">
                                <x-label for="problem" :value="__('Masalah')" />
                                <textarea name="problem" id="problem" cols="46" rows="5" class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">{{ $neonatus->problem }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-row flex-wrap mt-4">
                            <div class="mx-4">
                                <x-label for="referred_to" :value="__('Dirujuk ke :')" />
                                <input type="text" name="referred_to" id="referred_to" value="{{ $neonatus->referred_to }}" class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- baby_weight -->
                            <div class="mx-4">
                                <x-label for="health_worker" :value="__('Nama Jelas Petugas')" />
                                <input type="text" name="health_worker" id="health_worker" value="{{ $neonatus->health_worker }}" required min="1" class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-4 ml-2">
                        <x-button class="ml-4">
                            {{ __('Edit Laporan') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>