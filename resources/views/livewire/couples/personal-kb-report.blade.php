<div x-data="{ isOpen : true }" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <div class="flex px-4 py-2 justify-between">
        <div>
            @if ($year_periode != $batas_bawah_tahun)
            <button wire:click="getKbReport({{ $year_periode-1 }})" class="text-md leading-6 font-medium w-full text-blue-500 hover:underline">{{ $year_periode-1 }}</button>
            @endif
        </div>
        <div class="flex flex-col text-center">
            <button x-on:click="isOpen = ! isOpen" class="text-md leading-6 font-medium w-full hover:text-blue-500">
                Laporan KB {{ $year_periode }}
            </button>
            <span>{{ $year_periode }}</span>
        </div>
        <div>
            @if ($year_periode != now()->year && $year_periode != $batas_atas_tahun)
            <button wire:click="getKbReport({{ $year_periode+1 }})" class="text-md leading-6 font-medium w-full text-blue-500 hover:underline">{{ $year_periode+1 }}</button>
            @endif
        </div>
    </div>

    <div x-show="isOpen" class="border-t border-gray-200">
        <dl>
            <div class="grid gap-4 mb-8 grid-cols-4 mt-4">
                @foreach ($months as $month)
                <div class="p-2 bg-blue-100 dark:bg-transparent border rounded-md shadow-md">
                    <div x-data="{
                        showForm: false,
                        editButton: true, 
                        }" class="flex flex-col">
                        <p class="mb-2 text-sm font-medium text-dark text-left" >
                            {{ $month->month }}
                        </p>
                        <p class="text-md font-semibold my-1 text-center">
                            @foreach ($keluarga_berencana_data as $kb)
                                @if ($kb->month_periode == $month->id)
                                    {{ $kb->kbStatus->status }}
                                    @break
                                @endif
                            @endforeach
                        </p>

                        <div class=" text-right">
                            <button x-show="editButton" x-on:click=" showForm=true, editButton=false " class="text-sm text-blue-800 px-2 rounded-md dark:text-gray-200 border hover:underline">
                            edit
                            </button>
                        </div>
                        
        
                        <div x-show="showForm" class="flex flex-col">
                            <form action="/couples/{{ $couple->id }}/keluarga-berencana" method="post" class="flex flex-col items-center">
                                @csrf
                                <input type="hidden" name="month_periode" value="{{ $month->id }}">
                                <input type="hidden" name="year_periode" value="{{ $year_periode }}">
                                <select name="kb_status_id" id="kb_status_id" class="block w-auto mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">s
                                    <option hidden>pilih!</option>
                                    @foreach ($kb_statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-sm bg-blue-500 dark:bg-gray-500 hover:bg-blue-700 rounded-md dark:hover:bg-gray-600 px-1 text-white mt-2">simpan</button>
                            </form>
                            <div class="text-right">
                                <button x-on:click=" showForm=false, editButton=true " class="text-sm text-blue-800 px-2 rounded-md dark:text-gray-200 border hover:underline">cancel </button>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                @endforeach 
            </div>
        </dl>
    </div>
</div>