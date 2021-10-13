<div x-data="{ nomorkk: 0 }" class="flex flex-col mt-4">
    <div class="mx-2 text-sm">
        <h3>Status saat ini: {{ $person->familyStatus->status }}</h3>
        <h3>Keluarga saat ini: {{ $person->family->leader->name ?? '-' }}</h3>
    </div>
    <div class="flex mt-4">
        <!-- status dalam keluarga -->
        <div class="mx-2">
            <x-label for="family_status_id" :value="__('Keanggotaan Keluarga')" />
            <select x-model="status" x-on:click="nomorkk = status " name="family_status_id" id="family_status_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                <option hidden>Pilih!</option>
                @foreach ($family_statuses as $status)
                <option value="{{ $status->id }}">{{ $status->status }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nomor KK -->
        <div x-show="nomorkk == 1" class="mx-2 items-center">
            <x-label for="nomor_kk" :value="__('Nomor KK')" />
            <input type="text" name="nomor_kk" id="nomor_kk" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nomor KK">
        </div>

        <!-- keluarga sejahtera-->
        <div x-show="nomorkk == 1" class="mx-2">
            <x-label for="keluarga_sejahtera_id" :value="__('Keluarga Sejahtera')" />
            <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                <option  selected disabled hidden>Pilih!</option>
                @foreach ($keluarga_sejahtera as $tahapan)
                <option value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                @endforeach
            </select>
        </div>

        {{-- list kepala keluarga --}}
        <div x-show="nomorkk != 1" class="flex">
            <div class="flex">
                <!-- keluarga -->
                <div class="mx-2 items-center">
                    <x-label for="kepalaKeluarga" :value="__('Keluarga')" />
                    <input type="text" wire:model="family_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Cari Kepala Keluarga">
                </div>

                <div class="mt-8">
                    :
                </div>

                @unless ($family_search_term == null)
                <div class="flex flex-col justify-between mt-8 items-center">
                    @foreach ($families as $family)
                    <div>
                        <label class="inline-flex items-center mx-2">
                            <input class="form-radio" type="radio" name="family_id" value="{{ $family->id }}" />
                            <span class="ml-2">{{ $family->leader->name }} ({{ $family->leader->nik }})</span>
                        </label>                    
                    </div>
                    @endforeach 
                </div>
                @endunless
            </div>
        </div>  
    </div>
    
</div>