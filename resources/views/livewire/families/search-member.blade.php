<div x-data="{ person: '' }" class="flex">
    <div class="mx-2 items-center">
        <x-label for="person" :value="__('Nama Penduduk')" />
        <input x-model="person" type="text" wire:model="person_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Cari Anggota Keluarga">
    </div>

    <div class="mt-8">
        : 
    </div>

    <div>
        @unless ($person_search_term == null)
        <div class="flex flex-col justify-between mt-8">
            @foreach ($people as $person)
            <div>
                <label class="inline-flex items-center mx-2">
                    <input x-on:click=" person = '{{ $person->name }}'" class="form-radio" type="radio" name="person_id" value="{{ $person->id }}" />
                    <span class="ml-2">{{ $person->name }} ({{ $person->nik }})</span>
                </label>                    
            </div>
            @endforeach 
        </div>
        @endunless
    </div>
</div>