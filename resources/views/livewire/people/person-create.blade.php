<div class="py-4">
    <div class="flex justify-center">
        <div x-data="{ person: ''}" class="px-6 py-6 bg-white rounded-lg shadow-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('people.store') }}">
                @csrf

                <div class="flex flex-row">
                    <!-- Name -->
                    <div class="mx-2 w-3/5">
                        <x-label for="name" :value="__('Nama Lengkap')" />
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama Lengkap">
                    </div>

                    <!-- NIK -->
                    <div class="mx-2 w-2/5">
                        <x-label for="nik" :value="__('NIK')" />
                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="NIK">
                    </div>
                </div>

                <div class="flex flex-row mt-2">
                    <!-- tempat lahir -->
                    <div class="mx-2 w-52">
                        <x-label for="place_of_birth" :value="__('Tempat Lahir')" />
                        <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Kota Lahir">
                    </div>

                    <!-- tanggal lahir -->
                    <div class="mx-2 w-44">
                        <x-label for="date_of_birth" :value="__('Tgl Lahir')" />
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                    </div>

                    <!-- Agama -->
                    <div class="mx-2">
                        <x-label for="religion_id" :value="__('Agama')" />
                        <select name="religion_id" id="religion_id" value="{{ old('religion_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($religions as $religion)
                            <option value="{{ $religion->id }}">{{ $religion->religion }}</option>
                            @endforeach
                        </select>
                    </div>

                
                    <!-- golongan darah -->
                    <div class="mx-2">
                        <x-label for="blood_group_id" :value="__('Goldar')" />
                        <select name="blood_group_id" id="blood_group_id" value="{{ old('blood_group_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($blood_groups as $blood_group)
                            <option value="{{ $blood_group->id }}">{{ $blood_group->group }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex mt-2">

                    <!-- jenis kelamin -->
                    <div class="mx-2">
                        <x-label for="sex_id" :value="__('Jenis Kelamin')" />
                        <select name="sex_id" id="sex_id" value="{{ old('sex_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($sexes as $sex)
                            <option value="{{ $sex->id }}">{{ $sex->sex }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pendidikan -->
                    <div class="mx-2">
                        <x-label for="educational_id" :value="__('Pendidikan')" />
                        <select name="educational_id" id="educational_id" value="{{ old('educational_id') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($educationals as $educational)
                            <option value="{{ $educational->id }}">{{ $educational->education }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- RT -->
                    <div class="mx-2 w-16">
                        <x-label for="rt" :value="__('RT')" />
                        <input type="number" name="rt" id="rt" value="{{ old('rt') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                     <!-- RW -->
                     <div class="mx-2 w-16">
                        <x-label for="rw" :value="__('RW')" />
                        <input type="number" name="rw" id="rw" value="{{ old('rw') }}" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>


                <div x-data="{coupleForm : 0}" class="flex flex-col">
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
                        <div x-show="coupleForm == 2 || coupleForm == 3" class="flex">
                            <div class="flex">
                                <!-- keluarga -->
                                <div class="mx-2 items-center">
                                    <x-label for="couple_id" :value="__('Suami / Istri')" />
                                    <input type="text" wire:model="couple_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="cari pasangan">
                                    <small class="text-blue-500">kosongkan jika tidak ada</small>
                                </div>
        
                                <div class="mt-8">
                                    :
                                </div>
        
                                @unless ($couple_search_term == null)
                                <div class="flex flex-col justify-between mt-8">
                                    @foreach ($couples as $person)
                                    <div>
                                        <label class="inline-flex items-center mx-2">
                                            <input class="form-radio" type="radio" name="couple_id" value="{{ $person->id }}" />
                                            <span class="ml-2">{{ $person->name }}</span>
                                        </label>                    
                                    </div>
                                    @endforeach 
                                </div>
                                @endunless
                            </div>
                        </div> 

                    </div>

                    <div x-show="coupleForm == 2 || coupleForm == 3" class="mt-4">
                        <div x-data="{ layanan: false }" class="flex">

                            <div class="mx-2">
                                <x-label for="is_cacat" :value="__('Apakah KB?')" />
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
                    </div>
                </div>
                
                <div x-data="{ disabilitas: false}" class="flex mt-4">
                    <!-- apakah cacat -->
                    <div class="mx-2">
                        <x-label for="is_cacat" :value="__('Apakah cacat?')" />
                        <div class="mt-2">
                            <label class="inline-flex items-center mx-2">
                                <input x-on:click=" disabilitas = true " class="form-radio" type="radio" name="is_cacat" value="1" />
                                <span class="ml-2 text-sm">Cacat</span>
                            </label> 
                            <label class="inline-flex items-center mx-2">
                                <input x-on:click=" disabilitas = false " class="form-radio" type="radio" name="is_cacat" value="0" />
                                <span class="ml-2 text-sm">Tidak</span>
                            </label> 
                        </div>
                    </div>

                    <!-- list cacat -->
                    <div x-show="disabilitas" class="mx-2">
                        <x-label for="disability_id" :value="__('Disabilitas')" />
                        <select name="disability_id" id="disability_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($disabilities as $disability)
                            <option value="{{ $disability->id }}">{{ $disability->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div x-data="{ nomorkk: 0 }" class="flex mt-4">
                    <!-- status dalam keluarga -->
                    <div class="mx-2">
                        <x-label for="family_status_id" :value="__('Keanggotaan Keluarga')" />
                        <select x-model="status" x-on:click="nomorkk = status " name="family_status_id" id="family_status_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option hidden>Pilih!</option>
                            @foreach ($family_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nomor KK -->
                    <div x-show="nomorkk == 1" class="mx-2 items-center">
                        <x-label for="nomor_kk" :value="__('Nomor KK')" />
                        <input type="text" name="nomor_kk" id="nomor_kk" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nomor KK">
                    </div>

                    <!-- keluarga sejahtera-->
                    <div x-show="nomorkk == 1" class="mx-2">
                        <x-label for="keluarga_sejahtera_id" :value="__('Keluarga Sejahtera')" />
                        <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($keluarga_sejahtera as $tahapan)
                            <option value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- list kepala keluarga --}}
                    <div x-show="nomorkk != 1" class="flex">
                        <div class="flex">
                            <!-- keluarga -->
                            <div class="mx-2 items-center">
                                <x-label for="kepalaKeluarga" :value="__('Keluarga')" />
                                <input type="text" wire:model="family_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Cari Kepala Keluarga">
                                <small class="text-blue-500">kosongkan jika tidak ada</small>
                            </div>
    
                            <div class="mt-8">
                                :
                            </div>
    
                            @unless ($family_search_term == null)
                            <div class="flex flex-col justify-between mt-8 items-center">
                                @foreach ($family_leaders as $leader)
                                <div>
                                    <label class="inline-flex items-center mx-2">
                                        <input class="form-radio" type="radio" name="family_id" value="{{ $leader->kepalaKeluarga->id }}" />
                                        <span class="ml-2">{{ $leader->name }}</span>
                                    </label>                    
                                </div>
                                @endforeach 
                            </div>
                            @endunless
                        </div>
                    </div>  
                </div>

                <div class="flex mt-4">

                    <div x-data="{ ibu: '' }" class="flex">
                        <!-- ibu kandung -->
                        <div class="mx-2 items-center">
                            <x-label :value="__('Ibu Kandung')" />
                            <input x-model="ibu" type="text" wire:model="mother_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Cari Ibu Kandung">
                            <small class="text-blue-500">kosongkan jika tidak ada</small>
                        </div>

                        <div class="mt-8">
                            :
                        </div>

                        @unless ($mother_search_term == null)
                        <div class="flex flex-col justify-between mt-8">
                            @foreach ($mothers as $mother)
                            <div>
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" ibu = '{{ $mother->name }}'" class="form-radio" type="radio" name="ibu_id" value="{{ $mother->id }}" />
                                    <span class="ml-2">{{ $mother->name }}</span>
                                </label>                    
                            </div>
                            @endforeach 
                        </div>
                        @endunless
                    </div>  
                </div>
                
                <div class="mt-4">
                    <div x-data="{ ayah: '' }" class="flex">
                        <!-- ayah kandung -->
                        <div class="mx-2 items-center">
                            <x-label for="ayah_id" :value="__('Ayah Kandung')" />
                            <input x-model="ayah" type="text" wire:model="father_search_term" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Cari Ayah Kandung">
                            <small class="text-blue-500">kosongkan jika tidak ada</small>
                        </div>

                        <div class="mt-8">
                            :
                        </div>

                        @unless ($father_search_term == null)
                        <div class="flex flex-col justify-between mt-8">
                            @foreach ($fathers as $father)
                            <div>
                                <label class="inline-flex items-center mx-2">
                                    <input x-on:click=" ayah = '{{ $father->name }}'" class="form-radio" type="radio" name="ayah_id" value="{{ $father->id }}" />
                                    <span class="ml-2">{{ $father->name }}</span>
                                </label>                    
                            </div>
                            @endforeach 
                        </div>
                        @endunless
                    </div>
                </div>
                
                <div class="flex items-center justify-between mt-4">

                    <div>
                        {{--  --}}
                    </div>
                    <x-button class="ml-4">
                        {{ __('Tambah Keluarga') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>