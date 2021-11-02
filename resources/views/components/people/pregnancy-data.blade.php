<div x-data="{ open: true }" class=" py-2 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium text-gray-700 dark:text-gray-200">
        <button x-on:click="open = ! open" class="border-b-2 hover:bg-gray-100 dark:hover:text-gray-700 rounded-lg shadow-md w-full">Kehamilan dan Nifas</button>
    </dt>
    <dd x-show="open" class="py-2 text-sm text-gray-900 border border-gray-200 rounded-md dark:text-gray-200 sm:mt-0 sm:col-span-3">
        <table class="w-full whitespace-no-wrap overflow-x-auto">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="px-1 py-3">hpht</th>
                    <th class="px-1 py-3">lahir/umur</th>
                    <th class="px-1 py-3">nama</th>
                    <th class="px-1 py-3">ringkasan lahir</th>
                    <th class="px-1 py-3">ringkasan nifas</th>
                    </tr>
            </thead>
            <tbody class="divide-y"> 

                @foreach ($person->pregnancies as $pregnancy)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-1 py-2 text-sm text-center">
                        {{ $pregnancy->hpht->isoFormat('DD MMMM Y') }}
                    </td>
                    <td class="px-1 py-2 text-sm text-center">
                        {{ $pregnancy->childbirth_date }}
                    </td>
                    <td class="px-1 py-2 text-sm text-center">
                        nama
                    </td>
                    <td class="px-1 py-2 text-sm text-center">
                        kondisi lahir
                    </td>
                    <td class="px-1 py-2 text-sm text-center">
                        kondisi nifas
                    </td>
                </tr>
                @endforeach
                    
                </tbody>
        </table>
    </dd>
</div>
