<x-app-layout>
    <x-slot name="header">
        {{ __('Pasangan Terhapus') }}
    </x-slot>

    @if (session('message'))
    <div class="text-center text-red-500">
        {{ session('message') }}
    </div>
    @endif
    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h3 class="text-red-600 mx-2 my-2 text-sm">Catatan: hapus permanen akan menghapus total data laporan Keluarga Berencana Bulanan pada pasangan terkait !</h3>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama Istri</th>
                    <th class="px-2 py-3">Umur Istri</th>
                    <th class="px-2 py-3">Anggota KB</th>
                    <th class="px-2 py-3">Status</th>
                    <th class="px-2 py-3 text-left">Nama Suami</th>
                    <th class="px-2 py-3">Kembalikan</th>
                    <th class="px-2 py-3">Hapus Permanen</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @foreach ($couples as $key => $couple)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                <a href="/people/{{ $couple->wife->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-400 hover:underline">
                                    {{ $couple->wife->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->wife->date_of_birth->age }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $couple->is_kb == true ? 'KB' : 'tidak KB' }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        @isset($couple->latestKeluargaBerencana)
                        {{ $couple->latestKeluargaBerencana->kbStatus->status }}
                        @endisset
                    </td>
                    <td class="px-2 py-1 text-sm">
                        <a href="/people/{{ $couple->husband->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-400 hover:underline">
                            {{ $couple->husband->name }}
                        </a>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        <form action="/deleted/couples/{{ $couple->id }}/restore" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-sm text-white rounded-md bg-blue-500 hover:bg-blue-700 px-2 py-1">Kembalikan</button>
                        </form>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        <form action="/deleted/couples/{{ $couple->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-sm text-white rounded-md bg-red-500 hover:bg-red-700 px-2 py-1">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>
    </div>
</x-app-layout>