<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Keluarga') }}
    </x-slot>

    @livewire('families.family-create', [
        'keluarga_sejahtera' => $keluarga_sejahtera,
    ])
</x-app-layout>