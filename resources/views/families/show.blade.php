<x-app-layout>
    <x-slot name="header">
        {{ __('Data Keluarga: ') }} {{ $family->leader->name }}
    </x-slot>
    
    {{-- tabel member --}}
    <div class="py-4">
        <div x-data="{ 
            isOpen : true, 
            addMemberOpen:false,
        }">
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
                        <div class="flex flex-col">
                            <button x-on:click="addMemberOpen = ! addMemberOpen" class="text-sm text-white bg-green-400 rounded-md hover:bg-green-600 px-2 py-1">tambah anggota</button>
                            <a href="/families/{{ $family->id }}/edit" class="bg-blue-300 px-2 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-500">edit</a>
                        </div>
                    </div>
                </div>
                
                {{-- table anggota keluarga --}}
                <div x-show="isOpen" class="border-t border-gray-200">
                    <dl>
                        <table class="w-full whitespace-no-wrap overflow-x-auto">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b bg-gray-100 rounded-xl">
                                    <th class="px-1 py-3">Nama</th>
                                    <th class="px-1 py-3 text-left">Hubungan</th>
                                    <th class="px-1 py-3">NIK</th>
                                    <th class="px-1 py-3">L/P</th>
                                    <th class="px-1 py-3">Tgl Lahir</th>
                                    <th class="px-1 py-3">GolDar</th>
                                    <th class="px-1 py-3">Cacat</th>
                                    <th class="px-1 py-3">Status Kawin</th>
                                    <th class="px-1 py-3 text-left">Pendidikan</th>
                                    <th class="px-1 py-3 text-right">hapus</th>
                                 </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @foreach ($family->people as $key => $person)
                                <tr class="text-gray-700">
                                    <td class="px-1 py-1">
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
                                    <td class="px-1 py-1 text-sm text-left">
                                        {{ $person->pivot->familyStatus->status }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-center">
                                        {{ $person->nik }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-center">
                                        {{ $person->sex->abbreviation }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-center">
                                        {{ $person->place_of_birth }}, {{ $person->date_of_birth->isoFormat('DD MMM Y') }} ({{ $person->date_of_birth->age }})
                                    </td>
                                    <td class="px-1 py-1 text-sm text-center">
                                        {{ $person->bloodGroup->group }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-center">
                                        {{ $person->is_cacat == true ? $person->disability->type : '-' }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-left">
                                        {{ $person->maritalStatus->status }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-left">
                                        {{ $person->education->education }}
                                    </td>
                                    <td class="px-1 py-1 text-sm text-center">
                                        @unless ($person->kepalaKeluarga)
                                        <form action="/families/{{ $person->pivot->family_id }}/people/{{ $person->id }}/delete" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-eraser-fill" viewBox="0 0 16 16">
                                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
                                                </svg>
                                            </button>
                                        </form>   
                                        @endunless
                                        
                                        
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </dl>
                </div>
                {{-- END tabel anggota keluarga --}}

                {{-- form tambah anggota keluarga --}}
                <div x-show="addMemberOpen" class="px-2 py-2">
                    <form action="/families/{{ $family->id }}/people" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-row my-4">
                            {{-- pencarian penduduk --}}
                            <div>
                                @livewire('families.search-member')
                            </div>

                           {{-- status keanggotaan dalam keluarga --}}
                            <div class="mx-2">
                                <x-label for="family_status_id" :value="__('Keanggotaan Keluarga')" />
                                <select name="family_status_id" id="family_status_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                    <option hidden>Pilih!</option>
                                    @foreach ($family_statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="ml-4 self-end">
                                <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white rounded-lg px-2 py-1">tambah anggota</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    {{-- /table member --}}
</x-app-layout>