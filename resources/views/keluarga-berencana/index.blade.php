<x-app-layout>
    <x-slot name="header">
        {{ __('Laporan Keluarga Berencana') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3 text-center">Istri</th>
                            <th class="px-4 py-3 text-center">KB?</th>
                            @foreach ($months as $month)
                            <th class="px-4 py-3 text-center">{{ $month->abbreviation }}</th>
                            @endforeach
                         </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($couples as $key => $couple)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative md:block py-2 px-2">
                                       {{ $key + 1 . '. ' }}
                                    </div>
                                    <div>
                                        <a href="/couples/{{ $couple->id }}" class="text-blue-500 hover:text-blue-700">{{ $couple->wife->name }}</a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $couple->is_kb ? $couple->kbService->service : '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                {{-- {{ $couple->kbByMonth($year, 1) }} --}}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                jan
                            </td>
                            
                        </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>