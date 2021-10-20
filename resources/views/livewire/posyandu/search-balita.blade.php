<div class="mt-4">
    <div>
        <x-label for="person_id" :value="__('Balita')" />
        <input type="text" wire:model="searchTerm" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Balita">
    </div>

    @unless ($searchTerm == null)
    <div class="flex flex-col justify-between mt-4">
        @foreach ($balita as $person)
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
