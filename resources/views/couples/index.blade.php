<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Pasangan') }}
    </x-slot>

    <div class="py-2">
        <div class="flex">
            <div class="w-full px-2 py-2 bg-white rounded-lg shadow-lg">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="pl-8 py-3 text-left">Istri</th>
                            <th class="px-2 py-3">Alamat Istri</th>
                            <th class="px-2 py-3">Umur Istri</th>
                            <th class="px-2 py-3">Status Kawin</th>
                            <th class="px-2 py-3 text-left">Suami</th>
                            <th class="px-2 py-3">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($couples as $key => $couple)
                        <tr class="text-gray-700">
                            <td class="px-2 py-1">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative md:block py-2 px-2">
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
                                <a href="/people/{{ $couple->husband->id }}" class="text-blue-400 hover:underline hover:text-blue-700">{{ $couple->husband->name }}</a>
                            </td>
                            <td class="px-2 py-1 text-sm">
                                <a href="/couples/{{ $couple->id }}" class="text-blue-400 hover:underline hover:text-blue-700">kelola</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>