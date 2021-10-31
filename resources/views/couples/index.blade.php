<x-app-layout>
    <x-slot name="header">
        {{ __('Pasangan Menikah') }}
    </x-slot>

    @livewire('couples.index-table')  
</x-app-layout>