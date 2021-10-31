<div class="flex flex-wrap items-center mx-2">
    <label class="block text-sm mr-2" for="name">
        <span class="text-gray-700 dark:text-gray-400">Nama Ibu Kandung</span>
        <input type="text" wire:model="mother_search_term" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
        <small class="text-blue-500">kosongkan jika tidak ada</small>
    </label>

    <div class="texr-gray-700 dark:text-gray-400 font-bold">
        :
    </div>

    @unless ($mother_search_term == null)
        <div class="flex flex-col justify-between">
            @foreach ($mothers as $mother)
            <div>
                <label class="inline-flex items-center mx-2">
                    <input class="form-radio" type="radio" name="mother_id" value="{{ $mother->id }}" />
                    <span class="ml-2">{{ $mother->name }}</span>
                </label>                    
            </div>
            @endforeach 
        </div>
        @endunless
</div>