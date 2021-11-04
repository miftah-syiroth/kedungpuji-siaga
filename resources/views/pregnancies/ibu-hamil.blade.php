<x-app-layout>
    <x-slot name="header">
        {{ __('Ibu Hamil') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- form filtering --}}
        <div class="flex flex-wrap justify-between items-center border rounded-md border-gray-300">
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

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Filter</button>
                        <a href="/ibu-hamil" class="px-2 py-1 ml-8 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
                    </div>
                </div>
            </form>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama Ibu</th>
                    <th class="px-2 py-3">RT/RT</th>
                    <th class="px-2 py-3">umur ibu</th>
                    <th class="px-2 py-3">hpht</th>
                    <th class="px-2 py-3">umur Kehamilan</th>
                    <th class="px-2 py-3">kelahiran</th>
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
                                    {{ $pregnancy->mother->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->mother->rt }}/{{ $pregnancy->mother->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->mother->date_of_birth->age }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->hpht->isoFormat('D MMMM YYYY') }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->gestational_age ?? $pregnancy->hpht->diffInWeeks(now()) . ' minggu' }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->childbirth_date ? $pregnancy->childbirth_date->isoFormat('D MMM YYYY, hh:mm') : 'sedang mengandung' }}
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