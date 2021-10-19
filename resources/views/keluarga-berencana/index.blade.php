<x-app-layout>
    <x-slot name="header">
        {{ __('Laporan Keluarga Berencana') }}
    </x-slot>

    <div class="py-2">
        <div class="py-2 bg-white rounded-lg shadow-lg">
            <table class="w-full">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-2 py-2 text-center">Istri</th>
                        <th class="px-2 py-2 text-center">KB?</th>
                        @foreach ($months as $month)
                        <th class="px-2 py-2 text-center">{{ $month->abbreviation }}</th>
                        @endforeach
                        </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($couples as $key => $couple)
                    <tr class="text-gray-700">
                        <td class="px-2 py-1">
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
        </div>
    </div>
</x-app-layout>