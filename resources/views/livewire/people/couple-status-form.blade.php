<div x-data="{  coupleForm : 0, kbForm : false }" class="flex flex-col">
    <div class="flex mt-4">
        <!-- status kawin -->
        <div class="mx-2">
            <x-label for="marital_status_id" :value="__('Status Kawin')" />
            <select x-model="status" x-on:click="coupleForm = status " name="marital_status_id" id="marital_status_id" value="{{ old('marital_status_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                <option selected disabled hidden>Pilih!</option>
                @foreach ($marital_statuses as $status)
                <option value="{{ $status->id }}">{{ $status->status }}</option>
                @endforeach
            </select>
        </div>

         {{-- pencarian pasangan --}}
        {{-- <div x-show="coupleForm == 2 || coupleForm == 3" class="flex">
            <div class="flex">
                <!-- keluarga -->
                <div class="mx-2 items-center">
                    <x-label for="couple_id" :value="__('Masukan Nama Suami')" />
                    <input type="text" wire:model="husband_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="nama suami">
                    <small class="text-blue-500">Hanya nama suami</small>
                </div>

                <div class="mt-8">
                    :
                </div>

                @unless ($husband_search_term == null)
                <div class="flex flex-col justify-between mt-8">
                    @foreach ($husbands as $husband)
                    <div>
                        <label class="inline-flex items-center mx-2">
                            <input x-on:click=" kbForm = true" class="form-radio" type="radio" name="suami_id" value="{{ $husband->id }}" />
                            <span class="ml-2">{{ $husband->name }}</span>
                        </label>                    
                    </div>
                    @endforeach 
                </div>
                @endunless
            </div>
        </div>  --}}
        {{-- end pencarian suami --}}

    </div>

    {{-- <div x-show="kbForm" class="mt-4">
        <div x-data="{ layanan: false }" class="flex">

            <div class="mx-2">
                <x-label for="is_kb" :value="__('Apakah KB?')" />
                <div class="mt-2">
                    <label class="inline-flex items-center mx-2">
                        <input x-on:click=" layanan = true " class="form-radio" type="radio" name="is_kb" value="1" />
                        <span class="ml-2 text-sm">KB</span>
                    </label> 
                    <label class="inline-flex items-center mx-2">
                        <input x-on:click=" layanan = false " class="form-radio" type="radio" name="is_kb" value="0" />
                        <span class="ml-2 text-sm">Tidak KB</span>
                    </label> 
                </div>
            </div>

            <div x-show="layanan" class="mx-2">
                <x-label for="kb_service_id" :value="__('Layanan KB')" />
                <select name="kb_service_id" id="kb_service_id" value="{{ old('kb_service_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                    <option selected disabled hidden>Pilih!</option>
                    @foreach ($kb_services as $service)
                    <option value="{{ $service->id }}">{{ $service->service }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div> --}}
</div>