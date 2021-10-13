<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Keluarga') }}
    </x-slot>

    <div class="py-4">
        <div class="w-auto overflow-hidden rounded-lg shadow-lg">
            <div class="px-2 py-4 w-auto bg-white rounded-lg shadow-xl overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Keluarga</th>
                            <th class="px-4 py-3">Nomor KK</th>
                            <th class="px-4 py-3 text-center">Alamat</th>
                            <th class="px-4 py-3 text-center">Anggota</th>
                            <th class="px-4 py-3">Keluarga Sejahtera</th>
                         </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($families as $key => $family)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative md:block py-2 px-2">
                                       {{ $key + 1 . '.' }}
                                    </div>
                                    <div>
                                        <a href="/families/{{ $family->id }}" class="font-mediumm text-blue-400 hover:underline hover:text-blue-700">{{ $family->leader->name }}</a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $family->nomor_kk }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $family->leader->rt . '/' . $family->leader->rw }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $family->people_count }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $family->keluargaSejahtera->tahapan }}
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>