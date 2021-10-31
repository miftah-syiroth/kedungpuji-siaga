<x-app-layout>
    <x-slot name="header">
        {{ __('Penduduk Kedungpuji') }}
    </x-slot>

    @livewire('people.index-table')
</x-app-layout>