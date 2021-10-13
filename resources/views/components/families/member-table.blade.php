<div class="py-4">
    <div x-data="{ isOpen : true }">
        <div class="overflow-hidden px-2 bg-white rounded-lg shadow-2xl">
            <div class="px-2 py-2">
                <h3 class="text-lg leading-6 font-medium justify-center text-center">
                    <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Data Anggota Keluarga</button>
                </h3>
                <div x-show="isOpen" class="flex flex-row justify-between">
                    <div>
                        <p class="mt-1 text-sm text-gray-800">
                            Nomor KK : {{ $family->nomor_kk }}
                        </p>
                        <p class="mt-1 text-sm text-gray-800">
                            Keluarga Sejahtera : {{ $family->keluargaSejahtera->tahapan }}
                        </p>
                        <p class="mt-1 text-sm text-gray-800">
                            Total Anggota : {{ $family->people_count }}
                        </p>
                    </div>
                    <div>
                        <p class="mt-1 text-center text-sm text-gray-500">
                            INI rencananya jadi button show/open
                        </p>
                    </div>
                </div>
            </div>
            <div x-show="isOpen" class="border-t border-gray-200">
                <dl>
                    <table class="w-full whitespace-no-wrap overflow-x-auto">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b bg-gray-100 rounded-xl">
                                <th class="px-2 py-3">Nama</th>
                                <th class="px-2 py-3 text-left">Hubungan</th>
                                <th class="px-2 py-3">NIK</th>
                                <th class="px-2 py-3">L/P</th>
                                <th class="px-2 py-3">Tgl Lahir</th>
                                <th class="px-2 py-3">GolDar</th>
                                <th class="px-2 py-3">Cacat</th>
                                <th class="px-2 py-3">Status Kawin</th>
                                <th class="px-2 py-3 text-left">Pendidikan</th>
                             </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach ($family->people as $key => $person)
                            <tr class="text-gray-700">
                                <td class="px-2 py-1">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with inset shadow -->
                                        <div class="relative md:block py-2 px-2">
                                            {{ $key + 1 . '.' }}
                                        </div>
                                        <div>
                                            <a href="/people/{{ $person->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $person->name }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-1 text-sm text-left">
                                    {{ $person->familyStatus->status }}
                                </td>
                                <td class="px-2 py-1 text-sm text-center">
                                    {{ $person->nik }}
                                </td>
                                <td class="px-2 py-1 text-sm text-center">
                                    {{ $person->sex->abbreviation }}
                                </td>
                                <td class="px-2 py-1 text-sm text-center">
                                    {{ $person->place_of_birth }}, {{ $person->date_of_birth->isoFormat('DD MMM Y') }} ({{ $person->date_of_birth->age }})
                                </td>
                                <td class="px-2 py-1 text-sm text-center">
                                    {{ $person->bloodGroup->group }}
                                </td>
                                <td class="px-2 py-1 text-sm text-center">
                                    {{ $person->is_cacat == true ? $person->disability->type : '-' }}
                                </td>
                                <td class="px-2 py-1 text-sm text-left">
                                    {{ $person->maritalStatus->status }}
                                </td>
                                <td class="px-2 py-1 text-sm text-left">
                                    {{ $person->education->education }}
                                </td>
                                
                            </tr> 
                            @endforeach
                         </tbody>
                    </table>
                </dl>
            </div>
            <div class="px-2 py-2">
                <form action="" method="post">
                    <div class="flex my-4">
                        {{-- pencarian penduduk --}}
                        @livewire('families.search-member')

                        <div>
                            ini untuk status keanggotaan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>