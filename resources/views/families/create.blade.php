<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Keluarga') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-start">
            <div x-data="{ person: ''}" class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('families.store') }}">
                    @csrf
                    <!-- kompone pencarian kepala keluarga dari tabel penduduk -->
                    @livewire('families.search-family-leader-form')
                    {{-- end komponen --}}
                    
                     <!-- No KK -->
                     <div class="mt-4">
                        <x-label for="nomor_kk" :value="__('Nomor KK')" />
                        <x-input id="nomor_kk" class="block mt-1 w-full" type="text" name="nomor_kk" :value="old('nomor_kk')" required autofocus />
                    </div>
                    
                    <div class="flex items-center justify-between mt-4">
    
                        <div>
    
                            <label class="inline-flex items-center mx-2 text-sm">
                                <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" class="text-sm">
                                    <option hidden value="">Pilih Status Keluarga!</option>
                                    @foreach ($keluarga_sejahtera as $key => $tahapan)
                                    <option value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                                    @endforeach
                                </select>
                                <span class="ml-2"></span>
                            </label>
                        </div>
                        <x-button class="ml-4">
                            {{ __('Tambah Keluarga') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @livewire('families.family-create', [
        'keluarga_sejahtera' => $keluarga_sejahtera,
    ]) --}}
</x-app-layout>