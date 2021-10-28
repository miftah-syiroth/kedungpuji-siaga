<x-app-layout>
    <x-slot name="header">
        {{ __('Anthropometries') }} 
    </x-slot>


    @livewire('posyandu.anthropometries', ['posyandu' => $posyandu])
</x-app-layout>