<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Pasangan') }}
    </x-slot>
    
    <div class="px-4 flex justify-between items-end py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/couples/{{ $couple->id }}">
            @csrf
            @method('PUT')

            {{-- <div class="flex flex-col flex-wrap mt-4">
                @livewire('couples.search-husband')
                <h3 class="text-sm font-medium text-green-900 dark:text-gray-300 mx-2">
                    Suami Saat ini : <span class="font-semibold"> {{ $couple->husband->name }}</span>
                </h3>
            </div> --}}

            {{-- <div class="flex flex-col flex-wrap mt-4">
                @livewire('couples.search-wife')
                <h3 class="text-sm font-medium text-green-900 dark:text-gray-300 mx-2">
                    Istri Saat ini : <span class="font-semibold"> {{ $couple->wife->name }}</span>
                </h3>
            </div> --}}

            <div x-data="{isOpen : {{ $couple->is_kb == true ? 'true' : 'false' }}}" class="flex flex-col mt-4">
                <div class="mx-2 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Apakah KB?
                    </span>
                    <div class="mt-2">
                        <label x-on:click=" isOpen = true" class="mx-2 inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_kb" {{ $couple->is_kb == true ? 'checked' : '' }} value="1" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">KB</span>
                        </label>
                        <label x-on:click=" isOpen = false" class="mx-2 inline-flex items-center text-gray-600 dark:text-gray-400">
                            <input type="radio" name="is_kb" {{ $couple->is_kb == false ? 'checked' : '' }} value="0" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
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
                            <input type="radio" name="kb_service_id" {{ $couple->kb_service_id == $service->id ? 'checked' : '' }} value="{{ $service->id }}" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                            <span class="ml-2">{{ $service->service }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="flex flex-row mx-2 my-4 text-sm">
                <button type="submit" class="uppercase bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Edit Pasangan</button>
                <a href="/couples/{{ $couple->id }}" class="px-3 py-2 mx-4 bg-green-500 hover:bg-green-700 text-sm text-white rounded-md font-semibold uppercase">kembali</a>
            </div>
        </form>
        <div class="my-4">
            <form action="/couples/{{ $couple->id }}" method="post">
                @csrf
                @method('DELETE')
                <select name="marital_status_id" id="marital_status_id" required class="w-auto mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option hidden>pilih status!</option>
                    @foreach ($cerai_statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                    @endforeach
                </select>
                
                <button type="submit" class="bg-red-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-red-700">cerai/hapus</button>
            </form>
        </div>
    </div>
</x-app-layout>