<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Laporan Bulanan Ibu Hamil') }}
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
                <form method="POST" action="/prenatal-classes/{{ $prenatal_class->id }}">
                    @csrf
                    @method('PUT')
                    <div class="border border-b-0 p-2">
                        <div class="flex flex-row flex-wrap">
                            <!-- mother_weight -->
                            <div class="mx-2">
                                <x-label for="mother_weight" :value="__('BB (kg)')" />
                                <input type="number" value="{{ $prenatal_class->mother_weight }}" name="mother_weight" id="mother_weight" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                    
                            <!-- arm_circumference -->
                            <div class="mx-2 w-auto">
                                <x-label for="arm_circumference" :value="__('LiLa (cm)')" />
                                <input type="number" value="{{ $prenatal_class->arm_circumference }}" name="arm_circumference" id="arm_circumference" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                    
                            <!-- Tekanan darah -->
                            <div class="mx-2">
                                <x-label for="systolic" :value="__('Tekanan Darah')" />
                                <div class="flex">
                                    <input type="number" value="{{ $prenatal_class->systolic }}"  name="systolic" id="systolic" min="1" class="block mt-1 mr-2 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                    <input type="number" value="{{ $prenatal_class->diastolic }}"  name="diastolic" id="diastolic" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                </div>
                            </div>
                    
                            <!-- urine_protein -->
                            <div class="mx-2 w-auto">
                                <x-label for="urine_protein" :value="__('Protein Urine')" />
                                <input type="number" value="{{ $prenatal_class->urine_protein }}" name="urine_protein" id="urine_protein" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    
                        <div class="flex flex-row flex-wrap mt-4">
                            <!-- uterine_height -->
                            <div class="mx-2 w-auto">
                                <x-label for="uterine_height" :value="__('TFU (cm)')" />
                                <input type="number" value="{{ $prenatal_class->uterine_height }}"  name="uterine_height" id="uterine_height" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                    
                            <!-- hb -->
                            <div class="mx-2 w-auto">
                                <x-label for="hemoglobin" :value="__('HB')" />
                                <input type="number" value="{{ $prenatal_class->hemoglobin }}" name="hemoglobin" id="hemoglobin" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                    
                            <!-- blood_sugar -->
                            <div class="mx-2 w-auto">
                                <x-label for="blood_sugar" :value="__('Gula Darah')" />
                                <input type="number" value="{{ $prenatal_class->blood_sugar }}" name="blood_sugar" id="blood_sugar" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                    
                             <!-- baby_heart_rate -->
                             <div class="mx-2 w-auto">
                                <x-label for="baby_heart_rate" :value="__('Denyut Jantung Bayi')" />
                                <input type="number" value="{{ $prenatal_class->baby_heart_rate }}" name="baby_heart_rate" id="baby_heart_rate" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div>
                    
                        <!-- tanggal kunjungan -->
                        <div class="mx-2 w-80 mt-4">
                            <x-label for="visited_at" :value="__('Tanggal Kunjungan')" />
                            <input type="date" name="visited_at" id="visited_at" value="{{ $prenatal_class->visited_at->isoFormat('YYYY-MM-DD') }}" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <span class="text-sm text-green-800">
                                {{ $waktu_awal->isoFormat('DD MMM YYYY') }} - {{ $waktu_akhir->isoFormat('DD MMM YYYY') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-4">
                        <x-button class="ml-4">
                            {{ __('Edit Ringkasan') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>