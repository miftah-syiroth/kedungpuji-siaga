<div x-data="{ open: true }" class="px-4 py-2 sm:grid sm:grid-cols-4 sm:gap-2 sm:px-2">
    <dt class="text-sm font-medium text-gray-700 dark:text-gray-200">
        <button x-on:click="open = ! open" class="border-b-2 hover:bg-gray-100 dark:hover:text-gray-700 rounded-lg shadow-md w-full">Kehamilan dan Nifas</button>
    </dt>
    <dd x-show="open" class="py-2 text-sm text-gray-900 border border-gray-200 rounded-md dark:text-gray-200 sm:mt-0 sm:col-span-3">
        <table class="w-full whitespace-no-wrap overflow-x-auto">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="px-1 py-2">hpht</th>
                    <th class="px-1 py-2">lahir/umur</th>
                    <th class="px-1 py-2">nama</th>
                </tr>
            </thead>
            <tbody class="divide-y"> 

                @foreach ($person->pregnancies as $pregnancy)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-1 py-2 text-sm text-center">
                        <a href="/pregnancies/{{ $pregnancy->id }}" class="text-blue-500 hover:text-blue-700">
                            {{ $pregnancy->hpht->isoFormat('DD MMMM Y') }}
                        </a>
                    </td>
                    <td class="flex flex-col px-1 py-2 text-sm text-center">
                        @isset($pregnancy->childbirth_date)
                        <h3>{{ $pregnancy->childbirth_date->isoFormat('DD MMMM YYYY HH:mm') }}</h3>
                        <h5 class="text-red-500">{{ $pregnancy->gestational_age }}</h5>
                        @else
                        <h3>mengandung</h3>
                        <h5>{{ $pregnancy->hpht->diffInWeeks(now()) }} minggu</h5>
                        @endisset
                    </td>
                    <td class="px-1 py-2 text-sm text-center">
                        @isset($pregnancy->baby)
                        <a href="/people/{{ $pregnancy->baby->id }}" class="text-blue-500 hover:text-blue-700">
                            {{ $pregnancy->baby->name }}
                        </a>
                        @else
                        -
                        @endisset
                        
                    </td>
                </tr>
                @endforeach
                    
                </tbody>
        </table>
    </dd>
</div>
