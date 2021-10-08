<div class="py-4">
    <div x-data="{ isOpen : false }">
        <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
            <div class="px-4 py-2">
                <h3 class="text-lg leading-6 font-medium justify-center text-center">
                    <a href="#dataFamily" x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Data Anggota Keluarga</a>
                </h3>
                <div x-show="isOpen" class="flex flex-row justify-between">
                    <div>
                        <p class="mt-1 text-sm text-gray-800">
                            Nomor KK : {{ $person->kepalaKeluarga->nomor_kk }}
                        </p>
                        <p class="mt-1 text-sm text-gray-800">
                            Keluarga Sejahtera : {{ $person->kepalaKeluarga->keluargaSejahtera->tahapan }}
                        </p>
                        <p class="mt-1 text-sm text-gray-800">
                            Total Anggota : {{ $person->kepalaKeluarga->people->count() }}
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
                    <table id="dataFamily" class="w-full whitespace-no-wrap overflow-x-auto">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b bg-gray-100 rounded-xl">
                                <th class="px-2 py-3">Nama</th>
                                <th class="px-2 py-3">NIK</th>
                                <th class="px-2 py-3">L/P</th>
                                <th class="px-2 py-3">Tgl Lahir</th>
                                <th class="px-2 py-3">GolDar</th>
                                <th class="px-2 py-3">Pendidikan</th>
                                <th class="px-2 py-3">Hubungan</th>
                             </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach ($person->kepalaKeluarga->people as $key => $member)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with inset shadow -->
                                        <div class="relative md:block py-2 px-2">
                                            {{ $key + 1 . '.' }}
                                        </div>
                                        <div>
                                            <a href="/people/{{ $member->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $member->name }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $member->nik }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $member->sex->abbreviation }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $member->place_of_birth }}, {{ $member->date_of_birth->isoFormat('DD MMM Y') }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $member->bloodGroup->group }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $member->education->education }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $member->familyStatus->status }}
                                </td>
                            </tr> 
                            @endforeach
                         </tbody>
                    </table>
                </dl>
            </div>
        </div>
    </div>
</div>