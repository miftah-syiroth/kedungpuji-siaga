<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Kelahiran') }}
    </x-slot>
    
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/people/childbirths/{{ $childbirth->id }}">
            @csrf
            
            <p class="mx-2 mb-4 text-sm text-red-500 font-semibold">Catatan: Ubah ringkasan pelayanan persalinan jika data statis tidak sesuai</p>

            <div class="flex flex-row flex-wrap">
                <!-- Name -->
                <label class="block text-sm mr-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap"/>
                </label>

                <!-- NIK -->
                <label class="block text-sm mx-2" for="nik">
                    <span class="text-gray-700 dark:text-gray-400">NIK</span>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="NIK"/>
                </label>

                <!-- jenis kelamin -->
                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Jenis Kelamin
                    </span>
                    <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>{{ $childbirth->sex->sex }}</option>
                    </select>
                </label>
            </div>

            <div x-data="{ disabilitas: false}" class="flex flex-wrap mt-4">
                <!-- tempat lahir -->
                <label class="block text-sm mr-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Tempat Lahir</span>
                    <input type="text" name="place_of_birth" id="place_of_birth" value="Kebumen" class="block w-32 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- tanggal lahir -->
                <label class="block text-sm mx-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Lahir</span>
                    <input type="date" value="{{ $childbirth->pregnancy->childbirth_date->isoFormat('YYYY-MM-DD') }}" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- Agama -->
                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Agama
                    </span>
                    <select name="religion_id" id="religion_id" value="{{ old('religion_id') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($religions as $religion)
                        <option value="{{ $religion->id }}">{{ $religion->religion }}</option>
                        @endforeach
                    </select>
                </label>

                <!-- golongan darah -->
                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Gol. Darah
                    </span>
                    <select name="blood_group_id" id="blood_group_id" value="{{ old('blood_group_id') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($blood_groups as $group)
                        <option value="{{ $group->id }}">{{ $group->group }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Apakah Cacat?
                    </span>
                    <div class="mt-2">
                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input x-on:click=" disabilitas = true " type="radio" name="is_cacat" value="1" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Cacat</span>
                        </label>
                        <label x-on:click=" disabilitas = false " class="inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_cacat" value="0" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Tidak</span>
                        </label>
                    </div>
                </div>

                <label x-show="disabilitas" class="block mx-2 text-sm" for="disability">
                    <span class="text-gray-700 dark:text-gray-400">
                        Jenis
                    </span>
                    <select name="disability_id" id="disability_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($disabilities as $disability)
                        <option value="{{ $disability->id }}">{{ $disability->disability }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="flex flex-wrap mt-4">
                <!-- Pendidikan -->
                <label class="block mr-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Pendidikan
                    </span>
                    <select disabled class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Tidak/Belum Sekolah</option>
                    </select>
                </label>

                <!-- RW -->
                <label class="block text-sm mx-2" for="rw">
                    <span class="text-gray-700 dark:text-gray-400">RW</span>
                    <input type="number" name="rw" id="rw" value="{{ $childbirth->pregnancy->person->rw }}" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <label class="block text-sm mx-2" for="rt">
                    <span class="text-gray-700 dark:text-gray-400">RT</span>
                    <input type="number" name="rt" id="rt" value="{{ $childbirth->pregnancy->person->rt }}" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <!-- status kawin -->
                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Status Kawin
                    </span>
                    <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Belum Kawin!</option>
                    </select>
                </label>
            </div>

            <div class="flex flex-wrap mt-4">
                <!-- Ibu Kandung -->
                <label class="block text-sm mr-2" for="name">
                    <span class="text-gray-700 dark:text-gray-400">Ibu Kandung</span>
                    <input type="text"  value="{{ $childbirth->pregnancy->person->name }}" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                </label>
                {{-- form pencarian ayah kandung --}}
                @livewire('people.father-search-form')
            </div>
            
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Tambah Kelahiran</button>
            </div>
        </form>
    </div>
</x-app-layout>