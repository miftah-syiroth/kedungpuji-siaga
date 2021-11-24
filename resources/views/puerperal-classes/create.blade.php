<x-app-layout>
    <x-slot name="header">
        {{ __('Input Data Kunjungan Ibu Nifas ') }}
        <a href="/puerperals/{{ $puerperal->id }}" class="text-blue-400 hover:text-blue-700">{{ $puerperal->pregnancy->person->name }}</a>
    </x-slot>

    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif

    <div class="px-4 py-3 mb-8 bg-white shadow-xl rounded-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/puerperals/{{ $puerperal->id }}/periode/{{ $periode }}/puerperal-classes">
            @csrf
            <div class="flex flex-wrap">
                <!-- tanggal kunjungan -->
                <label class="block text-sm mr-2" for="visited_at">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Kunjungan</span>
                    <input type="datetime-local" name="visited_at" id="visited_at" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    <span class="text-sm text-green-800">
                        {{ $waktu_awal->isoFormat('DD MMM YYYY HH:mm') }} - {{ $waktu_akhir->isoFormat('DD MMM YYYY HH:mm') }}
                    </span>
                </label>

                <!-- masalah -->
                <label class="block mx-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Masalah</span>
                    <textarea name="problem" id="problem" value="{{ old('problem') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 border rounded focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="50" rows="5"></textarea>
                </label>
            </div>

            <div class="flex flex-wrap">
                <!-- faskes -->
                <label class="block text-sm" for="faskes">
                    <span class="text-gray-700 dark:text-gray-400">Fasilitas Kesehatan</span>
                    <input type="text" name="faskes" id="faskes" value="{{ old('faskes') }}" required class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="SpOg/Dokter Umum/Bidan"/>
                </label>

                <!-- tindakan -->
                <label class="block mx-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tindakan</span>
                    <textarea name="action" id="action" value="{{ old('action') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 border rounded focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="50" rows="5"></textarea>
                </label>
            </div>
            
            <div class="flex flex-wrap justify-between text-sm">
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Simpan</button>
                <a href="/puerperals/{{ $puerperal->id }}" type="submit" class=" bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Batal</a>
            </div>
        </form>
    </div>
 

</x-app-layout>