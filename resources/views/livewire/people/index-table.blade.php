<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <table class="w-full whitespace-no-wrap">
        <thead>
            <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                <th class="pl-4 py-3 text-left">Nama</th>
                <th class="px-2 py-3">RT/RT</th>
                <th class="px-2 py-3">L/P</th>
                <th class="px-2 py-3">Umur</th>
                <th class="px-2 py-3">Goldar</th>
                <th class="px-2 py-3 text-left">Status Kawin</th>
                <th class="px-2 py-3 text-left">Keluarga</th>
                <th class="px-2 py-3 text-left">Status Keluarga</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($people as $key => $person)
            <tr class="text-gray-700 dark:text-gray-300">
                <td class="px-2 py-1">
                    <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative md:block px-2">
                            {{ $key + 1 . '.' }}
                        </div>
                        <div>
                            <a href="/people/{{ $person->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-800 hover:shadow">{{ $person->name }}</a>
                        </div>
                    </div>
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $person->rt }} / {{ $person->rw }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $person->sex->id == 1 ? 'L' : 'P' }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $person->date_of_birth->age }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $person->bloodGroup->group }}
                </td>
                <td class="px-2 py-1 text-sm">
                    {{ $person->maritalStatus->status }}
                </td>
                <td class="px-2 py-1 text-sm">
                    @foreach ($person->family as $family)
                    <a href="/families/{{ $family->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $family->leader->name }}</a>
                    @endforeach
                </td>
                <td class="px-2 py-1 text-sm">
                    @foreach ($person->family as $family)
                    {{ $family->pivot->familyStatus->status }}
                    @endforeach
                </td>
            </tr>
            @endforeach
            </tbody>
    </table>
</div>