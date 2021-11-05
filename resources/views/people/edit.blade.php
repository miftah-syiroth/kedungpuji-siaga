<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Penduduk') }}
    </x-slot>
    
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="/people/{{ $person->id }}" method="post">
            @csrf
            @method('PUT')
            <h3 class="mx-2 my-4 bg-gray-200 text-center rounded-lg text-sm font-semibold">Data Personal</h3>
            {{-- first row --}}
            <div class="flex flex-wrap">
                <label class="block text-sm mr-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                    <input type="text" name="name" id="name" value="{{ $person->name }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap"/>
                </label>

                <label class="block text-sm mx-2" for="nik">
                    <span class="text-gray-700 dark:text-gray-400">NIK</span>
                    <input type="text" name="nik" id="nik" value="{{ $person->nik }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="NIK"/>
                </label>

                <div class="mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Jenis Kelamin
                    </span>
                    <div class="mt-2">
                        @foreach ($sexes as $sex)
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" {{ $person->sex_id == $sex->id ? 'checked' : '' }} name="sex_id" id="sex_id" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" value="{{ $sex->id }}"/>
                            <span class="ml-2">{{ $sex->sex }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- first row --}}
            
            {{-- second row --}}
            <div x-data="{ disabilitas: false}" class="flex flex-wrap mt-4">
                <label class="block text-sm mr-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Tempat Lahir</span>
                    <input type="text" name="place_of_birth" id="place_of_birth" value="{{ $person->place_of_birth }}" required class="block w-40 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <label class="block text-sm mx-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Lahir</span>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $person->date_of_birth->isoFormat('YYYY-MM-DD') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap"/>
                </label>

                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Agama
                    </span>
                    <select name="religion_id" id="religion_id" value="{{ old('religion_id') }}" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($religions as $religion)
                        <option {{ $religion->id == $person->religion_id ? 'selected' : '' }} value="{{ $religion->id }}">{{ $religion->religion }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Gol. Darah
                    </span>
                    <select name="blood_group_id" id="blood_group_id" value="{{ old('blood_group_id') }}" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($blood_groups as $group)
                        <option {{ $group->id == $person->blood_group_id ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->group }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Apakah Cacat?
                    </span>
                    <div class="mt-2">
                        <label x-on:click=" disabilitas = true " class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" {{ $person->is_cacat == true ? 'checked' : '' }} name="is_cacat" value="1" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Cacat</span>
                        </label>
                        <label x-on:click=" disabilitas = false " class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_cacat" value="0" {{ $person->is_cacat == false ? 'checked' : '' }} class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Tidak</span>
                        </label>
                    </div>
                </div>

                {{-- list cacat --}}
                <label x-show="disabilitas" class="block mx-2 text-sm" for="disability">
                    <span class="text-gray-700 dark:text-gray-400">
                        Jenis
                    </span>
                    <select name="disability_id" id="disability_id" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($disabilities as $disability)
                        <option {{ $disability->id == $person->disability_id ? 'selected' : '' }} value="{{ $disability->id }}">{{ $disability->disability }}</option>
                        @endforeach
                    </select>
                </label>
                {{-- end list cacat --}}
            </div>
            {{-- end second row --}}

            {{-- third row --}}
            <div class="flex flex-wrap mt-4">
                <label class="block mr-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Pendidikan
                    </span>
                    <select name="educational_id" id="educational_id" value="{{ old('educational_id') }}" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($educationals as $educational)
                        <option {{ $educational->id == $person->educational_id ? 'selected' : '' }} value="{{ $educational->id }}">{{ $educational->education }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block text-sm mx-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">RW</span>
                    <input type="number" name="rw" id="rw" value="{{ $person->rw }}" required class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <label class="block text-sm mx-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">RT</span>
                    <input type="number" name="rt" id="rt" value="{{ $person->rt }}" required class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Status Kawin
                    </span>
                    <select name="marital_status_id" id="marital_status_id" value="{{ old('marital_status_id') }}" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($marital_statuses as $status)
                        <option {{ $status->id == $person->marital_status_id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            {{-- end third row --}}
        
            {{-- fourth row --}}
            <div class="flex flex-wrap mt-4">
                {{-- input nama ayah --}}
                @livewire('people.father-search-form')
                {{-- input nama ibu --}}
                @livewire('people.mother-search-form')
            </div>
            {{-- end fourth row --}}    

            <h3 class="mx-2 my-4 bg-gray-200 text-center rounded-lg text-sm font-semibold">Kepindahan dan Kematian</h3>

            <div x-data="{ dead: {{ $person->is_alive == false ? 'true' : 'false' }}}" class="flex flex-wrap mt-4">
                <div class="mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Domisili
                    </span>
                    <div class="mt-2 mx-2">
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" {{ $person->village_id == 1 ? 'checked' : '' }} name="village_id" id="village_id" value="1" class="focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <span class="ml-2">Warga Kedungpuji</span>
                        </label>
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400 mx-2">
                            <input type="radio" {{ $person->village_id == 2 ? 'checked' : '' }} name="village_id" id="village_id" value="2" class="focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <span class="ml-2">Pindah</span>
                        </label>
                    </div>
                </div>

                <div class="ml-8 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Apakah Hidup?
                    </span>
                    <div class="mt-2">
                        <label x-on:click=" dead = false " class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" {{ $person->is_alive == true ? 'checked' : '' }} name="is_alive" value="1" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Hidp</span>
                        </label>
                        <label x-on:click=" dead = true " class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_alive" value="0" {{ $person->is_alive == false ? 'checked' : '' }} class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Mati</span>
                        </label>
                    </div>
                </div>

                <label x-show="dead" class="block text-sm mx-6 w-64" for="died_at">
                    <span class="text-gray-700 dark:text-gray-400">Waktu Kematian</span>
                    <input type="date" name="died_at" id="died_at" value="{{ $person->died_at ? $person->died_at->isoFormat('YYYY-MM-DD') : old('died_at') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
            
            <div class="flex flex-wrap justify-between text-sm">
                <div>
                    <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Ubah Data Penduduk</button>
                    <a href="/people/{{ $person->id }}" type="submit" class=" bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Batal Ubah</a>
                </div>
                
            </div>
        </form>
        <form action="/people/{{ $person->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="text-sm flex justify-end">
                <button type="submit" class="bg-red-500 dark:bg-red-800 text-white dark:text-gray-200 py-2 px-3 rounded-md hover:bg-red-700 dark:hover:bg-red-900 mx-2 my-4">Hapus Individu</button>
            </div>
        </form>
    </div>
</x-app-layout>