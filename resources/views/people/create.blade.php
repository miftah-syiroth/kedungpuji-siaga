<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Penduduk') }}
    </x-slot>

    @livewire('people.person-create', [
        'sexes' => $sexes,
        'religions' => $religions,
        'blood_groups' => $blood_groups,
        'educationals' => $educationals,
        'disabilities' => $disabilities,
        'marital_statuses' => $marital_statuses,
        'family_statuses' => $family_statuses,
        'keluarga_sejahtera' => $keluarga_sejahtera,
        'kb_services' => $kb_services,
    ])
</x-app-layout>