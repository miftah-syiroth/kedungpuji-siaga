<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Kesimpulan Ibu Nifas') }}
        <a href="/puerperals/{{ $puerperal->id }}" class="text-blue-400 hover:text-blue-700">{{ $puerperal->pregnancy->mother->name }}</a>
    </x-slot>
    

    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/puerperals/{{ $puerperal->id }}">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap">
                {{-- kondisi ibu --}}
                <div class="mr-4 w-auto mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-semibold">Kondisi Ibu</span>
                    <div class="grid grid-cols-1 gap-2 mt-4">
                        @foreach ($mother_conditions as $condition)
                        <label class="inline-flex items-center mx-2">
                            <input class="borderx" type="radio" name="mother_condition_id" value="{{ $condition->id }}" />
                            <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                        </label> 
                        @endforeach
                    </div>
                </div>

                {{-- komplikasi ibu --}}
                <div class="mx-4 w-auto mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-semibold">Komplikasi Nifas :</span>
                    <div class="grid grid-cols-1 gap-2 mt-4">
                        @foreach ($complications as $complication)
                        <label class="inline-flex items-center mx-2">
                            <input class="border" type="checkbox" name="puerperal_complication_id[]" value="{{ $complication->id }}" />
                            <span class="ml-2 text-sm">{{ $complication->complication }}</span>
                        </label> 
                        @endforeach
                    </div>
                </div>

                {{-- KOndisi Bayi --}}
                <div class="mx-4 w-auto mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-semibold">Kondisi Bayi :</span>
                    <div class="grid gap-2 mt-4">
                        @foreach ($baby_conditions as $condition)
                        <label class="inline-flex items-center mx-2">
                            <input class="border" type="checkbox" name="baby_condition_id[]" value="{{ $condition->id }}" />
                            <span class="ml-2 text-sm">{{ $condition->condition }}</span>
                        </label> 
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- kesimpulan -->
            <label class="block mt-4 mx-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Kesimpulan</span>
                <textarea name="conclusion" id="conclusion" value="{{ old('conclusion') }}" class="block border-2 w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ old('conclusion') }}</textarea>
            </label>
            
            <div class="flex flex-wrap justify-between text-sm">
                <div>
                    <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Edit Ringkasan</button>
                    <a href="/puerperals/{{ $puerperal->id }}" type="submit" class=" bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Batal Ubah</a>
                </div>
                
            </div>
        </form>
        <form action="/puerperals/{{ $puerperal->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="flex justify-end text-sm">
                <button type="submit" class="bg-red-500 dark:bg-red-800 text-white dark:text-gray-200 py-2 px-3 rounded-md hover:bg-red-700 dark:hover:bg-red-900 mx-2 my-4">hapus nifas</button>
            </div>
        </form>
    </div>

</x-app-layout>