<div class="py-4">
    <div x-data="{ isOpen : false }">
        <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
            <div class="px-4 py-2">
                <h3 class="text-lg leading-6 font-medium justify-center text-center">
                    <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">
                        Data Keluarga Berencana
                    </button>
                </h3>
                <div x-show="isOpen" class="flex flex-row justify-between">
                    <div>
                        <p class="mt-1 text-sm text-gray-800">
                            Penyedia KB : {{ $person->husband->kbService->service ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <a href="/couples/{{ $person->husband->id }}" class="mt-1 text-center text-sm text-blue-500 hover:text-blue-700 hover:underline">
                            selengkapnya..
                        </a>
                    </div>
                </div>
            </div>
            <div x-show="isOpen" class="border-t border-gray-200">
                <dl>
                    <table class="w-full whitespace-no-wrap overflow-x-auto">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b bg-gray-100 rounded-xl">
                                @foreach ($months as $month)
                                <th class="px-2 py-3">{{ $month->abbreviation }}</th>
                                @endforeach
                             </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            
                            <tr class="text-gray-700 dark:text-gray-400">
                                @foreach ($months as $month)
                                <td class="px-2 py-3 text-sm text-center">
                                    @foreach ($person->keluargaBerencana as $kb)
                                        @if ($kb->month_periode != $month->id)
                                            @continue
                                        @endif

                                        @if ($kb->month_periode == $month->id)
                                        {{ $kb->kbStatus->code }}
                                            @break
                                        @endif
                                    @endforeach
                                </td>
                                @endforeach
                            </tr> 
                         </tbody>
                    </table>
                </dl>
            </div>
        </div>
    </div>
    
</div>