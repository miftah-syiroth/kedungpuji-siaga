<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Penduduk') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/people/{{ $person->id }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-row">
                        <!-- Name -->
                        <div class="mx-2 w-3/5">
                            <x-label for="name" :value="__('Nama Lengkap')" />
                            <input type="text" name="name" id="name" value="{{ $person->name ?? old('name') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama Lengkap">
                        </div>
    
                        <!-- NIK -->
                        <div class="mx-2 w-2/5">
                            <x-label for="nik" :value="__('NIK')" />
                            <input type="text" name="nik" id="nik" value="{{ $person->nik ?? old('nik') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="NIK">
                        </div>

                        <!-- jenis kelamin -->
                        <div class="mx-2">
                            <x-label for="sex_id" :value="__('Jenis Kelamin')" />
                            <select name="sex_id" id="sex_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($sexes as $sex)
                                <option {{ $sex->id == $person->sex_id ? 'selected' : '' }} value="{{ $sex->id }}">{{ $sex->sex }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div x-data="{ disabilitas: false}" class="flex flex-row mt-2">
                        <!-- tempat lahir -->
                        <div class="mx-2 w-52">
                            <x-label for="place_of_birth" :value="__('Tempat Lahir')" />
                            <input type="text" name="place_of_birth" id="place_of_birth" value="{{ $person->place_of_birth ?? old('place_of_birth') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Kota Lahir">
                        </div>
    
                        <!-- tanggal lahir -->
                        <div class="mx-2 w-44">
                            <x-label for="date_of_birth" :value="__('Tgl Lahir')" />
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $person->date_of_birth->isoFormat('YYYY-MM-DD') ?? old('date_of_birth') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                        </div>
    
                        <!-- Agama -->
                        <div class="mx-2">
                            <x-label for="religion_id" :value="__('Agama')" />
                            <select name="religion_id" id="religion_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($religions as $religion)
                                <option {{ $religion->id == $person->religion_id ? 'selected' : '' }} value="{{ $religion->id }}">{{ $religion->religion }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- golongan darah -->
                        <div class="mx-2">
                            <x-label for="blood_group_id" :value="__('Goldar')" />
                            <select name="blood_group_id" id="blood_group_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($blood_groups as $blood_group)
                                <option {{ $blood_group->id == $person->blood_group_id ? 'selected' : '' }} value="{{ $blood_group->id }}">{{ $blood_group->group }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- apakah cacat -->
                        <div class="mx-2">
                            <x-label for="is_cacat" :value="__('Apakah cacat?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" disabilitas = true " class="form-radio" type="radio" {{ $person->is_cacat == true ? 'checked' : '' }} name="is_cacat" value="1" />
                                    <span class="ml-2 text-sm">Cacat</span>
                                </label> 
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" disabilitas = false " class="form-radio" type="radio" name="is_cacat" value="0" {{ $person->is_cacat == false ? 'checked' : '' }} />
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
                                <option {{ $disability->id == $person->disability_id ? 'selected' : '' }} value="{{ $disability->id }}">{{ $disability->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="flex mt-2">
                        <!-- Pendidikan -->
                        <div class="mx-2">
                            <x-label for="educational_id" :value="__('Pendidikan')" />
                            <select name="educational_id" id="educational_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($educationals as $educational)
                                <option {{ $educational->id == $person->educational_id ? 'selected' : '' }} value="{{ $educational->id }}">{{ $educational->education }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <!-- RT -->
                        <div class="mx-2 w-16">
                            <x-label for="rt" :value="__('RT')" />
                            <input type="number" name="rt" id="rt" value="{{ $person->rt ?? old('rt') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
    
                         <!-- RW -->
                         <div class="mx-2 w-16">
                            <x-label for="rw" :value="__('RW')" />
                            <input type="number" name="rw" id="rw" value="{{ $person->rw ?? old('rw') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- status kawin -->
                        <div class="mx-2">
                            <x-label for="marital_status_id" :value="__('Status Kawin')" />
                            <select name="marital_status_id" id="marital_status_id" value="{{ old('marital_status_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($marital_statuses as $status)
                                <option {{ $status->id == $person->marital_status_id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>

                    <div class="flex mt-4">
                        {{-- form pencarian ibu kandung --}}
                        @livewire('people.search-mother-form')
                        {{-- form pencarian ayah kandung --}}
                        @livewire('people.search-father-form')
                    </div>

                    <div class="flex items-center justify-between mt-4 text-sm">
                        <x-button class="ml-4">
                            {{ __('Ubah Data Personal') }}
                        </x-button>
                    </div>
                </form>

                {{-- <form action="/people/{{ $person->id }}/families" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="border-t-4 mt-4 border-gray-400">
                          @livewire('people.family-status-form', [
                              'person' => $person,
                              'family_statuses' => $family_statuses,
                              'keluarga_sejahtera' => $keluarga_sejahtera,
                          ])
                    </div>
                    <div class="flex items-center justify-between mt-4 text-sm">
                        <x-button class="ml-4">
                            {{ __('Ubah Data Kekeluargaan') }}
                        </x-button>
                    </div>
                </form> --}}
                  
                {{-- @empty($person->died_at) --}}
                <form action="/people/{{ $person->id }}/dead" method="post" class="flex items-center text-sm border-t-4 mt-4 py-4 border-gray-400">
                    @csrf
                    @method('PATCH')
                    <input type="datetime-local" name="died_at" id="died_at" class="w-60 h-8 mx-3 text-sm" required>
                    <x-button class="ml-4">
                        {{ __('Set Meninggal') }}
                    </x-button>
                </form>
                {{-- @endempty --}}
                
            </div>
        </div>
    </div>
</x-app-layout>