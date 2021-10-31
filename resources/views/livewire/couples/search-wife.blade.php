<div class="flex items-center mx-2">
    <label class="block text-sm mr-2" for="name">
        <span class="text-gray-700 dark:text-gray-400">Nama Istri</span>
        <input type="text" wire:model="wife_search" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
    </label>

    @unless ($wife_search == null)
    <div class="flex flex-col justify-between my-2">
        @foreach ($wifes as $wife)
        <div>
            <label class="inline-flex items-center mx-2">
                <input class="form-radio" type="radio" name="wife_id" value="{{ $wife->id }}" />
                <span class="ml-2">{{ $wife->name }} ({{ $wife->nik }})</span>
            </label>                    
        </div>
        @endforeach 
    </div>
    @endunless
</div>