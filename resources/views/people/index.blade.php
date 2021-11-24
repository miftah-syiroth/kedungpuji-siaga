<x-app-layout>
    <x-slot name="header">
        {{ __('Penduduk Kedungpuji') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

        {{-- form filtering --}}
        <div class="flex flex-wrap justify-between items-center border rounded-md border-gray-300">
            <form action="/people" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Jenis Kelamin
                        </span>
                        <select name="sex_id" id="sex_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray border border-gray-400">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($sexes as $sex)
                            <option value="{{ $sex->id }}">{{ $sex->sex }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">RT/RW</span>
                        <div class="flex flex-row flex-wrap">
                            <input type="number" name="rt" id="rt" min="1" max="7" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                            <input type="number" name="rw" id="rw" min="1" max="3" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                        </div>
                    </label>

                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Status Kawin
                        </span>
                        <select name="marital_status_id" id="marital_status_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray border-gray-400">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($marital_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                        <input type="text" name="name" id="name" value="{{ request('name') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400" placeholder="Nama Lengkap"/>
                    </label>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Filter</button>
                        <a href="/people" class="px-2 py-1 ml-8 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
                    </div>
                </div>
            </form>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama</th>
                    <th class="px-2 py-3">RT/RW</th>
                    <th class="px-2 py-3">L/P</th>
                    <th class="px-2 py-3">Umur</th>
                    <th class="px-2 py-3">Goldar</th>
                    <th class="px-2 py-3 text-left">Ibu Kandung</th>
                    <th class="px-2 py-3 text-left">Status Kawin</th>
                    <th class="px-2 py-3 text-center">Keluarga</th>
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
                                <a href="/people/{{ $person->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-400 hover:underline">{{ $person->name }}</a>
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
                        @isset($person->mother)
                        <a href="/people/{{ $person->mother->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-400 hover:underline">{{ $person->mother->name }}</a>
                        @else
                        -
                        @endisset
                    </td>
                    <td class="px-2 py-1 text-sm">
                        {{ $person->maritalStatus->status }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        @foreach ($person->family as $family)
                        <a href="/families/{{ $family->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $family->leader->name }}</a>
                        @endforeach
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        @foreach ($person->family as $family)
                        {{ $family->pivot->familyStatus->status }}
                        @endforeach
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>
        <div class="mt-4 mx-2">
            {{ $people->links() }}
        </div>
    </div>
</x-app-layout>