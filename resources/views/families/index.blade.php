<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pengguna') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Kepala Keluarga</th>
                            <th class="px-4 py-3">Alamat</th>
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
                                        <p class="font-semibold">{{ $family->leadBy->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $family->leadBy->rt . '/' . $family->leadBy->rw }}
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