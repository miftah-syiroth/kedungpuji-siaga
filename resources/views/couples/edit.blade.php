<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Pasangan') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/couples/{{ $couple->id }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-row">
                        <div class="flex flex-col mx-4">
                            <h3 class="text-sm font-medium text-gray-700">
                                Suami Saat ini : <span class="text-gray-900"> {{ $couple->husband->name }}</span>
                            </h3>

                            {{-- pencarian suami --}}
                            @livewire('couples.search-husband')
                        </div>
                        
                        <div class="flex flex-col mx-4">
                            <h3 class="text-sm font-medium text-gray-700">
                                Istri Saat ini : <span class="text-gray-900"> {{ $couple->wife->name }}</span>
                            </h3>

                            {{-- pencarian istri --}}
                            @livewire('couples.search-wife')
                        </div>
                    </div>
                    
                    <div class="m-4 flex justify-between" x-data="{
                        isOpen: false
                    }">
                        <div>
                            <x-label class="mt-4" for="is_still_married" :value="__('Apakah KB?')" />
                            <div class="mt-2 text-sm">
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" isOpen = true" class="form-radio" type="radio" name="is_kb" {{ $couple->is_kb == true ? 'checked' : '' }} value="1" />
                                    <span class="ml-2">Peserta</span>
                                </label>
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" isOpen = false" class="form-radio" type="radio" name="is_kb" {{ $couple->is_kb == false ? 'checked' : '' }} value="0" />
                                    <span class="ml-2">Non Peserta</span>
                                </label>
                            </div>
                        </div>
                        
                        <div x-show="isOpen" class="mt-4">
                            <x-label for="nomor_kk" :value="__('Asal Pelayanan KB')" />
                            <div class="mt-2 text-sm">
                                @foreach ($kb_services as $service)
                                <label class="inline-flex items-center mx-2">
                                    <input class="form-radio" type="radio" name="kb_service_id" value="{{ $service->id }}" />
                                    <span class="ml-2">{{ $service->service }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <x-button class="ml-4">
                            {{ __('Ubah') }}
                        </x-button>
                        <a href="/couples/{{ $couple->id }}" class="px-3 py-2 bg-green-500 hover:bg-green-700 text-sm text-white rounded-md font-semibold uppercase">kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @livewire('couples.couple-create', [
        'kb_services' => $kb_services,
    ]) --}}
</x-app-layout>