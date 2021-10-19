<x-app-layout>
    <x-slot name="header">
        {{ __('Ringkasan Pelayanan Persalinan: ') }} 
        <a href="/people/{{ $pregnancy->mother->id }}" class="text-blue-400 hover:text-blue-700">{{ $pregnancy->mother->name }}</a>
    </x-slot>

    <div class="flex flex-row">
        <div x-data="{ isOpen : true }" class="py-4 mr-2 w-full">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Ringkasan</button>
                    </h3>
                    <div x-show="isOpen" class="flex justify-between">
                        <a href="/pregnancies/{{ $pregnancy->id }}/edit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-700">edit</a>
                        @if ($pregnancy->puerperal)
                        <a href="/puerperals/{{ $pregnancy->puerperal->id }}" class=" bg-green-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-green-700">lihat data nifas</a>
                        @endif
                    </div>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200 flex flex-row">
                    <dl class="w-1/2">
                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Berat Badan Ibu
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                                : {{ $pregnancy->mother_weight }} kg
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Tinggi Badan Ibu
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                                : {{ $pregnancy->mother_height}} cm
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                BMI Ibu
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                                : {{ $pregnancy->mother_bmi }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                HPHT
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                                : {{ $pregnancy->hpht->isoFormat('dddd, DD MMMM YYYY') }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Tanggal Persalinan
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                                :
                                @isset($pregnancy->childbirth_date)
                                 {{ $pregnancy->childbirth_date->isoFormat('dddd, DD MMMM YYYY HH:mm') }}
                                @endisset
                                
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Umur Kehamilan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-3">
                                : {{ $pregnancy->gestational_age ?? '-' }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Penolong Persalinan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-3">
                                : {{ $pregnancy->childbirth_attendant }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Cara Persalinan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-3">
                                : {{ $pregnancy->childbirth_method }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Keadaan Ibu
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-3">
                                : {{ $pregnancy->post_partum_condition}}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-5 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                Keterangan Tambahan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 col-span-3">
                                : {{ $pregnancy->additional_information }}
                            </dd>
                        </div>
                    </dl>

                    {{-- komponen bayi --}}
                    <dl class="w-1/2">
                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Kelahiran ke: 
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0">
                                : {{ $pregnancy->childbirth_order }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Berat Bayi
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0">
                                : {{ $pregnancy->baby_weight }} gram
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Panjang Bayi
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0">
                                : {{ $pregnancy->baby_lenght }} cm
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Lingkar Kepala
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0">
                                : {{ $pregnancy->baby_head_circumference}} cm
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Jenis Kelamin
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0">
                                : {{ $pregnancy->sex->sex ?? '-' }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Kondisi Bayi Lahir
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                                : @foreach ($pregnancy->babyConditions as $condition)
                                    {{ $condition->condition . ', ' }}
                                @endforeach
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Asuhan Bayi Baru Lahir
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                                : {{ $pregnancy->attendant }}
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Keterangan Tambahan
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                                : {{ $pregnancy->baby_additional_information }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- komponen input data kb --}}
    <div class="py-4">
        <div x-data="{ isOpen : true }">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2 flex flex-col">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Layanan Ibu Hamil</button>
                    </h3>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200">
                    <div class="grid gap-2 mb-8 grid-cols-3 mt-4">
                        @for ($i = 1; $i <= 9; $i++)
                        <div class="bg-gray-50 rounded-md border-2">
                            <div class="flex flex-col">

                                <p class="mb-2 text-sm font-medium text-dark text-center" >
                                    Bulan ke {{ $i }}
                                </p>
                                
                                {{-- variabel ini akan digunakan untuk menampilkan tombol create pada bulan yg sesuai dgn umur kehamilan dan belum ada isinya --}}
                                @php $is_filled = false; @endphp

                                @foreach ($pregnancy->prenatalClasses as $data)

                                @if ($data->month_periode == $i)
                                @php $is_filled = true; @endphp
                                <dl>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Berat Badan
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            : {{ $data->mother_weight }}kg
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            LiLa
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->arm_circumference }} cm
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Tekanan Darah
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->systolic }}/{{ $data->diastolic }}
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Tinggi Rahim
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->uterine_height }} cm
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Denyut Jantung Bayi
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->baby_heart_rate }} /menit
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            HB
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->hemoglobin }}
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Protein Urine
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->urine_protein }}
                                        </dd>
                                    </div>
                                    <div class="px-2 py-1 grid grid-cols-2 gap-2">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Gula Darah
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0">
                                            :  {{ $data->blood_sugar }}
                                        </dd>
                                    </div>
                                </dl>
                                <a href="/prenatal-classes/{{ $data->id }}/edit" class="text-sm text-center rounded-md px-3 py-1 bg-green-500 hover:bg-green-700 text-white">edit</a>
                                
                                @break
                                @endif
                                
                                @endforeach
                                
                                @if ($is_filled == false && $pregnancy->childbirth_date == null)
                                <div class="flex justify-center">
                                    <a href="/pregnancies/{{ $pregnancy->id }}/prenatal-classes/{{ $i }}/create" class="text-sm rounded-md px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white">input</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>