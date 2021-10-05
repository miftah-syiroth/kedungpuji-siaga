<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Penduduk') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('people.store') }}">
                    @csrf
    
                    <div class="flex flex-row">
                        <!-- Name -->
                        <div class="mx-2 w-3/5">
                            <x-label for="name" :value="__('Nama Lengkap')" />
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama Lengkap">
                        </div>
    
                        <!-- NIK -->
                        <div class="mx-2 w-2/5">
                            <x-label for="nik" :value="__('NIK')" />
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="NIK">
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
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
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
    
                    <div class="flex mt-2">
    
                        <!-- jenis kelamin -->
                        <div class="mx-2">
                            <x-label for="sex_id" :value="__('Jenis Kelamin')" />
                            <select name="sex_id" id="sex_id" value="{{ old('sex_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($sexes as $sex)
                                <option value="{{ $sex->id }}">{{ $sex->sex }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- Pendidikan -->
                        <div class="mx-2">
                            <x-label for="educational_id" :value="__('Pendidikan')" />
                            <select name="educational_id" id="educational_id" value="{{ old('educational_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($educationals as $educational)
                                <option value="{{ $educational->id }}">{{ $educational->education }}</option>
                                @endforeach
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
                    </div>
    
                    {{-- komponen status perkawinan dan pembuatan keluarga --}}
                    @livewire('people.couple-status-form', [
                        'marital_statuses' => $marital_statuses,
                        'kb_services' => $kb_services,
                    ])
                    {{-- / end komponen status perkawinan dan pembuatan keluarga --}}
                    
                    
                    <div x-data="{ disabilitas: false}" class="flex mt-4">
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
    
                    {{-- keanggotaan keluarga dan form keluarga --}}
                    @livewire('people.family-status-form', [
                        'family_statuses' => $family_statuses,
                        'keluarga_sejahtera' => $keluarga_sejahtera,
                    ])
                    {{-- /end keanggotaan keluarga dan form keluarga --}}
    
                    {{-- form pencarian ibu --}}
                    @livewire('people.search-mother-form')
                    {{-- /end form pencarian ibu --}}
                    
                    {{-- form pencarian ayah kandung --}}
                    @livewire('people.search-father-form')
                    {{-- /end form pencarian ayah kandung --}}
                    
                    <div class="flex items-center justify-between mt-4">
    
                        <div>
                            {{--  --}}
                        </div>
                        <x-button class="ml-4">
                            {{ __('Tambah Keluarga') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>