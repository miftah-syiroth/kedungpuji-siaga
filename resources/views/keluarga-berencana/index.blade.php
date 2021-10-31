<x-app-layout>
    <x-slot name="header">
        {{ __('Laporan Keluarga Berencana') }}
    </x-slot>

    @livewire('keluarga-berencana.index-table')
</x-app-layout>