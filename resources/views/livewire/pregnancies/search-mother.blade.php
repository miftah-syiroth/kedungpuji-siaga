<div class="flex">
    <!-- ibu kandung -->
    <div class="mr-2 items-center">
        <x-label :value="__('Ibu')" />
        <input type="text" wire:model="mother_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
    </div>

    <div class="mt-8">
        :
    </div>

    @unless ($mother_search_term == null)
    <div class="flex flex-col justify-between mt-8">
        @foreach ($mothers as $mother)
        <div>
            <label class="inline-flex items-center mx-2">
                <input class="form-radio" type="radio" name="mother_id" value="{{ $mother->id }}" />
                <span class="ml-2 text-sm">{{ $mother->name }}</span>
            </label>                    
        </div>
        @endforeach 
    </div>
    @endunless
</div>  