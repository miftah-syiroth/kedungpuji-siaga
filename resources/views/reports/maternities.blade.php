<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Kehamilan') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- form filtering --}}
        <div class="flex flex-col border rounded-md border-gray-300">
            <form action="/pregnancies" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <div class="flex border border-t-0 rounded-md">
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
                    </div>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-blue-700 dark:hover:bg-gray-300">Filter</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

</x-app-layout>