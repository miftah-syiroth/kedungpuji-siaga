<div>
    <div>
        <x-label for="wife" :value="__('Nama Istri')" />
        <input type="text" wire:model="wife_search" class="block text-sm mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Istri">
    </div>

    @unless ($wife_search == null)
    <div class="flex flex-col justify-between mt-4">
        @foreach ($wifes as $wife)
        <div>
            <label class="inline-flex items-center mx-2">
                <input class="form-radio" type="radio" name="istri_id" value="{{ $wife->id }}" />
                <span class="ml-2">{{ $wife->name }}</span>
            </label>                    
        </div>
        @endforeach 
    </div>
    @endunless
</div>