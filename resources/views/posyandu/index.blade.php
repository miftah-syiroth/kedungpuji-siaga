<x-app-layout>
    <x-slot name="header">
        {{ __('Balita Posyandu') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- form filtering --}}
        <div class="flex flex-wrap justify-between items-center border rounded-md border-gray-300">
            <form action="/posyandu" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nama</span>
                        <input type="text" name="name" id="name" value="{{ request('name') }}" class="block w-40 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Anak"/>
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
                            L/P
                        </span>
                        <select name="sex_id" id="sex_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden></option>
                            @foreach ($sexes as $sex)
                            <option value="{{ $sex->id }}">{{ $sex->abbreviation }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Tahun Lahir</span>
                        <input type="number" name="year_of_birth" id="year_of_birth" value="{{ request('year_of_birth') ?? '' }}" min="1" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Status
                        </span>
                        <select name="status_id" id="status_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden></option>
                            <option value="1">posyandu</option>
                            <option value="0">non posyandu</option>
                        </select>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="mother_name">
                        <span class="text-gray-700 dark:text-gray-400">Nama Ibu</span>
                        <input type="text" name="mother_name" id="mother_name" value="{{ request('mother_name') }}" class="block w-40 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Ibu"/>
                    </label>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Filter</button>
                        <a href="/posyandu" class="px-2 py-1 ml-8 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
                    </div>
                </div>
            </form>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama</th>
                    <th class="px-2 py-3">Tgl. Lahir</th>
                    <th class="px-2 py-3">RT/RT</th>
                    <th class="px-2 py-3">L/P</th>
                    <th class="px-2 py-3">GolDar</th>
                    <th class="px-2 py-3 text-left">Nama ibu</th>
                    <th class="px-2 py-3">Posyandu</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @foreach ($people as $key => $balita)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                @isset($balita->posyandu)
                                <a href="/posyandu/{{ $balita->posyandu->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $balita->name }}</a>
                                @else
                                {{ $balita->name }}
                                @endisset
                                
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $balita->date_of_birth->isoFormat('D MMMM YYYY') }} / {{ $balita->date_of_birth->diffInMonths(now()) }} bulan
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $balita->rt }}/{{ $balita->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $balita->sex->abbreviation }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $balita->bloodGroup->group }}
                    </td>
                    <td class="px-2 py-1 text-sm ">
                        @isset($balita->mother)
                        <a href="/people/{{ $balita->mother->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $balita->mother->name }}</a>
                        @else
                        -
                        @endisset
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        @empty($balita->posyandu)
                        <form action="/people/{{ $balita->id }}/posyandu" method="post">
                            @csrf
                            <button type="submit" class="text-sm text-white rounded-md bg-blue-500 hover:bg-blue-700 px-2 py-1">tambah posyandu</button>
                        </form>
                        @else
                        <h3>anggota</h3>
                        @endempty
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