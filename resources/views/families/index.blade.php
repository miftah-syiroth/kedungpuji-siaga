<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Keluarga di Kedungpuji') }}
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        {{-- form pencarian --}}
        <div class="flex flex-wrap justify-between items-center border rounded-md border-gray-300">
            <form action="/families" method="GET">
                <div class="flex flex-row flex-wrap items-end">
                    <label class="block mx-2 my-2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Keluarga Sejahtera
                        </span>
                        <select name="keluarga_sejahtera_id" id="keluarga_sejahtera_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option selected disabled hidden>Pilih!</option>
                            @foreach ($keluarga_sejahtera as $tahapan)
                            <option value="{{ $tahapan->id }}">{{ $tahapan->tahapan }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">RT/RW</span>
                        <div class="flex flex-row flex-wrap">
                            <input type="number" name="rt" id="rt" min="1" max="7" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <input type="number" name="rw" id="rw" min="1" max="3" class="block w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </div>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nama Kepala</span>
                        <input type="text" name="name" id="name" value="{{ request('name') }}" class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <label class="block text-sm mx-2 my-2" for="name">
                        <span class="text-gray-700 dark:text-gray-400">Nomor KK</span>
                        <input type="text" name="nomor_kk" id="nomor_kk" value="{{ request('nomor_kk') }}" class="block w-48 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>

                    <div class="mx-2 my-2 flex flex-wrap justify-between text-sm">
                        <button type="submit" class="bg-blue-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300">Filter</button>
                        <a href="/families" class="px-2 py-1 ml-8 rounded-md bg-gray-400 text-white dark:bg-gray-200 dark:text-gray-700 hover:bg-gray-600">clear</a>
                    </div>
                </div>
            </form>
        </div>
        {{-- form pencarian --}}
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-8 py-3 text-left">Keluarga</th>
                    <th class="px-2 py-3">Nomor KK</th>
                    <th class="px-2 py-3">Alamat</th>
                    <th class="px-2 py-3">Anggota</th>
                    <th class="px-2 py-3">Keluarga Sejahtera</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($families as $key => $family)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                <a href="/families/{{ $family->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $family->leader->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->nomor_kk }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->leader->rt . '/' . $family->leader->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->people->count() }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->keluargaSejahtera->tahapan }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 mx-2">
            {{ $families->links() }}
        </div>
    </div>
</x-app-layout>