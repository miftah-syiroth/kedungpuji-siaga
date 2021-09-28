<x-app-layout>
    <x-slot name="header">
        {{ __('Pasangan Usia Subur') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3 text-center">Istri</th>
                            <th class="px-4 py-3 text-center">Alamat Istri</th>
                            <th class="px-4 py-3 text-center">KB?</th>
                            <th class="px-4 py-3 text-center">Suami</th>
                         </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($couples as $key => $couple)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative md:block py-2 px-2">
                                       {{ $key + 1 . '.' }}
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $couple->wife->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $couple->wife->rt . '/' . $couple->wife->rw }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $couple->is_kb ? $couple->kbService->service : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $couple->husband->name }}
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>