<x-app-layout>
    <x-slot name="header">
        {{ __('Show Keluarga') }}
    </x-slot>
    
    <div class="py-4">
        <div class="flex justify-start">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <ul>
                    <li>
                        tampilkan semua anggota keluarga dengan tabel, datanya yang sederhana saja. terdapat link ke show person pada nama
                    </li>
                    <li>
                        atribut keluarga pada tabel keluarga, seperti tahapan keluarga sejahtera
                    </li>
                    <li>
                        tampilkan data personal anggota keluarga secara detil. barang kali berguna untuk melihat data secara keseluruhan daripada satu2 person
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>