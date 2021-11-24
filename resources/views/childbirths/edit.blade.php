<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Ringkasan Pelayanan Kelahiran: ') }}
        <a href="/pregnancies/{{ $childbirth->pregnancy->id }}" class="text-blue-400 hover:text-blue-700">{{ $childbirth->pregnancy->person->name }}</a>
    </x-slot>

    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif
    
    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/childbirths/{{ $childbirth->id }}">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap">
                <!-- Urutan anak -->
                <label class="block text-sm mx-2" for="weight">
                    <span class="text-gray-700 dark:text-gray-400">Anak ke:</span>
                    <input type="number" name="childbirth_order" id="childbirth_order" min="1" step="any" value="{{ $childbirth->childbirth_order ?? old('childbirth_order') }}" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- Berat badan -->
                <label class="block text-sm mx-2" for="height">
                    <span class="text-gray-700 dark:text-gray-400">BB Bayi (gr)</span>
                    <input type="number" name="weight" id="weight" min="1" step="any" value="{{ $childbirth->weight ?? old('weight') }}" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- PB Bayi -->
                <label class="block text-sm mx-2" for="height">
                    <span class="text-gray-700 dark:text-gray-400">PB Bayi (cm)</span>
                    <input type="number" name="length" id="length" min="1" step="any" value="{{ $childbirth->length ?? old('length') }}" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- lingkar kepala -->
                <label class="block text-sm mx-2" for="height">
                    <span class="text-gray-700 dark:text-gray-400">LK Bayi (cm)</span>
                    <input type="number" name="head_circumference" id="head_circumference" min="1" step="any" value="{{ $childbirth->head_circumference ?? old('head_circumference') }}" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div> 
            
            <div class="flex flex-wrap">
                <label class="block mx-2 my-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Jenis Kelamin
                    </span>
                    <select name="sex_id" id="sex_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($sexes as $sex)
                        <option {{ $childbirth->sex_id == $sex->id ? 'selected' : '' }} value="{{ $sex->id }}">{{ $sex->sex }}</option>
                        @endforeach
                    </select>
                </label>

                <!-- penolong persalinan -->
                <label class="block text-sm mx-2 my-2" for="childbirth_attendant">
                    <span class="text-gray-700 dark:text-gray-400">Metode Persalinan</span>
                    <input type="text" name="childbirth_method" id="childbirth_method" value="{{ $childbirth->childbirth_method ?? old('childbirth_method') }}" class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Normal/tindakan"/>
                </label>
            </div>

            <div class="flex flex-wrap">
                <!-- Kondisi ibu saat lahir -->
                <div class="mx-2 w-auto mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Kondisi Bayi</span>
                    <div class="grid grid-rows-4 grid-flow-col gap-2 mt-2">
                        @foreach ($baby_conditions as $condition)
                        <label class="inline-flex items-center mx-2">
                            <input class="border" type="checkbox" name="baby_condition_id[]" value="{{ $condition->id }}" />
                            <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                        </label> 
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <label class="block mt-4 text-sm mx-2">
                <span class="text-gray-700 dark:text-gray-400">Keterangan Tambahan</span>
                <textarea name="additional_information" id="additional_information" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ $childbirth->additional_information ?? old('additional_information') }}</textarea>
            </label>

            <div class="flex flex-wrap justify-between text-sm">
                <div>
                    <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Edit Ringkasan</button>
                    <a href="/pregnancies/{{ $childbirth->pregnancy->id }}" type="submit" class=" bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Batal Ubah</a>
                </div>
                
            </div>
        </form>

        @can('hapus kelahiran')
        <form action="/childbirths/{{ $childbirth->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="flex justify-end text-sm">
                <button type="submit" class="bg-red-500 dark:bg-red-800 text-white dark:text-gray-200 py-2 px-3 rounded-md hover:bg-red-700 dark:hover:bg-red-900 mx-2 my-4">hapus kelahiran</button>
            </div>
        </form>
        @endcan
        
    </div>

</x-app-layout>