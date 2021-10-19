<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Ringkasan Pelayanan Persalinan: ') }}
        <a href="/pregnancies/{{ $pregnancy->id }}" class="text-blue-400 hover:text-blue-700">{{ $pregnancy->mother->name }}</a>
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/pregnancies/{{ $pregnancy->id }}">
                    @csrf
                    @method('PUT')
                    <div class="border border-b-0 p-2">
                        <h3 class="text-center font-semibold text-gray-600 mb-4">Data Awal Kehamilan</h3>
                        <div class="flex flex-row">
                            <!-- hpht -->
                            <div class="mx-1">
                                <x-label for="hpht" :value="__('HPHT')" />
                                <input type="date" name="hpht" id="hpht" value="{{ $pregnancy->hpht->isoFormat('YYYY-MM-DD') }}" class="block mt-1 w-40 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
        
                            <!-- bb ibu -->
                            <div class="mx-1 w-auto">
                                <x-label for="mother_weight" :value="__('BB Ibu (kg)')" />
                                <input type="number" name="mother_weight" id="mother_weight" min="1" value="{{ $pregnancy->mother_weight }}" class="block mt-1 w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- tb ibu -->
                            <div class="mx-1">
                                <x-label for="mother_height" :value="__('TB Ibu (cm)')" />
                                <input type="number" name="mother_height" id="mother_height" min="1" value="{{ $pregnancy->mother_height }}" class="block mt-1 w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
                        </div> 
                    </div>
                    
    
                    <div class="p-2">
                        <h3 class="text-center font-semibold text-gray-600 mb-4">Ringkasan Ibu</h3>
                        <div class="flex flex-row">
                            <!-- tanggal persalinan -->
                            <div class="mx-1 w-auto">
                                <x-label for="childbirth_date" :value="__('Waktu Persalinan')" />
                                <input type="datetime-local" name="childbirth_date" id="childbirth_date" value="{{ $pregnancy->childbirth_date->isoFormat('YYYY-MM-DDThh:mm') }}" class="block mt-1 w-60 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>
        
                            <!-- penolong persalinan -->
                            <div class="mx-1 auto">
                                <x-label for="childbirth_attendant" :value="__('Penolong Persalinan')" />
                                <input type="text" name="childbirth_attendant" id="childbirth_attendant" value="{{ $pregnancy->childbirth_attendant }}" class="block mt-1 w-48 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="SpOg/Dokter Umum/Bidan">
                            </div>

                            <!-- cara persalinan -->
                            <div class="mx-1 auto">
                                <x-label for="childbirth_method" :value="__('Metode Persalinan')" />
                                <input type="text" name="childbirth_method" id="childbirth_method" value="{{ $pregnancy->childbirth_method }}" class="block mt-1 w-48 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Normal/Tindakan ...">
                            </div>

                            <!-- keadaan ibu pasca melahirkan -->
                            <div class="mx-1 auto">
                                <x-label for="post_partum_condition" :value="__('Kondisi Pasca Melahirkan')" />
                                <input type="text" name="post_partum_condition" id="post_partum_condition" value="{{ $pregnancy->post_partum_condition }}" class="block mt-1 w-48 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="sehat/sakit/meninggal ...">
                            </div>
                        </div>
                        <!-- Informasi Tambahan -->
                        <div class="mx-1 w-auto mt-4">
                            <x-label for="mother_additional_information" :value="__('Keterangan Tambahan')" />
                            <textarea name="mother_additional_information" id="mother_additional_information" cols="70" rows="2" class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">{{ $pregnancy->additional_information }}</textarea>
                        </div>
                    </div>
                    
                    <div class="p-2">
                        <h3 class="text-center font-semibold text-gray-600 mb-4">Ringkasan Anak</h3>
                        <div class="flex flex-row">
                            <!-- Kelahiran ke -->
                            <div class="mx-1 w-auto">
                                <x-label for="childbirth_order" :value="__('Kelahiran Ke')" />
                                <input type="number" value="{{ $pregnancy->childbirth_order }}" name="childbirth_order" id="childbirth_order" min="1" class="block mt-1 w-16 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- Berat Bayi -->
                            <div class="mx-1 w-auto">
                                <x-label for="baby_weight" :value="__('Berat (gr)')" />
                                <input type="number" value="{{ $pregnancy->baby_weight }}" name="baby_weight" id="baby_weight" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- Panjang Bayi -->
                            <div class="mx-1 w-auto">
                                <x-label for="baby_lenght" :value="__('Panjang (cm)')" />
                                <input type="number" value="{{ $pregnancy->baby_lenght }}" name="baby_lenght" id="baby_lenght" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- Lingkar Kepala Bayi -->
                            <div class="mx-1 w-auto">
                                <x-label for="baby_head_circumference" :value="__('Lingkar Kepala (cm)')" />
                                <input type="number" value="{{ $pregnancy->baby_head_circumference }}" name="baby_head_circumference" id="baby_head_circumference" min="1" class="block mt-1 w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- Jenis Kelamin Bayi -->
                            <div class="mx-1 w-auto">
                                <x-label for="sex_id" :value="__('Jenis Kelamin (cm)')" />
                                <select name="sex_id" id="sex_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                    <option selected disabled hidden>Pilih!</option>
                                    @foreach ($sexes as $sex)
                                    <option {{ $pregnancy->sex_id == $sex->id ? 'selected' : '' }} value="{{ $sex->id }}">{{ $sex->sex }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-row">
                             <!-- Kondisi bayi saat lahir -->
                             <div class="mx-1 w-auto mt-4">
                                <x-label for="baby_condition_id" :value="__('Kondisi bayi:')" />
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach ($baby_conditions as $condition)
                                    <label class="inline-flex items-center mx-2">
                                        <input class="form-radio" type="checkbox" name="baby_condition_id[]" value="{{ $condition->id }}" />
                                        <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                                    </label> 
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex">
                            

                            <!-- Informasi Tambahan -->
                            <div class="mx-1 w-auto mt-4">
                                <x-label for="baby_additional_information" :value="__('Keterangan Tambahan Bayi')" />
                                <textarea name="baby_additional_information" id="baby_additional_information" cols="50" rows="2" class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">{{ $pregnancy->baby_additional_information }}</textarea>
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