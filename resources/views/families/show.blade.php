<x-app-layout>
    <x-slot name="header">
        {{ __('Data Keluarga: ') }} {{ $family->leader->name }}
    </x-slot>
    
    <div x-data="{  isOpen : true, addMemberOpen : false}" class="px-2 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-2 py-2">
            <h3 class="text-lg leading-6 font-medium justify-center text-center">
                <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700 dark:text-gray-200 dark:hover:text-blue-700">Data Anggota Keluarga</button>
            </h3>
            <div x-show="isOpen" class="flex flex-row justify-between">
                <div>
                    <p class="mt-1 text-sm">
                        Nomor KK : {{ $family->nomor_kk }}
                    </p>
                    <p class="mt-1 text-sm">
                        Alamat : RT {{ $family->leader->rt }}/{{ $family->leader->rw }}
                    </p>
                    <p class="mt-1 text-sm">
                        Keluarga Sejahtera : {{ $family->keluargaSejahtera->tahapan }}
                    </p>
                    <p class="mt-1 text-sm">
                        Total Anggota : {{ $family->people->count() }}
                    </p>
                </div>
                <div class="flex flex-col">
                    <button x-on:click="addMemberOpen = ! addMemberOpen" class="text-sm text-white bg-green-400 rounded-md hover:bg-green-600 px-2 py-1">tambah anggota</button>
                    <a href="/families/{{ $family->id }}/edit" class="bg-blue-300 px-2 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-blue-500">edit</a>
                </div>
            </div>
        </div>
        
        {{-- tabel anggota --}}
        <table x-show="isOpen" class="w-full whitespace-no-wrap">
            <thead>
                <tr class="rounded-xl text-sm text-gray-500 dark:text-light tracking-wide text-center uppercase">
                    <th class="pl-4 py-3">Nama</th>
                    <th class="px-2 py-3 text-left">Hubungan</th>
                    <th class="px-2 py-3">NIK</th>
                    <th class="px-2 py-3">L/P</th>
                    <th class="px-2 py-3">Tgl Lahir</th>
                    <th class="px-2 py-3">GolDar</th>
                    <th class="px-2 py-3 text-center">hapus</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($family->people as $key => $person)
                <tr class="text-gray-700 dark:text-gray-300">
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
                        @unless ($person->ledFamily)
                        <form action="/families/{{ $person->pivot->family_id }}/people/{{ $person->id }}/delete" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-center">
                                <button type="submit" class="inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-eraser-fill" viewBox="0 0 16 16">
                                        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>   
                        @endunless
                        
                        
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
            

        {{-- fitur tambah anggota --}}
        <div x-show="addMemberOpen" class="px-2 py-2">
            <form action="/families/{{ $family->id }}/people" method="post">
                @csrf
                <div class="flex flex-row my-4">
                    <div>
                        @livewire('families.search-member')
                    </div>

                    <label class="block mx-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Keanggotaan Keluarga
                        </span>
                        <select name="family_status_id" id="family_status_id" required class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($family_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status}}</option>
                            @endforeach
                        </select>
                    </label>

                    <div class="ml-4 self-end">
                        <button type="submit" class="text-sm bg-blue-400 hover:bg-blue-600 text-white rounded-md px-2 py-1">tambah 
                            anggota
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>

</x-app-layout>