{{-- komponen input data kb --}}
<div class="py-4">
    <div x-data="{ isOpen : true }">
        <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
            <div class="px-4 py-2 flex flex-col">
                <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                    <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Layanan Neonatus</button>
                </h3>

                <div x-show="isOpen">
                    <h3 class="text-sm font-medium">Kelahiran hari ke : {{ $umur_bayi }}</h3>
                </div>
            </div>
            
            <div x-show="isOpen" class="border-t border-gray-200">
                <div class="grid gap-2 mb-8 grid-cols-2 mt-4">
                    @foreach ($periode as $periode)
                       
                    <div class="bg-gray-50 rounded-md border-2">
                        <div class="flex flex-col flex-wrap py-2 px-1 relative">

                            <div class="mb-2">
                                <h3 class="text-md font-medium text-dark text-center" >
                                    KN {{ $periode['nomor'] }}
                                </h3>
                                <h5 class="text-center text-sm text-gray-600">({{ $periode['min'] }} - {{ $periode['max'] }})</h5>
                            </div>

                            @php $is_filled = false; @endphp

                            @foreach ($posyandu->neonatuses as $neonatus)
                                
                            @if ($neonatus->periode == $periode['nomor'])
                            @php $is_filled = true; @endphp

                            <dl class="text-sm">
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Waktu Kunjungan</h3>
                                    <p class="ml-4 col-span-4">: {{ $neonatus->visited_at->isoFormat('dddd, DD MMMM YYYY HH:mm') }}</p>
                                </div>
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">BB</h3>
                                    <h5 class="ml-4 col-span-4">: {{ $neonatus->baby_weight }} kg</h5>
                                </div>
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">PB</h3>
                                    <p class="ml-4 col-span-4">: {{ $neonatus->baby_lenght }} cm</p>
                                </div>
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">LK</h3>
                                    <p class="ml-4 col-span-4">: {{ $neonatus->baby_head_circumference }} cm</p>
                                </div>

                                @if ($neonatus->periode == 1)
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">IMD</h3>
                                    <label class="inline-flex items-center ml-4 col-span-4">
                                        : <input class="form-radio ml-1" type="checkbox" {{ $neonatus->imd == true ? 'checked' : '' }} disabled />
                                    </label>
                                </div>
                                @endif

                                @if (in_array($neonatus->periode, [1, 2]))
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Salep/Tetes Mata</h3>
                                    <label class="inline-flex items-center ml-4 col-span-4">
                                        : <input class="form-radio ml-1" type="checkbox" {{ $neonatus->salep_mata == true ? 'checked' : '' }} disabled />
                                    </label>
                                </div>
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Vitamin K1</h3>
                                    <label class="inline-flex items-center ml-4 col-span-4">
                                        : <input class="form-radio ml-1" type="checkbox" {{ $neonatus->vitamin_k1 == true ? 'checked' : '' }} disabled />
                                    </label>
                                </div>
                                @endif

                                @if (in_array($neonatus->periode, [1, 2, 3]))
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Imunisasi HB</h3>
                                    <label class="inline-flex items-center ml-4 col-span-4">
                                        : <input class="form-radio ml-1" type="checkbox" {{ $neonatus->imunisasi_hb == true ? 'checked' : '' }} disabled />
                                    </label>
                                </div>
                                @endif

                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Perawatan Tali Pusat</h3>
                                    <label class="inline-flex items-center ml-4 col-span-4">
                                        : <input class="form-radio ml-1" type="checkbox" {{ $neonatus->perawatan_tali_pusat == true ? 'checked' : '' }} disabled />
                                    </label>
                                </div>
                                
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Masalah</h3>
                                    <p class="ml-4 col-span-4 flex">:  
                                        <span>{{ $neonatus->problem }}</span>
                                    </p>
                                </div>
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Dirujuk ke</h3>
                                    <p class="ml-4 col-span-4">: {{ $neonatus->referred_to }}</p>
                                </div>
                                <div class="px-2 grid grid-cols-6 gap-1 pt-1">
                                    <h3 class="font-semibold col-span-2">Nama Petugas</h3>
                                    <p class="ml-4 col-span-4">: {{ $neonatus->health_worker }}</p>
                                </div>
                            </dl>

                            <div class="flex justify-center">
                                <a href="/neonatuses/{{ $neonatus->id }}/edit" class="text-xs text-center rounded-md px-3 py-1 bg-green-500 hover:bg-green-700 text-white">edit</a>
                            </div>

                            @break
                            @endif
                            
                            @endforeach

                            @if ($is_filled == false)
                                <div class="self-end">
                                    <a href="/posyandu/{{ $posyandu->id }}/neonatuses/{{ $periode['nomor'] }}/create" class="text-xs rounded-md px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white">input</a>
                                </div>
                            @endif
                            

                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>