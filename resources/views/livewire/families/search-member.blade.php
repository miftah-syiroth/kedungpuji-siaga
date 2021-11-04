<div class="flex flex-wrap items-center mr-2">
    <label class="block text-sm mr-2" for="name">
        <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
        <input type="text" wire:model="person_search_term" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
    </label>

    <div class="texr-gray-700 dark:text-gray-400 font-bold">
        :
    </div>

    @unless ($person_search_term == null)
    <div class="flex flex-col text-sm self-end">
        @foreach ($people as $person)
        <div>
            <label class="inline-flex items-center mx-2">
                <input class="form-radio" type="radio" name="person_id" value="{{ $person->id }}" />
                <span class="ml-2">{{ $person->name }} ({{ $person->nik }})</span>
            </label>                    
        </div>
        @endforeach 
    </div>
    @endunless
</div>