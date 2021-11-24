<x-app-layout>
    <x-slot name="header">
        {{ __('Ringkasan Pelayanan Persalinan: ') }} 
        <a href="/people/{{ $pregnancy->person->id }}" class="text-blue-400 hover:text-blue-700">{{ $pregnancy->person->name }}</a>
    </x-slot>

    <div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <div class="px-2 py-2">
            <h3 class="text-md leading-6 font-medium justify-center text-center">
                <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Ringkasan</button>
            </h3>
            <div x-show="isOpen" class="flex justify-between">
                <div class="flex">
                    <a href="/pregnancies/{{ $pregnancy->id }}/edit" class="bg-green-500 px-4 py-1 mr-4 rounded-md text-white text-sm text-center mt-2 hover:bg-green-700">edit</a>

                    @isset($pregnancy->childbirth_date)
                    <form action="/pregnancies/{{ $pregnancy->id }}/childbirths" method="post">
                        @csrf
                        <button type="submit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-700">tambah data bayi</button>
                    </form>
                    @endisset
                    
                </div>
                <div>
                    {{-- kalau ada value waktu kelahiran --}}
                    @isset($pregnancy->childbirth_date)

                    @isset($pregnancy->puerperal)
                        <a href="/puerperals/{{ $pregnancy->puerperal->id }}" class=" bg-green-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-green-700">lihat data nifas</a>
                    @else
                        <form action="/pregnancies/{{ $pregnancy->id }}/puerperals" method="post">
                            @csrf
                            <button type="submit" class="bg-red-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-red-700">buat data nifas</button>
                        </form>
                    @endisset

                    @endisset
                </div>

            </div>
        </div>
        <div x-show="isOpen" class="border-t border-gray-200 flex flex-col">
            <div class="flex border-b-2">
                {{-- kolom kiri --}}
                <dl class="w-1/2">
                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Berat Badan Ibu
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->weight }} kg
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Tinggi Badan Ibu
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->height}} cm
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            BMI Ibu
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->bmi }}
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            HPHT
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->hpht->isoFormat('dddd, DD MMMM YYYY') }}
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
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
                </dl>

                {{-- kolom kanan --}}
                <dl class="w-1/2">

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Umur Kehamilan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->gestational_age ?? $pregnancy->hpht->diffInWeeks(now()) . ' minggu sedang mengandung' }}
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Status Partus
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3 font-semibold">
                            : @isset($pregnancy->parturition)
                                {{ $pregnancy->parturition->type }}
                            @endisset
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Penolong Persalinan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->childbirth_attendant }}
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Keadaan Ibu
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : @isset($pregnancy->motherCondition)
                            {{ $pregnancy->motherCondition->condition }}
                            @endisset
                        </dd>
                    </div>

                    <div class="px-4 py-1 grid grid-cols-5 gap-2">
                        <dt class="text-sm font-medium text-gray-500 col-span-2">
                            Keterangan Tambahan
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 col-span-3">
                            : {{ $pregnancy->additional_information }}
                        </dd>
                    </div>
                </dl>
            </div>

            @if ($pregnancy->childbirths->isNotEmpty())
            <div class="flex">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                            <th class="px-2 py-3">Anak Ke</th>
                            <th class="px-2 py-3">BB</th>
                            <th class="px-2 py-3">PB</th>
                            <th class="px-2 py-3">LK</th>
                            <th class="px-2 py-3">SEX</th>
                            <th class="px-2 py-3">Metode</th>
                            <th class="px-2 py-3">Kondisi</th>
                            <th class="px-2 py-3">Keterangan</th>
                            <th class="px-2 py-3">edit</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y ">
                            
                        @foreach ($pregnancy->childbirths as $childbirth)
                        <tr class="text-gray-700 dark:text-gray-300">
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $childbirth->childbirth_order }}
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $childbirth->weight }} gr
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $childbirth->length }} cm
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $childbirth->head_circumference }} cm
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                @isset($childbirth->sex)
                                {{ $childbirth->sex->sex }}
                                @endisset
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $childbirth->childbirth_method }}
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                @foreach ($childbirth->babyConditions as $condition)
                                    {{ $condition->condition }}, 
                                @endforeach
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $childbirth->additional_information }}
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                <a href="/childbirths/{{ $childbirth->id }}/edit" class="text-blue-500 hover:text-blue-600 hover:underline">edit</a>
                            </td>
                        </tr>
                        @endforeach
    
                        
                    </tbody>
                </table>
            </div> 
            @endif
            
            
            
        </div>
    </div>
 

    <div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800">
        <div class="px-4 py-2 flex flex-col">
            <h3 class="text-md leading-6 font-medium justify-center text-center">
                <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Layanan Ibu Hamil</button>
            </h3>
        </div>
        <div x-show="isOpen" class="border-t border-gray-200">
            <div class="grid gap-2 mb-8 grid-cols-3 mt-4">
                @for ($i = 1; $i <= 9; $i++)
                <div class="rounded-md border-2">
                    <div class="flex flex-col flex-wrap">

                        <p class="mb-2 text-sm font-medium text-dark text-center" >
                            Bulan ke {{ $i }}
                        </p>

                        @if ($i <= $pregnancy->hpht->diffInMonths(now()) + 1)
                        <div>
                            {{-- variabel ini akan digunakan untuk menampilkan tombol create pada bulan yg sesuai dgn umur kehamilan dan belum ada isinya --}}
                            @php $is_filled = false; @endphp

                            @foreach ($pregnancy->prenatalClasses as $data)

                            @if ($data->month_periode == $i)
                            @php $is_filled = true; @endphp
                            <dl>
                                <div class="px-2 py-1 flex flex-col text-sm">
                                    <dt class="font-semibold">
                                        Waktu Kunjungan :
                                    </dt>
                                    <dd class="mt-1 ml-4">
                                        {{ $data->visited_at->isoFormat('dddd, DD MMMM YYYY') }}
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        Berat Badan
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        : {{ $data->mother_weight }}kg
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        LiLa
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->arm_circumference }} cm
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        Tekanan Darah
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->systolic }}/{{ $data->diastolic }}
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        Tinggi Rahim
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->uterine_height }} cm
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        Denyut Jantung Bayi
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->baby_heart_rate }} /menit
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        HB
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->hemoglobin }}
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        Protein Urine
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->urine_protein }}
                                    </dd>
                                </div>
                                <div class="px-2 py-1 grid grid-cols-2 gap-2 text-sm">
                                    <dt class="font-semibold">
                                        Gula Darah
                                    </dt>
                                    <dd class="mt-1 sm:mt-0">
                                        :  {{ $data->blood_sugar }}
                                    </dd>
                                </div>
                            </dl>
                            
                            <div class="text-center my-2">
                                <a href="/prenatal-classes/{{ $data->id }}/edit" class="text-sm text-center rounded-md px-3 py-1 bg-green-500 hover:bg-green-700 text-white">edit</a>
                            </div>
                            
                            @break
                            @endif
                            
                            @endforeach
                            
                            @unless ($is_filled)
                            <div class="text-center my-2">
                                <a href="/pregnancies/{{ $pregnancy->id }}/month/{{ $i }}/prenatal-classes/create" class="text-sm rounded-md px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white">input</a>
                            </div>
                            @endunless
                        </div>
                          
                        @endif

                        
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    
</x-app-layout>