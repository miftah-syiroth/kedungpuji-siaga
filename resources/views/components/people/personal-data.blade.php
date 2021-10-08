<div class="py-4">
    <div x-data="{ isOpen : true }">
        <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
            <div class="px-4 py-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900 justify-center text-center">
                    <a href="#dataPersonal" x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Data Personal</a>
                </h3>
            </div>
            <div x-show="isOpen" id="dataPersonal" class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nama
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                           : {{ $person->name  }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            NIK
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                           : {{ $person->nik  }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Tempat, tanggal lahir
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                           : {{ $person->place_of_birth . ', ' . $person->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $person->date_of_birth->age . ' tahun)'  }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Jenis Kelamin
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->sex->sex }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Agama
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->religion->religion }}
                        </dd>
                    </div>
                    
                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Golongan Darah
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->bloodGroup->group }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Disabilitas
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->is_cacat == true ? $person->disability->type : '-' }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Pendidikan
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->education->education }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Ibu Kandung
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->mother->name ?? '-' }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Ayah Kandung
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            : {{ $person->father->name ?? '-' }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Status Anggota Keluarga
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>
                                : {{ $person->familyStatus->status . ' dari ' }} 
                                <a href="/people/{{ $person->family->leader->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $person->family->leader->name }}</a>
                            </p>
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Status Pernikahan
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{-- kalau punya istri-istri, tampilkan semua istri dan statusnya --}}
                            @if (count($person->wifes) != 0)

                                @foreach ($person->wifes as $wife)
                                <p>
                                    : {{ $wife->maritalStatus->status }} dengan 
                                    <a href="/people/{{ $wife->wife->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $wife->wife->name }}</a>
                                </p>
                                @endforeach

                            {{-- kalau punya suami, tampilkan suami dan status kawinnya --}}
                            @elseif ($person->husband)

                                <p>
                                    : {{ $person->husband->maritalStatus->status }} dengan 
                                    <a href="/people/{{ $person->husband->husband->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $person->husband->husband->name }}</a>
                                </p>

                            @else
                                <p>belum kawin</p>
                            @endif
                            
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>