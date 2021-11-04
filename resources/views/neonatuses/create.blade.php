<x-app-layout>
    <x-slot name="header">
        {{ __('Input Laporan Pelayanan Neonatus') }}
    </x-slot>

    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif


    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/posyandu/{{ $posyandu->id }}/periode/{{ $periode }}/neonatuses">
            @csrf
            {{-- <input type="hidden" name="periode" value="{{ $periode }}"> --}}
            <div class="flex flex-wrap">
                <label class="block text-sm mr-2" for="visited_at">
                    <span class="text-gray-700 dark:text-gray-400">Waktu Kunjungan</span>
                    <input type="datetime-local" name="visited_at" id="visited_at" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    <span class="text-sm text-green-800 dark:text-gray-500">
                        {{ $waktu_awal->isoFormat('DD MMM YYYY HH:mm') }} s.d. {{ $waktu_akhir->isoFormat('DD MMM YYYY HH:mm') }}
                    </span>
                </label>

                <!-- baby_weight -->
                <label class="block text-sm mx-2" for="baby_weight">
                    <span class="text-gray-700 dark:text-gray-400">BB (kg)</span>
                    <input type="number" name="baby_weight" id="baby_weight" min="1" step="any" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                {{-- panjang bayi --}}
                <label class="block text-sm mx-2" for="baby_lenght">
                    <span class="text-gray-700 dark:text-gray-400">PB (cm)</span>
                    <input type="number" name="baby_lenght" id="baby_lenght" min="1" step="any" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- baby_lenght -->
                <label class="block text-sm mx-2" for="baby_head_circumference">
                    <span class="text-gray-700 dark:text-gray-400">LK (cm)</span>
                    <input type="number" name="baby_head_circumference" id="baby_head_circumference" step="any" min="1" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div> 

            <div class="flex flex-wrap mt-4 ml-2">
                @if ($periode == 1)
                <!-- imd -->
                <div class="mx-2 flex items-center">
                    <span class="text-gray-700 dark:text-gray-400">Inisiasi Menyusui Dini :</span>
                    <input class="form-checkbox ml-1" type="checkbox" value="1" name="imd" id="imd" />
                </div>
                @endif
                
                @if (in_array($periode, [1, 2]))
                <!-- vit k1 -->
                <div class="mx-2 flex items-center">
                    <span class="text-gray-700 dark:text-gray-400 text-sm">Vitamin K1 :</span>
                    <input class="form-checkbox border-2 ml-1" type="checkbox" value="1" name="vitamin_k1" id="vitamin_k1" />
                </div>

                <!-- salep/tetes mata -->
                <div class="mx-2 flex items-center">
                    <span class="text-gray-700 dark:text-gray-400 text-sm">Salep/Tetes Mata : </span>
                    <input class="form-checkbox border-2 ml-1" type="checkbox" value="1" name="salep_mata" id="salep_mata" />
                </div>
                @endif
                

                @if (in_array($periode, [1, 2, 3]))
                <div class="mx-2 flex items-center">
                    <span class="text-gray-700 dark:text-gray-400 text-sm">Imunisasi HB : </span>
                    <input class="form-checkbox border-2 ml-1" type="checkbox" value="1" name="imunisasi_hb" id="imunisasi_hb" />
                </div>
                @endif
                
                <div class="mx-2 flex items-center">
                    <span class="text-gray-700 dark:text-gray-400 text-sm">Perawatan Tali Pusat : </span>
                    <input class="form-checkbox border-2 ml-1" type="checkbox" value="1" name="perawatan_tali_pusat" id="perawatan_tali_pusat" />
                </div>
            </div>

            <!-- masalah -->
            <label class="block mt-4 text-sm" for="problem">
                <span class="text-gray-700 dark:text-gray-400">Masalah</span>
                <textarea name="problem" id="problem" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3"></textarea>
            </label>


            <div class="flex flex-wrap mt-4">
                <label class="block text-sm mr-2" for="referred_to">
                    <span class="text-gray-700 dark:text-gray-400">Dirujuk ke :</span>
                    <input type="text" name="referred_to" id="referred_to" class="block w-auto border-2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- baby_weight -->
                <label class="block text-sm mx-2" for="health_worker">
                    <span class="text-gray-700 dark:text-gray-400">Nama Jelas Petugas :</span>
                    <input type="text" name="health_worker" id="health_worker" class="block w-auto border-2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
            
            <div class="flex flex-wrap justify-between text-sm">
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Simpan Laporan</button>
                <a href="/posyandu/{{ $posyandu->id }}" type="submit" class=" bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Batal</a>
            </div>
        </form>
    </div>


</x-app-layout>