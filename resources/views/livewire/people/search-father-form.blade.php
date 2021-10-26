{{-- <div class="mt-4"> --}}
    <div class="flex">
        <!-- ayah kandung -->
        <div class="mx-2 items-center">
            <x-label for="ayah_id" :value="__('Ayah Kandung')" />
            <input type="text" wire:model="father_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
            <small class="text-blue-500">kosongkan jika ayah adalah suami ibu atau tidak ada</small>
        </div>

        <div class="mt-8">
            :
        </div>

        @unless ($father_search_term == null)
        <div class="flex flex-col justify-between mt-8">
            @foreach ($fathers as $father)
            <div>
                <label class="inline-flex items-center mx-2">
                    <input class="form-radio" type="radio" name="ayah_id" value="{{ $father->id }}" />
                    <span class="ml-2">{{ $father->name }}</span>
                </label>                    
            </div>
            @endforeach 
        </div>
        @endunless
    </div>
{{-- </div> --}}