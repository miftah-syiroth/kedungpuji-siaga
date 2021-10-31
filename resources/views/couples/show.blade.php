<x-app-layout>
    <x-slot name="header">
        {{ __('Kelola KB Pasangan')  }}
    </x-slot>

    {{-- komponen data pasangan dan edit pasangan --}}
    
    <div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-2 py-2">
            <h3 class="text-md leading-6 font-medium justify-center text-center">
                <button x-on:click="isOpen = ! isOpen" class="w-full hover:text-blue-500">Data Pasangan</button>
            </h3>
            <div x-show="isOpen" class="flex justify-between">
                <div class="mt-2">
                    <a href="/couples/{{ $couple->id }}/edit" class="bg-blue-500 px-4 py-1 rounded-md text-white text-sm text-center hover:bg-blue-700">edit</a>
                </div>
                <form action="/couples/{{ $couple->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <select name="marital_status_id" id="marital_status_id" required class="w-auto mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option hidden>pilih status!</option>
                        @foreach ($cerai_statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="bg-red-500 px-4 py-1 rounded-md text-white text-sm text-center mt-2 hover:bg-red-700">cerai/hapus</button>
                </form>
            </div>
        </div>
        <div x-show="isOpen" class="border-t border-gray-200">
            <dl>
                <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Suami
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        : <a href="/people/{{ $couple->husband->id }}" class="text-blue-500 dark:text-light hover:text-blue-700 hover:underline">{{ $couple->husband->name  }}</a>
                    </dd>
                </div>

                <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tempat, Tanggal Lahir Suami
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        : {{ $couple->husband->place_of_birth . ', ' . $couple->husband->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $couple->husband->date_of_birth->age . ' tahun)'  }}
                    </dd>
                </div>

                <hr>

                <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Istri
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        : <a href="/people/{{ $couple->wife->id }}" class="text-blue-500 dark:text-light hover:text-blue-700 hover:underline">{{ $couple->wife->name  }}</a>
                    </dd>
                </div>

                <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tempat, Tanggal Lahir Istri
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        : {{ $couple->wife->place_of_birth . ', ' . $couple->wife->date_of_birth->isoFormat('DD MMMM Y') . ' (' . $couple->wife->date_of_birth->age . ' tahun)'  }}
                    </dd>
                </div>

                <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Status Perkawinan Istri
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        : {{ $couple->wife->maritalStatus->status  }}
                    </dd>
                </div>

                <div class="px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                    <dt class="text-sm font-medium text-gray-500">
                        Peserta KB
                    </dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        <p class="font-semibold">
                            : {{ $couple->is_kb == true ?  $couple->kbService->service ?? '-'  : 'non peserta'  }}
                        </p>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    
    {{-- komponen data pasangan dan edit pasangan --}}

    {{-- komponen input data kb --}}
    @livewire('couples.personal-kb-report', ['couple' => $couple])
</x-app-layout>