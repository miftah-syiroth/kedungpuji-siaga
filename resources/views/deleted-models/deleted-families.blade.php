<x-app-layout>
    <x-slot name="header">
        {{ __('Keluarga Terhapus') }}
    </x-slot>

    @if (session('message'))
    <div class="text-center text-red-500">
        {{ session('message') }}
    </div>
    @endif
    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h3 class="text-red-600 mx-2 my-2 text-sm">Catatan: hapus permanen akan mengeluarkan semua anggota keluarga !</h3>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Kepala Keluarga</th>
                    <th class="px-2 py-3">RT/RW</th>
                    <th class="px-2 py-3">Nomor KK</th>
                    <th class="px-2 py-3">Jumlah Anggota</th>
                    <th class="px-2 py-3">Waktu Dihapus</th>
                    <th class="px-2 py-3">Kembalikan</th>
                    <th class="px-2 py-3">Hapus Permanen</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @foreach ($families as $key => $family)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                <a href="/people/{{ $family->leader->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-400 hover:underline">
                                    {{ $family->leader->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->leader->rt }}/{{ $family->leader->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->nomor_kk }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->people->count() }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $family->deleted_at->isoFormat('DD MMM YYYY HH:mm:ss') }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        <form action="/deleted/families/{{ $family->id }}/restore" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-sm text-white rounded-md bg-blue-500 hover:bg-blue-700 px-2 py-1">Kembalikan</button>
                        </form>
                        {{-- <a href="/deleted/posyandu/{{ $posyandu->id }}/restore">restore</a> --}}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        <form action="/deleted/families/{{ $family->id }}" method="post">
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