<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Keluarga') }}
    </x-slot>

    
    <div class="px-4 flex justify-between items-end py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/families/{{ $family->id }}">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap mt-4">
                <h3 class="text-sm mx-2 font-medium">
                    Kepala Keluarga Saat ini : <span class="text-gray-900 dark:text-gray-200 font-semibold"> {{ $family->leader->name }}</span>
                </h3>
            </div>
            <div class="flex flex-wrap mt-4">
                @livewire('families.leader-search-form')
            </div>

            <div class="flex mt-4">
                <label class="block text-sm mx-2" for="nik">
                    <span class="text-gray-700 dark:text-gray-400">Nomor KK</span>
                    <input type="text" name="nomor_kk" id="nomor_kk" value="{{ $family->nomor_kk }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Tahapan Keluarga Sejahtera
                    </span>
                    <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($keluarga_sejahtera as $key => $tahapan)
                        <option {{ $tahapan->id == $family->keluarga_sejahtera_id ? 'selected' : '' }} value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                        <option  value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            
            <div class="flex flex-row mx-2 my-4 text-sm">
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Edit Keluarga</button>

                <a href="/families/{{ $family->id }}" class="mx-4 bg-blue-600 dark:bg-blue-200 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-blue-800 dark:hover:bg-gray-400">Batal.</a>
            </div>
        </form>

        @can('hapus keluarga')
        <div class="my-4">
            <form action="/families/{{ $family->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-sm dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-red-700 dark:hover:bg-gray-300">Hapus Keluarga</button>
            </form>
        </div>
        @endcan
        
    </div>
</x-app-layout>