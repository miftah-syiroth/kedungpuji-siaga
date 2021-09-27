<div class="py-4">
    <div class="flex justify-center">
        <div x-data="{ person: ''}" class="px-6 py-6 bg-white rounded-lg shadow-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('families.store') }}">
                @csrf
                <!-- Name -->
                <div>
                    <x-label for="nomor_kk" :value="__('Kepala Keluarga')" />
                    <input x-model="person" type="text" wire:model="searchTerm" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Kepala Keluarga">
                </div>

                @unless ($searchTerm == null)
                <div class="flex flex-col justify-between mt-4">
                    @foreach ($kepala_keluarga as $person)
                    <div>
                        <label class="inline-flex items-center mx-2">
                            <input x-on:click=" person = '{{ $person->name }}'" class="form-radio" type="radio" name="person_id" value="{{ $person->id }}" />
                            <span class="ml-2">{{ $person->name . ',' . $person->family_status_id }}</span>
                        </label>                    
                    </div>
                    @endforeach 
                </div>
                @endunless
                
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