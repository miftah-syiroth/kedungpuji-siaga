<div class="py-4">
    <div x-data="{ isOpen : false }">
        <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
            <div class="px-4 py-2">
                <h3 class="text-lg leading-6 font-medium justify-center text-center">
                    <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">
                        Data Kehamilan
                    </button>
                </h3>
                <div x-show="isOpen" class="flex justify-end mt-4">
                    {{-- <div> --}}
                        <form action="/people/{{ $person->id }}/pregnancies" method="post" class="block">
                            @csrf
                            <div class="flex flex-row text-sm">
                                <div class="px-2">
                                    <x-label for="hpht" :value="__('HPHT')" />
                                    <input type="date" name="hpht" id="hpht" class="block mt-1 w-44 h-8 border" required>
                                </div>
                                <div class="px-2">
                                    <x-label for="mother_weight" :value="__('BB')" />
                                    <input type="number" name="mother_weight" id="mother_weight" class="block mt-1 w-16 h-8 border" required>
                                </div>
                                <div class="px-2">
                                    <x-label for="mother_height" :value="__('TB')" />
                                    <input type="number" name="mother_height" id="mother_height" class="block mt-1 w-16 h-8 border" required>
                                </div>
                                <div class="flex content-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 px-2 py-1 rounded-lg text-white self-end">tambah baru</button>
                                </div>
                               
                            </div>
                        </form>
                    {{-- </div> --}}
                </div>
                
            </div>
            <div x-show="isOpen" class="border-t border-gray-200">
                <dl>
                    <table class="w-full whitespace-no-wrap overflow-x-auto">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b bg-gray-100 rounded-xl">
                                <th class="px-2 py-3">Urutan</th>
                                <th class="px-2 py-3">hpht</th>
                                <th class="px-2 py-3">waktu kelahiran</th>
                                <th class="px-2 py-3">umur kehamilan</th>
                                <th class="px-2 py-3">cara persalinan</th>
                                <th class="px-2 py-3">dll</th>
                                <th class="px-2 py-3">dll</th>
                             </tr>
                        </thead>
                        <tbody class="bg-white divide-y"> 

                            @foreach ($person->pregnancies as $pregnancy)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-2 py-3 text-sm text-center">
                                    <a href="/pregnancies/{{ $pregnancy->id }}" class="text-blue-500 hover:text-blue-700 hover:underline">
                                        Ke {{ $loop->index + 1 }}
                                    </a>
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $pregnancy->hpht->isoFormat('DD MMMM Y') }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $pregnancy->childbirth_date }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $pregnancy->gestational_age }}
                                </td>
                                <td class="px-2 py-3 text-sm text-center">
                                    {{ $pregnancy->post_partum_condition }}
                                </td>
                            </tr>
                            @endforeach
                             
                         </tbody>
                    </table>
                </dl>
            </div>
        </div>
    </div>
</div>