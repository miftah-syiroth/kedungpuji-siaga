<x-app-layout>
    <x-slot name="header">
        {{ __('Penduduk Pindah dan Mati') }}
    </x-slot>

    @livewire('people.hidden-people-table')
</x-app-layout>