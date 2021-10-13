<x-app-layout>
    <x-slot name="header">
        {{-- {{ __('Show Penduduk') }} --}}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-black rounded-lg shadow-lg">
                <ul>
                    <li>
                        tampilkan semua atribut personal dari tabel penduduk
                    </li>
                    <li>
                        tampilkan tabel keluarga dan anggota keluarga dia
                    </li>
                    <li>
                        jika dia sudah menikah atau memiliki pasangan, tampilkan identitas pasangan dan status kb
                    </li>
                    <li>
                        jika dia wanita memiliki relasi ke PregnantWomen, tampilkan data riwayat kehamilan yang akan link ke halaman prenatal class
                    </li>
                    <li>
                        jika dia memiliki relasi ke laporan nifas, tampilkan, ini dibuat pada iterasi 2
                    </li>
                    <li>
                        jika dia memiliki relasi ke posyandu anak, tampilkan, ini dibuat pada iterasi 2
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- komponen data personal --}}
    <x-people.personal-data :person="$person" />
    {{-- komponen data personal --}}
    

    {{-- kalau kepala keluarga, tampilkan komponen data anggotanya --}}
    @if ($person->kepalaKeluarga )
    {{-- <x-people.family-data :person="$person" /> --}}
    @endif
    {{-- komponen anggota keluarga --}}

    {{-- jika dia adalah seorang istri (punya suami), tampilkan komponen KB, kehamilan, kelas nifas, posyandu anak --}}
    @if ($person->husband)
    {{-- komponen laporan kb --}}
    {{-- <x-people.keluarga-berencana-data :person="$person" /> --}}

    {{-- komponen riwayat kehamilan --}}
    {{-- <x-people.pregnancy-data :person="$person" /> --}}
    @endif
    

    {{-- <div class="py-4">
        <div class="flex justify-start">
            <div class="px-4 py-4 rounded-lg shadow-2xl">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Responsive cards
                </h4>
                <div class="grid gap-6 mb-8 grid-cols-3">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border-2">
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Pending contacts
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                35
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
</x-app-layout>