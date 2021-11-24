<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Kehamilan') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- form filtering --}}
        <div class="flex flex-col border rounded-md border-gray-300">
            <form action="/pregnancies" method="GET">
                <div class="flex flex-row items-end">
                    <div class="flex border border-t-0 rounded-md">
                        {{-- bulan HPHT --}}
                        <label class="block mx-2 my-2 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Bulan HPHT
                            </span>
                            <select name="month_hpht" id="month_hpht" class="block min-w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($months as $month)
                                <option value="{{ $month->id }}">{{ $month->month }}</option>
                                @endforeach
                            </select>
                        </label>
                        {{-- tahun hpht --}}
                        <label class="block text-sm mx-2 my-2" for="name">
                            <span class="text-gray-700 dark:text-gray-400">Tahun HPHT</span>
                            <input type="number" name="year_hpht" id="year_hpht" value="{{ request('year_hpht') ?? '' }}" min="1" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                    
                    <div class="flex border border-t-0 rounded-md ml-2">
                        <label class="block mx-2 my-2 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Bulan Lahir
                            </span>
                            <select name="month_childbirth" id="month_childbirth" class="block min-w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <option selected disabled hidden>Pilih!</option>
                                @foreach ($months as $month)
                                <option value="{{ $month->id }}">{{ $month->month }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="block text-sm mx-2 my-2" for="name">
                            <span class="text-gray-700 dark:text-gray-400">Tahun Lahir</span>
                            <input type="number" name="year_childbirth" id="year_childbirth" value="{{ request('year_childbirth') ?? '' }}" min="1" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>

                    {{-- kondisi ibu --}}
                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Kondisi Ibu
                        </span>
                        <select name="mother_condition_id" id="mother_condition_id" class="block min-w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($mother_conditions as $condition)
                            <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                            @endforeach
                        </select>
                    </label>

                    {{-- status persalinan --}}
                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Status Partus
                        </span>
                        <select name="parturition_id" id="parturition_id" class="block min-w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($parturitions as $parturition)
                            <option value="{{ $parturition->id }}">{{ $parturition->type }}</option>
                            @endforeach
                        </select>
                    </label>
                    
                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">RT/RW</span>
                        <div class="flex flex-row">
                            <input type="number" name="rt" id="rt" min="1" max="7" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <input type="number" name="rw" id="rw" min="1" max="3" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </div>
                    </label>

                    <div class="mx-2 my-2 flex justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-blue-700 dark:hover:bg-gray-300">Filter</button>
                    </div>
                </div>
                
            </form>
            <div class="my-2 mx-2 flex text-sm">
                <form action="/export-pregnancies-index" method="post">
                    @csrf
                    <input type="hidden" name="month_hpht" value="{{ $filters['month_hpht'] ?? null }}">
                    <input type="hidden" name="year_hpht" value="{{ $filters['year_hpht'] ?? null }}">
                    <input type="hidden" name="month_childbirth" value="{{ $filters['month_childbirth'] ?? null }}">
                    <input type="hidden" name="year_childbirth" value="{{ $filters['year_childbirth'] ?? null }}">
                    <input type="hidden" name="rt" value="{{ $filters['rt'] ?? null }}">
                    <input type="hidden" name="rw" value="{{ $filters['rw'] ?? null }}">
                    <input type="hidden" name="parturition_id" value="{{ $filters['parturition_id'] ?? null }}">
                    <input type="hidden" name="mother_condition_id" value="{{ $filters['mother_condition_id'] ?? null }}">
                    <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-blue-700 dark:hover:bg-gray-300">Export</button>
                </form>
                <a href="/pregnancies" class="bg-gray-400 mx-4 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Clear</a>
            </div>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama Ibu</th>
                    <th class="px-2 py-3">RT/RT</th>
                    <th class="px-2 py-3">umur ibu</th>
                    <th class="px-2 py-3">hpht</th>
                    <th class="px-2 py-3">kelahiran</th>
                    <th class="px-2 py-3">Kondisi Ibu</th>
                    <th class="px-2 py-3">Jenis Partus</th>
                    <th class="px-2 py-3">Bayi</th>
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
                        @if ($pregnancy->childbirth_date !== null)
                            <h3 class="text-blue-500">{{ $pregnancy->childbirth_date->isoFormat('D MMM YYYY, hh:mm') }}</h3>
                            <h5>{{ $pregnancy->gestational_age }}</h5>
                        @else
                            <h3 class="text-red-500">sedang mengandung</h3>
                            <h5>{{  $pregnancy->hpht->diffInWeeks(now()) . ' minggu' }}</h5>
                        @endif
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->motherCondition->condition ?? '-' }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->parturition->type ?? '-' }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $pregnancy->childbirths->count() }}
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