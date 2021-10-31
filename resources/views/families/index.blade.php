<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Keluarga di Kedungpuji') }}
    </x-slot>

    @livewire('families.index-table')
</x-app-layout>