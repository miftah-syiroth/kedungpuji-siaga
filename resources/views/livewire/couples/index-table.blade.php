<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <table class="w-full whitespace-no-wrap">
        <thead>
            <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                <th class="pl-4 py-3 text-left">Istri</th>
                <th class="px-2 py-3">Alamat Istri</th>
                <th class="px-2 py-3">Umur Istri</th>
                <th class="px-2 py-3">Status Kawin</th>
                <th class="px-2 py-3 text-left">Suami</th>
                <th class="px-2 py-3">Umur Suami</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($couples as $key => $couple)
            <tr class="text-gray-700 dark:text-gray-300">
                <td class="px-2 py-1">
                    <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative md:block px-2">
                        {{ $key + 1 . '.' }}
                        </div>
                        <div>
                            <a href="/couples/{{ $couple->id }}" class="text-blue-400 hover:underline hover:text-blue-700">{{ $couple->wife->name }}</a>
                        </div>
                    </div>
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $couple->wife->rt . '/' . $couple->wife->rw }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $couple->wife->date_of_birth->age }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $couple->wife->maritalStatus->status}}
                </td>
                <td class="px-2 py-1 text-sm">
                    <a href="/couples/{{ $couple->id }}" class="text-blue-400 hover:underline hover:text-blue-700">{{ $couple->husband->name }}</a>
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $couple->husband->date_of_birth->age }}
                </td>
                
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>