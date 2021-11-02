{{-- komponen input data kb --}}

<div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
    <h3>{{ $ageInMonth }}</h3>
    <div class="px-4 py-2 flex flex-col">
        <h3 class="text-md leading-6 font-medium justify-center text-center">
            <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Anthropometries</button>
        </h3>

        @if (session('message'))
            <span class="text-red-500 text-sm text-center">
                {{ session('message') }}
            </span>
        @endif

        <div x-show="isOpen" class="flex justify-between">
            <div>
                @if ($ageInYear != 0)
                <button wire:click="getAnthropometries({{ $ageInYear-1 }})" class="text-md font-medium text-blue-500 hover:underline hover:text-blue-700">Tahun ke {{ $ageInYear-1 }}</button>
                @endif
            </div>
            <div>
                @if ($ageInYear != 4)
                <button wire:click="getAnthropometries({{ $ageInYear+1 }})" class="text-md font-medium text-blue-500 hover:underline hover:text-blue-700">Tahun ke {{ $ageInYear+1 }}</button>
                @endif
            </div>
        </div>
    </div>
    
    <div x-show="isOpen" class="border-t border-gray-200">
        <div class="grid gap-2 mb-8 grid-cols-3 mt-4">
            @for ($i = $batasBawahBulan; $i <= $batasAtasBulan; $i++)
                
            <div class="rounded-md border-2">
                <div class="flex flex-col flex-wrap py-2 px-1">

                    <div class="mb-2">
                        <h3 class="text-md font-medium text-info-dark hover:text-success-lighter text-center">
                            {{ $i }} bulan 
                        </h3>
                    </div>
                    
                    
                    {{-- kalau ga terisi, button input muncul --}}
                    @php $is_filled = false; @endphp

                    @foreach ($anthropometries as $data)

                    @if ($data->month_periode == $i)
                    @php $is_filled = true; @endphp
                    <dl class="text-sm">
                        <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                            <h3 class="font-semibold col-span-2">PB</h3>
                            <h5 class="ml-4 col-span-4">: {{ $data->height }} cm ({{ $data->height_difference }} mm)</h5>
                        </div>

                        <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                            <h3 class="font-semibold col-span-2">BB</h3>
                            <h5 class="ml-4 col-span-4">: {{ $data->weight }} kg ({{ $data->weight_difference }} gr)</h5>
                        </div>

                        <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                            <h3 class="font-semibold col-span-2">LK</h3>
                            <h5 class="ml-4 col-span-4">: {{ $data->head_circumference }} cm ({{ $data->head_circumference_difference }} mm)</h5>
                        </div>

                        <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                            <h3 class="font-semibold col-span-2">BMI</h3>
                            <h5 class="ml-4 col-span-4">: {{ $data->bmi }}</h5>
                        </div>

                        <div class="px-2 py-1 flex flex-col">
                            <h3 class="font-semibold">PB Menurut Umur :</h3>
                            <h5 class="ml-4">{{ $data->heightForAgeCategory->category }}</h5>
                        </div>

                        <div class="px-2 py-1 flex flex-col">
                            <h3 class="font-semibold">BB Menurut Umur :</h3>
                            <h5 class="ml-4">{{ $data->weightForAgeCategory->category }}</h5>
                        </div>

                        <div class="px-2 py-1 flex flex-col">
                            <h3 class="font-semibold">BMI Menurut Umur :</h3>
                            <h5 class="ml-4">{{ $data->bmiForAgeCategory->category }}</h5>
                        </div>

                        <div class="px-2 py-1 flex flex-col">
                            <h3 class="font-semibold">BB Menurut PB :</h3>
                            <h5 class="ml-4">{{ $data->weightForHeightCategory->category }}</h5>
                        </div>
                        
                    </dl>

                    {{-- cegah agar tidak ada edit pada card yg telah dilewati umurnya --}}
                    @if ($ageInMonth == $i)
                        <div class="text-center my-2">
                        <a href="/anthropometries/{{ $data->id }}/edit" class="text-sm text-center rounded-md px-3 py-1 bg-green-500 hover:bg-green-700 text-white">edit</a>
                    </div>
                    @endif
                    
                    
                    
                    @break
                    @endif
                    
                    @endforeach
                    
                    @if ($is_filled == false)
                    <div class="flex justify-center">
                        <a href="/posyandu/{{ $posyandu->id }}/month/{{ $i }}/anthropometries/create" class="text-xs rounded-md px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white">input</a>
                    </div>
                    @endif
                </div>
            </div>

            @endfor
        </div>
    </div>
</div>
 
