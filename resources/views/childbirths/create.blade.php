<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Kelahiran') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/childbirths/{{ $pregnancy->id }}">
                    @csrf
                    
                    <p class="mx-2 mb-4 text-sm text-green-900 font-semibold">Catatan: Ubah ringkasan pelayanan persalinan jika data statis tidak sesuai</p>

                    <div class="flex flex-row">
                        <!-- Name -->
                        <div class="mx-2">
                            <x-label for="name" :value="__('Nama Lengkap')" />
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama Lengkap">
                        </div>
    
                        <!-- NIK -->
                        <div class="mx-2">
                            <x-label for="nik" :value="__('NIK')" />
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="NIK">
                        </div>

                        <!-- jenis kelamin -->
                        <div class="mx-2">
                            <x-label for="sex_id" :value="__('Jenis Kelamin')" />
                            <select disabled class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected>{{ $pregnancy->sex->sex }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="flex flex-row mt-2">
                        <!-- tempat lahir -->
                        <div class="mx-2 w-52">
                            <x-label for="place_of_birth" :value="__('Tempat Lahir')" />
                            <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Kota Lahir">
                        </div>
    
                        <!-- tanggal lahir -->
                        <div class="mx-2 w-44">
                            <x-label for="date_of_birth" :value="__('Tgl Lahir')" />
                            <input type="date" disabled value="{{ $pregnancy->childbirth_date->isoFormat('YYYY-MM-DD') }}" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                        </div>
    
                        <!-- Agama -->
                        <div class="mx-2">
                            <x-label for="religion_id" :value="__('Agama')" />
                            <select name="religion_id" id="religion_id" value="{{ old('religion_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($religions as $religion)
                                <option value="{{ $religion->id }}">{{ $religion->religion }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- golongan darah -->
                        <div class="mx-2">
                            <x-label for="blood_group_id" :value="__('Goldar')" />
                            <select name="blood_group_id" id="blood_group_id" value="{{ old('blood_group_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($blood_groups as $blood_group)
                                <option value="{{ $blood_group->id }}">{{ $blood_group->group }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div x-data="{ disabilitas: false}" class="flex mt-2">
                        <!-- Pendidikan -->
                        <div class="mx-2">
                            <x-label for="educational_id" :value="__('Pendidikan')" />
                            <select disabled class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected>Tidak/Belum Sekolah</option>
                            </select>
                        </div>
    
                        <!-- RT -->
                        <div class="mx-2 w-16">
                            <x-label for="rt" :value="__('RT')" />
                            <input type="number" name="rt" id="rt" value="{{ old('rt') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
    
                         <!-- RW -->
                         <div class="mx-2 w-16">
                            <x-label for="rw" :value="__('RW')" />
                            <input type="number" name="rw" id="rw" value="{{ old('rw') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- status kawin -->
                        <div class="mx-2">
                            <x-label for="marital_status_id" :value="__('Status Kawin')" />
                            <select disabled class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Belum Kawin</option>
                            </select>
                        </div>

                        <!-- apakah cacat -->
                        <div class="mx-2">
                            <x-label for="is_cacat" :value="__('Apakah cacat?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" disabilitas = true " class="form-radio" type="radio" name="is_cacat" value="1" />
                                    <span class="ml-2 text-sm">Cacat</span>
                                </label> 
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" disabilitas = false " class="form-radio" type="radio" name="is_cacat" value="0" />
                                    <span class="ml-2 text-sm">Tidak</span>
                                </label> 
                            </div>
                        </div>
    
                        <!-- list cacat -->
                        <div x-show="disabilitas" class="mx-2">
                            <x-label for="disability_id" :value="__('Disabilitas')" />
                            <select name="disability_id" id="disability_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($disabilities as $disability)
                                <option value="{{ $disability->id }}">{{ $disability->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex mt-4">
                        <!-- Ibu Kandung -->
                        <div class="mx-2">
                            <x-label for="name" :value="__('Ibu Kandung')" />
                            <input type="text" value="{{ $pregnancy->mother->name }}" disabled class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                        </div>
                        {{-- form pencarian ayah kandung --}}
                        @livewire('people.search-father-form')
                    </div>
                    
                    <div class="flex items-center justify-between mt-4">
                        <x-button class="ml-4">
                            {{ __('Tambah Kelahiran') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>