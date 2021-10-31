<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Keluarga') }}
    </x-slot>
    
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{{ route('families.store') }}" method="post">
            @csrf

            {{-- fourth row --}}
            <div class="flex flex-wrap mt-4">
                {{-- input nama ayah --}}
                @livewire('families.leader-search-form')
            </div>
            {{-- end fourth row --}}    

            <div class="flex mt-4">
                <label class="block text-sm mx-2" for="nik">
                    <span class="text-gray-700 dark:text-gray-400">Nomor KK</span>
                    <input type="text" name="nomor_kk" id="nomor_kk" value="{{ old('nomor_kk') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>

                <label class="block mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Tahapan Keluarga Sejahtera
                    </span>
                    <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option selected disabled hidden>Pilih!</option>
                        @foreach ($keluarga_sejahtera as $key => $tahapan)
                        <option value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Tambah Keluarga</button>
            </div>
        </form>
    </div>
</x-app-layout>