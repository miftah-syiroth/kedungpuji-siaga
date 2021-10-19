<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Kesimpulan Ibu Nifas') }}
        <a href="/puerperals/{{ $puerperal->id }}" class="text-blue-400 hover:text-blue-700">{{ $puerperal->pregnancy->mother->name }}</a>
    </x-slot>
    
    <div class="py-2">
        <div class="flex justify-start">
            <div class="px-3 py-4 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/puerperals/{{ $puerperal->id }}">
                    @csrf
                    @method('PUT')
                    <div class="p-2 flex flex-col">
                        <div class="flex flex-row flex-wrap">
                            {{-- kondisi ibu --}}
                            <div class="mx-4 border p-2">
                                <x-label for="mother_condition_id" :value="__('Kondisi Ibu :')" />
                                <div class="grid grid-cols-1 gap-2 mt-4">
                                    @foreach ($mother_conditions as $condition)
                                    <label class="inline-flex items-center mx-2">
                                        <input class="form-radio" type="checkbox" name="mother_condition_id[]" value="{{ $condition->id }}" />
                                        <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                                    </label> 
                                    @endforeach
                                </div>
                            </div>

                            {{-- komplikasi ibu --}}
                            <div class="mx-4 border p-2">
                                <x-label for="puerperal_complication_id" :value="__('Komplikasi Nifas :')" />
                                <div class="grid grid-cols-1 gap-2 mt-4">
                                    @foreach ($complications as $complication)
                                    <label class="inline-flex items-center mx-2">
                                        <input class="form-radio" type="checkbox" name="puerperal_complication_id[]" value="{{ $complication->id }}" />
                                        <span class="ml-2 text-sm">{{ $complication->complication }}</span>
                                    </label> 
                                    @endforeach
                                </div>
                            </div>

                            {{-- KOndisi Bayi --}}
                            <div class="mx-4 border p-2">
                                <x-label for="baby_condition_id" :value="__('Kondisi Bayi :')" />
                                <div class="grid grid-cols-2 gap-2 mt-4">
                                    @foreach ($baby_conditions as $condition)
                                    <label class="inline-flex items-center mx-2">
                                        <input class="form-radio" type="checkbox" name="baby_condition_id[]" value="{{ $condition->id }}" />
                                        <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                                    </label> 
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- kesimpulan -->
                        <div class="mx-4 mt-4">
                            <x-label for="conclusion" :value="__('Kesimpulan :')" />
                            <textarea name="conclusion" id="conclusion" value="{{ old('conclusion') }}" cols="70" rows="5" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"></textarea>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-4 mx-4">
                        <x-button class="ml-4">
                            {{ __('Simpan') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>