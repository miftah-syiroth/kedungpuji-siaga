<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Ringkasan Pelayanan Persalinan: ') }}
        <a href="/pregnancies/{{ $pregnancy->id }}" class="text-blue-400 hover:text-blue-700">{{ $pregnancy->mother->name }}</a>
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
                    <input type="date" name="hpht" id="hpht" value="{{ $pregnancy->hpht->isoFormat('YYYY-MM-DD') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- bb ibu -->
                <label class="block text-sm mx-2" for="mother_weight">
                    <span class="text-gray-700 dark:text-gray-400">BB Ibu (kg)</span>
                    <input type="number" name="mother_weight" id="mother_weight" min="1" value="{{ $pregnancy->mother_weight }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- tb ibu -->
                <label class="block text-sm mx-2" for="mother_height">
                    <span class="text-gray-700 dark:text-gray-400">TB Ibu (cm)</span>
                    <input type="number" name="mother_height" id="mother_height" min="1" value="{{ $pregnancy->mother_height }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div> 
            
            <div class="p-2">
                <h3 class="text-center font-semibold text-gray-600 mb-4">Ringkasan Akhir</h3>
                <div class="flex flex-wrap">
                    <!-- tanggal persalinan -->
                    <label class="block text-sm mr-2" for="childbirth_date">
                        <span class="text-gray-700 dark:text-gray-400">Waktu Persalinan</span>
                        <input type="datetime-local" name="childbirth_date" id="childbirth_date" value="{{ $pregnancy->childbirth_date ? $pregnancy->childbirth_date->isoFormat('YYYY-MM-DDThh:mm') : '' }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- penolong persalinan -->
                    <label class="block text-sm mx-2" for="childbirth_attendant">
                        <span class="text-gray-700 dark:text-gray-400">Penolong Persalinan</span>
                        <input type="text" name="childbirth_attendant" id="childbirth_attendant" value="{{ $pregnancy->childbirth_attendant }}" required class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="SpOg/Dokter Umum/Bidan"/>
                    </label>

                    <!-- cara persalinan -->
                    <label class="block text-sm mx-2" for="childbirth_method">
                        <span class="text-gray-700 dark:text-gray-400">Metode Persalinan</span>
                        <input type="text" name="childbirth_method" id="childbirth_method" value="{{ $pregnancy->childbirth_method }}" required class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Normal/Tindakan ..."/>
                    </label>

                    <!-- keadaan ibu pasca melahirkan -->
                    <label class="block text-sm mx-2" for="post_partum_condition">
                        <span class="text-gray-700 dark:text-gray-400">Kondisi Pasca Melahirkan</span>
                        <input type="text" name="post_partum_condition" id="post_partum_condition" value="{{ $pregnancy->post_partum_condition }}" required class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="sehat/sakit/meninggal ..."/>
                    </label>
                </div>

                <!-- Informasi Tambahan -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Keterangan Tambahan</span>
                    <textarea name="mother_additional_information" id="mother_additional_information" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">
                        {{ $pregnancy->additional_information }}
                    </textarea>
                </label>
            </div>
            
            <div class="p-2">
                <h3 class="text-center font-semibold text-gray-600 mb-4">Ringkasan Anak</h3>
                <div class="flex flex-wrap">
                    <!-- Kelahiran ke -->
                    <label class="block text-sm mr-2" for="childbirth_order">
                        <span class="text-gray-700 dark:text-gray-400">Kelahiran ke?</span>
                        <input type="number" name="childbirth_order" id="childbirth_order" min="1" value="{{ $pregnancy->childbirth_order }}" required class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- Berat Bayi -->
                    <label class="block text-sm mx-2" for="baby_weight">
                        <span class="text-gray-700 dark:text-gray-400">Berat (gr)</span>
                        <input type="number" name="baby_weight" id="baby_weight" min="1" value="{{ $pregnancy->baby_weight }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- Panjang Bayi -->
                    <label class="block text-sm mx-2" for="baby_lenght">
                        <span class="text-gray-700 dark:text-gray-400">Panjang (cm)</span>
                        <input type="number" name="baby_lenght" id="baby_lenght" min="1" value="{{ $pregnancy->baby_lenght }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- Lingkar Kepala Bayi -->
                    <label class="block text-sm mx-2" for="baby_head_circumference">
                        <span class="text-gray-700 dark:text-gray-400">Lingkar Kepala (cm)</span>
                        <input type="number" name="baby_head_circumference" id="baby_head_circumference" min="1" value="{{ $pregnancy->baby_head_circumference }}" required class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <!-- Jenis Kelamin Bayi -->
                    <label class="block mx-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Jenis Kelamin
                        </span>
                        <select name="sex_id" id="sex_id" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($sexes as $sex)
                            <option {{ $pregnancy->sex_id == $sex->id ? 'selected' : '' }} value="{{ $sex->id }}">
                                {{ $sex->sex }}
                            </option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="flex flex-wrap">
                    <!-- Kondisi bayi saat lahir -->
                    <div class="mx-1 w-auto mt-4">
                        <x-label for="baby_condition_id" :value="__('Kondisi bayi:')" />
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            @foreach ($baby_conditions as $condition)
                            <label class="inline-flex items-center mx-2">
                                <input class="form-checkbox" type="checkbox" name="baby_condition_id[]" value="{{ $condition->id }}" />
                                <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                            </label> 
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Keterangan Tambahan Bayi</span>
                    <textarea name="baby_additional_information" id="baby_additional_information" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">
                        {{ $pregnancy->baby_additional_information }}
                    </textarea>
                </label>
            </div>
            
            <div class="flex items-center justify-between mt-4">
                <x-button class="ml-4">
                    {{ __('Edit Ringkasan') }}
                </x-button>
            </div>
        </form>
    </div>

</x-app-layout>