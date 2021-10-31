<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pasangan') }}
    </x-slot>
    
    <div class="flex px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('couples.store') }}">
            @csrf

            <div class="flex flex-wrap mt-4">
                @livewire('couples.search-husband')
            </div>

            <div class="flex flex-wrap mt-4">
                @livewire('couples.search-wife')
            </div>

            <div x-data="{isOpen : false}" class="flex flex-col mt-4">
                <div class="mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Apakah KB?
                    </span>
                    <div class="mt-2">
                        <label x-on:click=" isOpen = true" class="mx-2 inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_kb" value="1" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">KB</span>
                        </label>
                        <label x-on:click=" isOpen = false" class="mx-2 inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_kb" value="0" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">Tidak KB</span>
                        </label>
                    </div>
                </div>

                <div x-show="isOpen" class="mx-2 mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Asal Pelayanan KB
                    </span>
                    <div class="mt-2">
                        @foreach ($kb_services as $service)
                        <label class="mx-2 inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="kb_service_id" value="{{ $service->id }}" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">{{ $service->service }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Tambah Pasangan</button>
            </div>
        </form>
    </div>
</x-app-layout>