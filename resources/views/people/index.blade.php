<x-app-layout>
    <x-slot name="header">
        {{ __('Penduduk Desa Kedungpuji') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-2 py-4 bg-white rounded-lg shadow-lg">
                <table class="w-full whitespace-no-wrap overflow-x-auto">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b  bg-gray-50">
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">RT/RT</th>
                            <th class="px-4 py-3">Jenis Kelamin</th>
                            <th class="px-4 py-3">Golongan Darah</th>
                            <th class="px-4 py-3">Umur</th>
                            <th class="px-4 py-3">Status Kawin</th>
                            <th class="px-4 py-3">Status Disabilitas</th>
                            <th class="px-4 py-3">Keluarga</th>
                            <th class="px-4 py-3">Status Anggota</th>
                         </tr>
                    </thead>
                    <tbody class="bg-white divide-y ">
                        @foreach ($people as $key => $person)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
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
                            <td class="px-4 py-3 text-sm">
                                {{ $person->rt . '/' . $person->rw }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $person->sex->id == 1 ? 'L' : 'P' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $person->bloodGroup->group }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $person->date_of_birth->age }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $person->maritalStatus->status }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $person->is_cacat == true ? 'cacat' : 'normal' }}
                            </td>
                            <td class="px-4 py-3 text-sm {{ $person->family ? 'text-blue-500' : '' }}">
                                {{ $person->family ? $person->family->kepalaKeluarga->name : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $person->familyStatus->status }}
                            </td>
                        </tr>
                        @endforeach
                        
                     </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>