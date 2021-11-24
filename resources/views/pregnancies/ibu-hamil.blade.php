<x-app-layout>
    <x-slot name="header">
        {{ __('Ibu Hamil') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- form filtering --}}
        <div class="flex flex-col border rounded-md border-gray-300">
            <form action="/ibu-hamil" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nama Ibu</span>
                        <input type="text" name="mother_name" id="mother_name" value="{{ request('mother_name') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Ibu"/>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">RT/RW</span>
                        <div class="flex flex-row flex-wrap">
                            <input type="number" name="rt" id="rt" min="1" max="7" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <input type="number" name="rw" id="rw" min="1" max="3" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </div>
                    </label>

                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Bulan HPHT
                        </span>
                        <select name="month_hpht" id="month_hpht" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($months as $month)
                            <option value="{{ $month->id }}">{{ $month->month }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Tahun HPHT</span>
                        <input type="number" name="year_hpht" id="year_hpht" value="{{ request('year_hpht') ?? '' }}" min="1" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Filter</button>
                    </div>
                </div>
            </form>
            <div class="my-2 mx-2 flex">
                <a href="/ibu-hamil" class="px-2 py-1 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
            </div>
            
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama Ibu</th>
                    <th class="px-2 py-3">RT/RT</th>
                    <th class="px-2 py-3">umur ibu</th>
                    <th class="px-2 py-3">hpht</th>
                    <th class="px-2 py-3">umur kadnungan</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @foreach ($pregnancies as $key => $pregnancy)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                <a href="/pregnancies/{{ $pregnancy->id }}" class="font-normal text-blue-500 hover:text-blue-600 hover:shadow">
                                    {{ $pregnancy->person->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->person->rt }}/{{ $pregnancy->person->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->person->date_of_birth->age }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->hpht->isoFormat('D MMMM YYYY') }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        mengandung {{ $pregnancy->hpht->diffInWeeks(now()) . ' minggu' }}
                    </td>
                </tr>
                @endforeach
                
                </tbody>
        </table>
        <div class="mt-4 mx-2">
            {{ $pregnancies->links() }}
        </div>
    </div>

</x-app-layout>