<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pengguna') }}
    </x-slot>

    @livewire('families.family-create', [
        'keluarga_sejahtera' => $keluarga_sejahtera,
    ])
</x-app-layout>