<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <table class="w-full whitespace-no-wrap">
        <thead>
            <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                <th class="pl-8 py-3 text-left">Keluarga</th>
                <th class="px-2 py-3">Nomor KK</th>
                <th class="px-2 py-3">Alamat</th>
                <th class="px-2 py-3">Anggota</th>
                <th class="px-2 py-3">Keluarga Sejahtera</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($families as $key => $family)
            <tr class="text-gray-700 dark:text-gray-300">
                <td class="px-2 py-1">
                    <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div class="relative md:block px-2">
                            {{ $key + 1 . '.' }}
                        </div>
                        <div>
                            <a href="/families/{{ $family->id }}" class="font-normal text-blue-500 hover:text-blue-800 hover:shadow">{{ $family->leader->name }}</a>
                        </div>
                    </div>
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $family->nomor_kk }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $family->leader->rt . '/' . $family->leader->rw }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $family->people_count }}
                </td>
                <td class="px-2 py-1 text-sm text-center">
                    {{ $family->keluargaSejahtera->tahapan }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>