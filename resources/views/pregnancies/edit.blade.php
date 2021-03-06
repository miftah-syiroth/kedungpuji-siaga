<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Ringkasan Pelayanan Persalinan: ') }}
        <a href="/pregnancies/{{ $pregnancy->id }}" class="text-blue-400 hover:text-blue-700">{{ $pregnancy->person->name }}</a>
    </x-slot>

    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif
    
    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/pregnancies/{{ $pregnancy->id }}">
            @csrf
            @method('PUT')

            <h3 class="text-center font-semibold text-gray-600 mb-4">Data Awal Kehamilan</h3>
            <div class="flex flex-wrap">
                <!-- hpht -->
                <label class="block text-sm mr-2" for="hpht">
                    <span class="text-gray-700 dark:text-gray-400">HPHT</span>
                    <input type="date" name="hpht" id="hpht" value="{{ $pregnancy->hpht->isoFormat('YYYY-MM-DD') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- bb ibu -->
                <label class="block text-sm mx-2" for="weight">
                    <span class="text-gray-700 dark:text-gray-400">BB Ibu (kg)</span>
                    <input type="number" name="weight" id="weight" min="1" step="any" value="{{ $pregnancy->weight }}" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- tb ibu -->
                <label class="block text-sm mx-2" for="height">
                    <span class="text-gray-700 dark:text-gray-400">TB Ibu (cm)</span>
                    <input type="number" name="height" id="height" min="1" step="any" value="{{ $pregnancy->height }}" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div> 
            
            <div class="p-2">
                <h3 class="text-center font-semibold text-gray-600 mb-4">Ringkasan Akhir</h3>
                <div class="flex flex-wrap">
                    <!-- tanggal persalinan -->
                    <label class="block text-sm mr-2" for="childbirth_date">
                        <span class="text-gray-700 dark:text-gray-400">Waktu Persalinan</span>
                        <input type="datetime-local" name="childbirth_date" id="childbirth_date" value="{{ $pregnancy->childbirth_date ? $pregnancy->childbirth_date->isoFormat('YYYY-MM-DDThh:mm') : '' }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- penolong persalinan -->
                    <label class="block text-sm mx-2" for="childbirth_attendant">
                        <span class="text-gray-700 dark:text-gray-400">Penolong Persalinan</span>
                        <input type="text" name="childbirth_attendant" id="childbirth_attendant" value="{{ $pregnancy->childbirth_attendant }}" class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="SpOg/Dokter Umum/Bidan"/>
                    </label>
                </div>

                <div class="flex flex-wrap">
                    <!-- Kondisi ibu saat lahir -->
                    <div class="mx-1 w-auto mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Kondisi Ibu</span>
                        <div class="grid grid-rows-1 grid-flow-col gap-2 mt-2">
                            @foreach ($mother_conditions as $condition)
                            <label class="inline-flex items-center mx-2">
                                <input class="border" type="radio" name="mother_condition_id" {{ $pregnancy->mother_condition_id == $condition->id ? 'checked' : '' }} value="{{ $condition->id }}" />
                                <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                            </label> 
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Keterangan Tambahan</span>
                    <textarea name="additional_information" id="additional_information" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ $pregnancy->additional_information }}</textarea>
                </label>
            </div>
            <div class="flex flex-wrap justify-between text-sm">
                <div>
                    <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Edit Ringkasan</button>
                    <a href="/pregnancies/{{ $pregnancy->id }}" type="submit" class=" bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Batal Ubah</a>
                </div>
                
            </div>
        </form>

        @can('hapus kehamilan')
        <form action="/pregnancies/{{ $pregnancy->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="flex justify-end text-sm">
                <button type="submit" class="bg-red-500 dark:bg-red-800 text-white dark:text-gray-200 py-2 px-3 rounded-md hover:bg-red-700 dark:hover:bg-red-900 mx-2 my-4">hapus kehamilan</button>
            </div>
        </form>
        @endcan
        
    </div>

</x-app-layout>