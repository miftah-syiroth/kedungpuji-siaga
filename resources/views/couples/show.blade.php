<x-app-layout>
    <x-slot name="header">
        {{ __('Pasangan dari: ')  . $couple->wife->name }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                ini keterangan tentang pasangan dan status KB
            </div>
        </div>
    </div>

    <!-- Responsive cards -->
    <h4 class="mb-4 text-lg font-semibold text-dark dark:text-gray-300">
        Periode {{ $year }}
    </h4>
    <div class="grid gap-4 mb-8 md:grid-cols-3 xl:grid-cols-4">
        <!-- Card -->
        @foreach ($months as $month)
        <div class="p-2 bg-green-300 rounded-lg shadow-md">
            <div x-data="{
                isForm: false,
                isEdit: true, 
            }" class="flex flex-col">
                <p class="mb-2 text-sm font-medium text-dark text-center" >
                    {{ $month->month }}
                </p>
                <p class="text-md font-semibold text-gray-700 text-center">
                    {{-- @php
                        $kb = $data_kb_setahun->where('month_id', $month->id)->first();
                    @endphp --}}
                    {{-- {{ $kb->contraception->contraception ?? $kb->desirePregnancy->desire ?? '-' }} --}}
                    {{-- {{ $couple->contraceptionCode($year, $month->id)->first() ?? '-' }} --}}
                    {{-- @dump($couple->contraceptionCode($year, $month->id)) --}}
                </p>
                <button x-show="isEdit" x-on:click=" isForm=true, isEdit=false " class="text-sm text-right text-blue-800 hover:underline">
                    edit
                </button>

                <div x-show="isForm" class="flex flex-col">
                    <form action="{{ route('keluarga-berencana.store') }}" method="post" class="flex flex-col items-center">
                        @csrf
                        <input type="hidden" name="couple_id" value="{{ $couple->id }}">
                        <input type="hidden" name="month_periode" value="{{ $month->id }}">
                        <input type="hidden" name="year_periode" value="{{ $year }}">
                        {{-- <input type="hidden" name="keluarga_berencana_id" value="{{ $kb_single_data->id ?? '' }}"> --}}
                        <select name="coupleable_id" id="coupleable_id" class="text-sm">
                            <option hidden>pilih!</option>
                            @foreach ($kb_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->desire ?? $status->contraception }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-700 rounded-md px-1 text-white mt-2">simpan</button>
                    </form>
                    <button x-on:click=" isForm=false, isEdit=true " class="text-sm text-right text-blue-800 hover:underline">cancel  </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>