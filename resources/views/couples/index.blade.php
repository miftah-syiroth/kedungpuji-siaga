<x-app-layout>
    <x-slot name="header">
        {{ __('Pasangan Menikah') }}
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center border rounded-md border-gray-300">
            <form action="/couples" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nama Istri</span>
                        <input type="text" name="wife_name" id="wife_name" value="{{ request('wife_name') }}" class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
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
                            KB Status
                        </span>
                        <select name="is_kb" id="is_kb" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            <option value="true">KB</option>
                            <option value="false">Tidak KB</option>
                        </select>
                    </label>

                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            PUS
                        </span>
                        <select name="is_pus" id="is_pus" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            <option value="1">pus</option>
                            <option value="0">non pus</option>
                        </select>
                    </label>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Cari</button>
                        <a href="/couples" class="px-2 py-1 ml-8 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
                    </div>
                </div>
            </form>
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Istri</th>
                    <th class="px-2 py-3">Alamat Istri</th>
                    <th class="px-2 py-3">Umur Istri</th>
                    <th class="px-2 py-3">Anggota KB</th>
                    <th class="px-2 py-3">Status</th>
                    <th class="px-2 py-3 text-left">Suami</th>
                    <th class="px-2 py-3">Umur Suami</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($couples as $key => $couple)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                            {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                <a href="/couples/{{ $couple->id }}" class="text-blue-400 hover:underline hover:text-blue-700">{{ $couple->wife->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->wife->rt . '/' . $couple->wife->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->wife->date_of_birth->age }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->is_kb == true ? 'KB' : 'Tidak KB' }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->latestKeluargaBerencana->kbStatus->status ?? '-' }}
                    </td>
                    <td class="px-2 py-1 text-sm">
                        <a href="/couples/{{ $couple->id }}" class="text-blue-400 hover:underline hover:text-blue-700">{{ $couple->husband->name }}</a>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->husband->date_of_birth->age }}
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <div class="mt-4 mx-2">
            {{ $couples->links() }}
        </div>
    </div>
</x-app-layout>