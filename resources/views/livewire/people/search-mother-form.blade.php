{{-- <div class="flex mt-4"> --}}

    <div class="flex">
        <!-- ibu kandung -->
        <div class="mx-2 items-center">
            <x-label :value="__('Ibu Kandung')" />
            <input type="text" wire:model="mother_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
            <small class="text-blue-500">kosongkan jika tidak ada</small>
        </div>

        <div class="mt-8">
            :
        </div>

        @unless ($mother_search_term == null)
        <div class="flex flex-col justify-between mt-8">
            @foreach ($mothers as $mother)
            <div>
                <label class="inline-flex items-center mx-2">
                    <input class="form-radio" type="radio" name="ibu_id" value="{{ $mother->id }}" />
                    <span class="ml-2">{{ $mother->name }}</span>
                </label>                    
            </div>
            @endforeach 
        </div>
        @endunless
    </div>  
{{-- </div> --}}