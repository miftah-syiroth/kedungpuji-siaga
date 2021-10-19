<x-app-layout>
    <x-slot name="header">
        {{ __('Input Laporan Kunjungan Ibu Nifas ') }}
        <a href="/puerperals/{{ $puerperal->id }}" class="text-blue-400 hover:text-blue-700">{{ $puerperal->pregnancy->mother->name }}</a>
    </x-slot>
    
    <div class="py-2">
        <div class="flex justify-start">
            <div class="px-3 py-4 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/puerperals/{{ $puerperal->id }}/puerperal-classes">
                    @csrf
                    <input type="hidden" name="periode" value="{{ $periode }}">
                    <div class="border border-b-0 p-2 flex flex-col">
                        <div class="flex flex-row flex-wrap">
                            <!-- tanggal kunjungan -->
                            <div class="mx-2 w-80">
                                <x-label for="visited_at" :value="__('Tanggal Kunjungan')" />
                                <input type="date" name="visited_at" id="visited_at" value="{{ old('visited_at') }}" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                <span class="text-sm text-green-800">
                                    {{ $waktu_awal->isoFormat('DD-MMM-YYYY') }} hingga {{ $waktu_akhir->isoFormat('DD-MMM-YYYY') }}
                                </span>
                            </div>

                            <!-- masalah -->
                            <div class="mx-2">
                                <x-label for="problem" :value="__('Masalah')" />
                                <textarea name="problem" id="problem" value="{{ old('problem') }}" cols="46" rows="5" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"></textarea>
                            </div>
                        </div>

                        <div class="flex flex-row flex-wrap">
                            <!-- faskes -->
                            <div class="mx-2 w-80">
                                <x-label for="faskes" :value="__('Fasilitas Kesehatan')" />
                                <input type="text" name="faskes" id="faskes" value="{{ old('faskes') }}" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                            </div>

                            <!-- tindakan -->
                            <div class="mx-2">
                                <x-label for="action" :value="__('Tindakan')" />
                                <textarea name="action" id="action" value="{{ old('action') }}" cols="46" rows="5" required class="block mt-1 w-auto border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-4">
                        <x-button class="ml-4">
                            {{ __('Simpan') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>