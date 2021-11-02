<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Laporan Bulanan Ibu Hamil') }}
    </x-slot>
    
    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif

    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/prenatal-classes/{{ $prenatal_class->id }}">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap">
                <!-- mother_weight -->
                <label class="block text-sm mr-2" for="mother_weight">
                    <span class="text-gray-700 dark:text-gray-400">BB Ibu (kg)</span>
                    <input type="number" name="mother_weight" id="mother_weight" min="1" value="{{ $prenatal_class->mother_weight }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
        
                <!-- arm_circumference -->
                <label class="block text-sm mx-2" for="arm_circumference">
                    <span class="text-gray-700 dark:text-gray-400">LiLa (cm)</span>
                    <input type="number" name="arm_circumference" id="arm_circumference" min="1" value="{{ $prenatal_class->arm_circumference }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
        
                <!-- Tekanan darah -->
                <label class="block text-sm mx-2" for="">
                    <span class="text-gray-700 dark:text-gray-400">Tekanan Darah</span>
                    <div class="flex">
                        <div>
                            <input type="number" name="systolic" id="systolic" min="1" value="{{ $prenatal_class->systolic }}" required class="block mx-2 w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <span class="text-sm mx-2">systolic</span>
                        </div>
                        <div>
                            <input type="number" name="diastolic" id="diastolic" min="1" value="{{ $prenatal_class->diastolic }}" required class="block mx-2 w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <span class="text-sm mx-2">diastolic</span>
                        </div>
                    </div>
                </label>
        
                <!-- urine_protein -->
                <label class="block text-sm mx-2" for="urine_protein">
                    <span class="text-gray-700 dark:text-gray-400">Protein Urine</span>
                    <input type="number" name="urine_protein" id="urine_protein" min="1" value="{{ $prenatal_class->urine_protein }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
        
            <div class="flex flex-row flex-wrap mt-4">
                <!-- uterine_height -->
                <label class="block text-sm mr-2" for="uterine_height">
                    <span class="text-gray-700 dark:text-gray-400">TFU (cm)</span>
                    <input type="number" name="uterine_height" id="uterine_height" min="1" value="{{ $prenatal_class->uterine_height }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
        
                <!-- hb -->
                <label class="block text-sm mx-2" for="hemoglobin">
                    <span class="text-gray-700 dark:text-gray-400">HB</span>
                    <input type="number" name="hemoglobin" id="hemoglobin" min="1" value="{{ $prenatal_class->hemoglobin }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
        
                <!-- blood_sugar -->
                <label class="block text-sm mx-2" for="blood_sugar">
                    <span class="text-gray-700 dark:text-gray-400">Gula Darah</span>
                    <input type="number" name="blood_sugar" id="blood_sugar" min="1" value="{{ $prenatal_class->blood_sugar }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
        
                <!-- baby_heart_rate -->
                <label class="block text-sm mx-2" for="baby_heart_rate">
                    <span class="text-gray-700 dark:text-gray-400">Denyut Jantung Bayi</span>
                    <input type="number" name="baby_heart_rate" id="baby_heart_rate" min="1" value="{{ $prenatal_class->baby_heart_rate }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
        
            <!-- tanggal kunjungan -->
            <div class="flex flex-wrap mt-4">
                <label class="block text-sm mr-2" for="visited_at">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Kunjungan</span>
                    <input type="date" name="visited_at" id="visited_at" value="{{ $prenatal_class->visited_at->isoFormat('YYYY-MM-DD') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    <span class="text-sm text-green-800 dark:text-gray-400">
                        {{ $waktu_awal->isoFormat('DD MMM YYYY') }} - {{ $waktu_akhir->isoFormat('DD MMM YYYY') }}
                    </span>
                </label>
            </div>
            
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Edit</button>
            </div>
        </form>
    </div>
</x-app-layout>