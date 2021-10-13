<div class="mt-4">
    <div>
        <x-label for="nomor_kk" :value="__('Kepala Keluarga')" />
        <input type="text" wire:model="searchTerm" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Kepala Keluarga">
    </div>

    @unless ($searchTerm == null)
    <div class="flex flex-col justify-between mt-4">
        @foreach ($kepala_keluarga as $person)
        <div>
            <label class="inline-flex items-center mx-2">
                <input class="form-radio" type="radio" name="person_id" value="{{ $person->id }}" />
                <span class="ml-2">{{ $person->name }} ( {{ $person->nik }} )</span>
            </label>                    
        </div>
        @endforeach 
    </div>
    @endunless
</div>
