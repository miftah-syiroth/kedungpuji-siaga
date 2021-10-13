<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Keluarga') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-3 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/families/{{ $family->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="flex flex-col">
                        <h3 class="text-sm font-medium text-gray-700">
                            Kepala Keluarga Saat ini : <span class="text-gray-900"> {{ $family->leader->name }}</span>
                        </h3>

                        <!-- kompone pencarian kepala keluarga dari tabel penduduk -->
                        @livewire('families.search-family-leader-form')
                        {{-- end komponen --}}

                        <div class="flex flex-row mt-4">
                            <!-- Nomor KK -->
                            <div class="w-1/2">
                                <x-label for="nomor_kk" :value="__('Nomor KK')" />
                                <input type="text" name="nomor_kk" id="nomor_kk" value="{{ $family->nomor_kk }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nomor KK">
                            </div>
        
                            <!-- NIK -->
                            <!-- jenis kelamin -->
                            <div class="mx-2">
                                <x-label for="keluarga_sejahtera_id" :value="__('Keluarga Sejahtera')" />
                                <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                    <option selected disabled hidden>Pilih!</option>
                                    @foreach ($keluarga_sejahtera as $tahapan)
                                    <option {{ $tahapan->id == $family->keluarga_sejahtera_id ? 'selected' : '' }} value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <form action="/families/{{ $family->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <x-button class="bg-red-500 hover:bg-red-700">
                                    {{ __('Hapus Keluarga') }}
                                </x-button>
                            </form>
                        </div>
                        <div>
                            <a href="/families/{{ $family->id }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">batal</a>
                            <x-button class="ml-2">
                                {{ __('Edit Keluarga') }}
                            </x-button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>