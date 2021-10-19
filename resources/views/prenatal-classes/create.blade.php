<x-app-layout>
    <x-slot name="header">
        {{ __('Input Laporan Bulanan Ibu Hamil') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/pregnancies/{{ $pregnancy->id }}/prenatal-classes">
                    @csrf
                    <div class="border border-b-0 p-2">
                        <div class="flex flex-row flex-wrap">
                            <input type="hidden" name="month_periode" value="{{ $month }}">
                            <!-- mother_weight -->
                            <div class="mx-2">
                                <x-label for="mother_weight" :value="__('BB (kg)')" />
                                <input type="number" name="mother_weight" id="mother_weight" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
        
                            <!-- arm_circumference -->
                            <div class="mx-2 w-auto">
                                <x-label for="arm_circumference" :value="__('LiLa (cm)')" />
                                <input type="number" name="arm_circumference" id="arm_circumference" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- Tekanan darah -->
                            <div class="mx-2">
                                <x-label for="systolic" :value="__('Tekanan Darah')" />
                                <div class="flex">
                                    <input type="number" name="systolic" id="systolic" min="1" class="block mt-1 mr-2 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                    <input type="number" name="diastolic" id="diastolic" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                </div>
                            </div>

                             <!-- uterine_height -->
                             <div class="mx-2 w-auto">
                                <x-label for="uterine_height" :value="__('TFU (cm)')" />
                                <input type="number" name="uterine_height" id="uterine_height" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- baby_heart_rate -->
                            <div class="mx-2 w-auto">
                                <x-label for="baby_heart_rate" :value="__('Denyut Jantung Bayi')" />
                                <input type="number" name="baby_heart_rate" id="baby_heart_rate" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- hb -->
                            <div class="mx-2 w-auto">
                                <x-label for="hemoglobin" :value="__('HB')" />
                                <input type="number" name="hemoglobin" id="hemoglobin" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- urine_protein -->
                            <div class="mx-2 w-auto">
                                <x-label for="urine_protein" :value="__('Protein Urine')" />
                                <input type="number" name="urine_protein" id="urine_protein" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- blood_sugar -->
                            <div class="mx-2 w-auto">
                                <x-label for="blood_sugar" :value="__('Gula Darah')" />
                                <input type="number" name="blood_sugar" id="blood_sugar" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
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