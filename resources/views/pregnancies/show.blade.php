<x-app-layout>
    <x-slot name="header">
        {{ __('Ringkasan Pelayanan Persalinan: ') }} 
        <a href="/people/{{ $pregnancy->mother->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $pregnancy->mother->name }}</a>
    </x-slot>

    <div class="flex flex-row">

        <div class="py-4 mr-2 w-full">
            <div x-data="{ isOpen : true }">
                <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                    <div class="px-4 py-2">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 justify-center text-center">
                            <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Ibu Bersalin dan Ibu Nifas</button>
                        </h3>
                    </div>
                    <div x-show="isOpen" class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Berat Badan
                                </dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->mother_weight }} kg
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Tinggi Badan
                                </dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->mother_height}} cm
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    BMI
                                </dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->mother_bmi }}
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    HPHT
                                </dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->hpht}}
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Tanggal Persalinan
                                </dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                   : 
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Umur Kehamilan
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->gestational_age ?? '-' }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Penolong Persalinan
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    : {{ $pregnancy->attendant }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Cara Persalinan
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    : {{ $pregnancy->childbirth_method }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Keadaan Ibu
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->post_partum_condition}}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    KB Pasca Persalinan
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : 
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-4 ml-2 w-full">
            <div x-data="{ isOpen : true }">
                <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                    <div class="px-4 py-2">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 justify-center text-center">
                            <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Bayi Saat Lahir</button>
                        </h3>
                    </div>
                    <div x-show="isOpen" class="border-t border-gray-200">
                        <dl>    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Anak Ke
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->childbirth_order }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Berat Lahir Anak
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->childbirth_weight }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Panjang Badan Anak
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->childbirth_lenght }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Lingkar Kepala Anak
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : {{ $pregnancy->baby_head_circumference }}
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Jenis Kelamin Anak
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : 
                                </dd>
                            </div>
    
                            <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Kondisi bayi saat lahi
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                   : 
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- komponen input data kb --}}
    <div class="py-4">
        <div x-data="{ isOpen : true }">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Layanan Ibu Hamil</button>
                    </h3>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200">
                    <dl>
                        <div class="grid gap-4 mb-8 grid-cols-3 mt-4">
                            @for ($i = 1; $i <= 6; $i++)
                            <div x-data="{
                                dataShow: true,
                                formShow: false,
                            }" class="p-2 bg-blue-100 rounded-lg shadow-md">
                                <div class="flex flex-col">

                                    <p class="mb-2 text-sm font-medium text-dark text-left" >
                                        Periksa {{ $i }}
                                    </p>
                                        
                                    <div class="grid">

                                        @foreach ($pregnancy->prenatalClasses as $data)
                                            
                                        @if ($data->checkup_periode == $i)

                                        <div x-show="dataShow" class="bg-white p-4 mx-auto rounded-lg">
                                            <table class="w-full">
                                                <tr class="text-left border-b text-sm">
                                                    <th>Timbang</th>
                                                    <td>
                                                        : {{ $data->mother_weight }}kg
                                                    </td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>Lingkar Lengan</th>
                                                    <td>: {{ $data->arm_circumference }} cm</td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>Tekanan Darah</th>
                                                    <td>: {{ $data->systolic }}/{{ $data->diastolic }}</td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>Tinggi Rahim</th>
                                                    <td>: {{ $data->uterine_height }} cm</td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>Denyut Jantung Bayi</th>
                                                    <td>: {{ $data->baby_heart_rate }} /menit</td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>HB</th>
                                                    <td>: {{ $data->hemoglobin }}</td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>Protein Urine</th>
                                                    <td>: {{ $data->urine_protein }}</td>
                                                </tr>
                                                <tr class="text-left border-b text-sm">
                                                    <th>GulaDarah</th>
                                                    <td>: {{ $data->blood_sugar }}</td>
                                                </tr>                                                
                                            </table>
                                        </div>
                                        @break
                                        @endif

                                        @endforeach

                                        <div x-show="formShow" class="flex bg-white mx-auto rounded-lg p-2 text-xs">
                                            <form action="/pregnancies/{{ $pregnancy->id }}/prenatal-class" method="post">
                                                @csrf
                                                <input type="hidden" name="checkup_periode" value="{{ $i }}">
                                                <div class="text-gray-700 flex mb-1 items-center border-b pb-1">
                                                    <div class="mb-1 md:mb-0 w-3/5">
                                                        <label for="timbang" class="font-semibold">Timbang</label>
                                                    </div>
                                                    <div class="w-2/5 flex justify-end">
                                                        <input type="number" name="mother_weight" value="" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 w-3/5">
                                                        <label for="forms-labelLeftInputCode" class="font-semibold">LiLa</label>
                                                    </div>
                                                    <div class="w-2/5 flex justify-end">
                                                        <input type="number" name="arm_circumference" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 w-3/5">
                                                        <label for="forms-labelLeftInputCode" class="font-semibold">Tekanan Darah</label>
                                                    </div>
                                                    <div class="w-2/5 flex justify-end">
                                                        <input type="number" name="systolic" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                        <input type="number" name="diastolic" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 md:w-3/5">
                                                        <label for="forms-labelLeftInputCode" class="font-semibold">Tinggi Rahim</label>
                                                    </div>
                                                    <div class="md:w-2/5 flex justify-end">
                                                        <input type="number" name="uterine_height" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 md:w-3/5">
                                                        <label for="forms-labelLeftInputCode" class="font-semibold">Denyut Jantung Bayi</label>
                                                    </div>
                                                    <div class="md:w-2/5 flex justify-end">
                                                        <input type="number" name="baby_heart_rate" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 md:w-3/5">
                                                        <label for="forms-labelLeftInputCode" class="font-semibold">Hb</label>
                                                    </div>
                                                    <div class="md:w-2/5 flex justify-end">
                                                        <input type="number" name="hemoglobin" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 md:w-3/5">
                                                        <label for="forms-labelLeftInputCode" class="font-semibold">Protein Urine</label>
                                                    </div>
                                                    <div class="md:w-2/5 flex justify-end">
                                                        <input type="number" name="urine_protein" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>

                                                <div class="text-gray-700 flex mb-1 items-center pb-1 border-b">
                                                    <div class="mb-1 md:mb-0 md:w-3/5">
                                                        <label for="" class="font-semibold">Gula Darah</label>
                                                    </div>
                                                    <div class="md:w-2/5 flex justify-end">
                                                        <input type="number" name="blood_sugar" class="w-16 h-8 px-3 placeholder-gray-600 border rounded-lg focus:shadow-outline"/>
                                                    </div>
                                                </div>
                                                <button type="submit" class="px-2 py-1 bg-blue-400 hover:bg-blue-700 rounded-lg text-white">simpan</button>
                                            </form>
                                        </div>
                            
                                        <button x-on:click=" formShow = ! formShow, dataShow=!dataShow " class="text-sm text-right text-red-600 hover:underline">
                                            edit
                                        </button>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            @endfor
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>