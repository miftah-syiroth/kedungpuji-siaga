<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pasangan') }}
    </x-slot>

    @livewire('couples.couple-create', [
        'kb_services' => $kb_services,
    ])
</x-app-layout>