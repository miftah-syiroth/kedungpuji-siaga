<x-app-layout>
    <x-slot name="header">
        {{ __('Tabel Keluarga Berencana') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center border rounded-md border-gray-300">
            <form action="/keluarga-berencana" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nama Istri</span>
                        <input type="text" name="wife_name" id="wife_name" value="{{ request('wife_name') ?? '' }}" class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">RT/RW</span>
                        <div class="flex flex-row flex-wrap">
                            <input type="number" name="rt" id="rt" value="{{ request('rt') ?? '' }}" min="1" max="7" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <input type="number" name="rw" id="rw" value="{{ request('rw') ?? '' }}" min="1" max="3" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </div>
                    </label>
                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            KB Status
                        </span>
                        <select name="is_kb" id="is_kb" class="block w-auto mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            <option value="1">KB</option>
                            <option value="0">Tidak KB</option>
                        </select>
                    </label>

                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Penyedia
                        </span>
                        <select name="kb_service_id" id="kb_service_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($kb_services as $service)
                            <option value="{{ $service->id }}">{{ $service->service }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Tahun</span>
                        <input type="number" name="year_periode" id="year_periode" value="{{ request('year_periode') ?? 2021 }}" min="1" class="block w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Cari</button>
                        <a href="/keluarga-berencana" class="px-2 py-1 ml-8 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
                    </div>
                </div>
            </form>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="px-2 py-2 text-center">Istri</th>
                    <th class="px-2 py-2 text-center">KB?</th>
                    @foreach ($months as $month)
                    <th class="px-2 py-2 text-center">{{ $month->abbreviation }}</th>
                    @endforeach
                    </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($couples as $key => $couple)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '. ' }}
                            </div>
                            <div>
                                <a href="/couples/{{ $couple->id }}" class="text-blue-500 hover:text-blue-700">{{ $couple->wife->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->is_kb ? $couple->kbService->service : '-' }}
                    </td>
                    @foreach ($months as $month)
                    <td class="px-2 py-1 text-sm text-center">
                        @foreach ($couple->keluargaBerencana as $kb)
                            @if ($kb->month_periode == $month->id)
                                {{ $kb->kbStatus->code }}
                                @break
                            @endif
                        @endforeach
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 mx-2">
            {{ $couples->links() }}
        </div>
    </div>
</x-app-layout>