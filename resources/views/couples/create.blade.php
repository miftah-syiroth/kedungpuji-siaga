<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pasangan') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('couples.store') }}">
                    @csrf
    
                    {{-- pencarian suami --}}
                    @livewire('couples.search-husband')
                    
                    {{-- pencarian istri --}}
                    @livewire('couples.search-wife')
                    
                    {{-- pilihan KB --}}
                    <div x-data="{isOpen : false}" class="mt-4">
                        <div>
                            <x-label class="mt-4" for="is_kb" :value="__('Apakah KB?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" isOpen = true" class="form-radio" type="radio" name="is_kb" value="1" />
                                    <span class="ml-2">ya</span>
                                </label>
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" isOpen = false" class="form-radio" type="radio" name="is_kb" value="0" />
                                    <span class="ml-2">tidak</span>
                                </label>
                            </div>
                        </div>
        
                        <div x-show="isOpen" class="mt-4">
                            <x-label for="nomor_kk" :value="__('Asal Pelayanan KB')" />
                            <div class="mt-2">
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
                            {{ __('Tambah Pasangan') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @livewire('couples.couple-create', [
        'kb_services' => $kb_services,
    ]) --}}
</x-app-layout>