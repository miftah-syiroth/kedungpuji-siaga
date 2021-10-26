<x-app-layout>
    <x-slot name="header">
        {{ __('Pelayanan Neonatus dan Posyandu: ') }} 
    </x-slot>

    <div class="flex flex-row">
        <div x-data="{ isOpen : true }" class="py-4 mr-2 w-full">
            <div class="overflow-hidden px-4 bg-white rounded-lg shadow-2xl">
                <div class="px-4 py-2">
                    <h3 class="text-md leading-6 font-medium text-gray-900 justify-center text-center">
                        <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-700">Ringkasan</button>
                    </h3>
                </div>
                <div x-show="isOpen" class="border-t border-gray-200 flex flex-row">
                    <dl>
                        <div class="bg-gray-50 px-4 py-1 grid grid-cols-8 gap-2">
                            <dt class="text-sm font-medium text-gray-500 col-span-2">
                                tgl lahir dan umur dlm bulan, minggu, hari
                            </dt>
                            <dd class="mt-1 text-sm sm:mt-0 col-span-6">
                                : {{ $posyandu->person->date_of_birth->isoFormat('dddd, DD MMMM YYYY') }} \\
                                {{ $umur_bayi }} hari
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- komponen neonatus --}}
    <x-posyandu.neonatus :posyandu="$posyandu" />

    {{-- komponen posyandu --}}
</x-app-layout>