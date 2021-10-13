<div>
    <div>
        <x-label for="suami" :value="__('Nama Suami')" />
        <input type="text" wire:model="husband_search" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Suami">
    </div>

    @unless ($husband_search == null)
    <div class="flex flex-col justify-between mt-4">
        @foreach ($husbands as $husband)
        <div>
            <label class="inline-flex items-center mx-2">
                <input class="form-radio" type="radio" name="suami_id" value="{{ $husband->id }}" />
                <span class="ml-2">{{ $husband->name }}</span>
            </label>                    
        </div>
        @endforeach 
    </div>
    @endunless
</div>