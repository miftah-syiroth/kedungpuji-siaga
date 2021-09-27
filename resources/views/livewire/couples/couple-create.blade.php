<div class="py-4">
    <div class="flex justify-center">
        <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('couples.store') }}">
                @csrf

                {{-- pencarian suami --}}
                <div x-data="{suami: ''}">
                    <div>
                        <x-label for="suami" :value="__('Nama Suami')" />
                        <input x-model="suami" type="text" wire:model="husband_search" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Suami">
                    </div>

                    @unless ($husband_search == null)
                    <div class="flex flex-col justify-between mt-4">
                        @foreach ($husbands as $husband)
                        <div>
                            <label class="inline-flex items-center mx-2">
                                <input x-on:click=" suami = '{{ $husband->name }}'" class="form-radio" type="radio" name="suami_id" value="{{ $husband->id }}" />
                                <span class="ml-2">{{ $husband->name }}</span>
                            </label>                    
                        </div>
                        @endforeach 
                    </div>
                    @endunless
                </div>
                
                {{-- pencarian istri --}}
                <div x-data="{istri: ''}" class="mt-4">
                    <div class="mt-4">
                        <x-label for="wife" :value="__('Nama Istri')" />
                        <input x-model="istri" type="text" wire:model="wife_search" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Nama Istri">
                    </div>
    
                    @unless ($wife_search == null)
                    <div class="flex flex-col justify-between mt-4">
                        @foreach ($wifes as $wife)
                        <div>
                            <label class="inline-flex items-center mx-2">
                                <input x-on:click=" istri = '{{ $wife->name }}' " class="form-radio" type="radio" name="istri_id" value="{{ $wife->id }}" />
                                <span class="ml-2">{{ $wife->name }}</span>
                            </label>                    
                        </div>
                        @endforeach 
                    </div>
                    @endunless
                </div>
                
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