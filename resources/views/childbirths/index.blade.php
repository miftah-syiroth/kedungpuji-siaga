<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Kelahiran') }}
    </x-slot>

    <div class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                    <th class="pl-4 py-3 text-left">Nama Ibu Bayi</th>
                    <th class="px-2 py-3">RT/RW</th>
                    <th class="px-2 py-3">Anak Ke</th>
                    <th class="px-2 py-3">L/P</th>
                    <th class="px-2 py-3">BB</th>
                    <th class="px-2 py-3">Waktu Kelahiran</th>
                    <th class="px-2 py-3">Umur Kelahiran</th>
                    <th class="px-2 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @foreach ($childbirths as $key => $childbirth)
                <tr class="text-gray-700 dark:text-gray-300">
                    <td class="px-2 py-1">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative md:block px-2">
                                {{ $key + 1 . '.' }}
                            </div>
                            <div>
                                <a href="/pregnancies/{{ $childbirth->pregnancy->id }}" class="font-normal capitalize text-blue-500 hover:text-blue-400 hover:underline">{{ $childbirth->pregnancy->person->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $childbirth->pregnancy->person->rt }} / {{ $childbirth->pregnancy->person->rw }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $childbirth->childbirth_order }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $childbirth->sex->sex }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $childbirth->weight }} gr
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $childbirth->pregnancy->childbirth_date->isoFormat('DD MMM YYYY HH:mm') }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        {{ $childbirth->pregnancy->gestational_age }}
                    </td>
                    <td class="px-2 py-1 text-sm text-center">
                        <a href="/people/childbirths/{{ $childbirth->id }}/create" class="text-blue-500 hover:text-blue-800 hover:underline">tambah penduduk</a>
                    </td>
                </tr>
                @endforeach
                
                </tbody>
        </table>
    </div>
     
</x-app-layout>