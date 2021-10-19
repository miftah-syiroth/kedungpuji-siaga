<x-app-layout>
    <x-slot name="header">
        {{ __('Ibu Hamil') }}
    </x-slot>

    <div class="py-4">
        <div class="w-auto overflow-hidden rounded-lg shadow-xs">
            <div class="px-2 py-4 w-auto bg-white rounded-lg shadow-xl overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b bg-gray-100 rounded-xl">
                            <th class="pl-8 py-3 text-left">Nama</th>
                            <th class="px-2 py-3">RT/RT</th>
                            <th class="px-2 py-3">bb</th>
                            <th class="px-2 py-3">tb</th>
                            <th class="px-2 py-3">bmi</th>
                            <th class="px-2 py-3">hpht</th>
                            <th class="px-2 py-3">umur</th>
                            <th class="px-2 py-3">prakiraan</th>
                         </tr>
                    </thead>
                    <tbody class="bg-white divide-y ">
                        @foreach ($pregnancies as $key => $pregnancy)
                        <tr class="text-gray-700">
                            <td class="px-2 py-1">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative md:block px-2">
                                        {{ $key + 1 . '.' }}
                                    </div>
                                    <div>
                                        <a href="/pregnancies/{{ $pregnancy->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">
                                            {{ $pregnancy->mother->name }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{ $pregnancy->mother->rt }}/{{ $pregnancy->mother->rw }}
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{-- {{ $person->date_of_birth->age }} --}}
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                {{-- {{ $person->bloodGroup->group }} --}}
                            </td>
                            <td class="px-2 py-1 text-sm text-center">
                                -
                            </td>
                            <td class="px-2 py-1 text-sm">
                                {{-- {{ $person->maritalStatus->status }} --}}
                            </td>
                        </tr>
                        @endforeach
                        
                     </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>