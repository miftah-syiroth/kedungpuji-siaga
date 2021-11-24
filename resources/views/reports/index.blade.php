<x-app-layout>
    <x-slot name="header">
        {{ __('Laporan') }}
    </x-slot>

    <div class="flex flex-wrap">

        {{-- laporan kehamilan pertahun --}}
        <div class="w-1/3 px-2">
            <div class="flex flex-col justify-center px-4 py-2 mb-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="py-2 border-b">
                    <h3 class="font-semibold text-gray-600 text-center">Laporan Kehamilan Pertahun</h3>
                </div>
                <div>
                    <form action="/export-pregnancies-annual-report" method="POST">
                        @csrf
                        <div class="flex flex-col items-center">
                            <label class="block text-sm mx-2 my-2" for="name">
                                <span class="text-gray-700 dark:text-gray-400">HPHT Pada Tahun :</span>
                                <input type="number" name="year_hpht" id="year_hpht" value="{{ request('year_hpht') ?? '' }}" min="1" class="block mx-auto w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                            </label>
            
                            <div>
                                <button type="submit" class="bg-green-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-green-700 dark:hover:bg-gray-300 uppercase text-sm font-semibold">unduh</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        
        {{-- laproan kelahiran pertahun --}}
        <div class="w-1/3 px-2">
            <div class="flex flex-col justify-center px-4 py-2 mb-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="py-2 border-b">
                    <h3 class="font-semibold text-gray-600 text-center">Laporan Kelahiran Pertahun</h3>
                </div>
                <div>
                    <form action="/export-childbirths-annual-report" method="POST">
                        @csrf
                        <div class="flex flex-col items-center">
                            <label class="block text-sm mx-2 my-2" for="name">
                                <span class="text-gray-700 dark:text-gray-400">Kelahiran Pada Tahun</span>
                                <input type="number" name="year_childbirth" id="year_childbirth" value="{{ request('year_childbirth') ?? '' }}" min="1" class="block mx-auto w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                            </label>
            
                            <div>
                                <button type="submit" class="bg-green-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-green-700 dark:hover:bg-gray-300 uppercase text-sm font-semibold">unduh</button>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
        </div>

        {{-- laporan KB perbulan --}}
        <div class="w-1/3 px-2">
            <div class="flex flex-col px-4 py-2 mb-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="py-2 border-b">
                    <h3 class="font-semibold text-gray-600 text-center">Laporan KB Perbulan</h3>
                </div>
                <div>
                    <form action="/export-kb-monthly-report" method="POST">
                        @csrf
                        <div class="flex justify-around">
                            <label class="block text-sm my-2" for="name">
                                <span class="text-gray-700 dark:text-gray-400">RW</span>
                                <input type="number" name="rw" id="rw" value="{{ request('rw') ?? '' }}" min="1" max="3" class="block mx-auto w-16 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                            </label>
                            <label class="block my-2 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Bulan
                                </span>
                                <select name="month_periode" id="month_periode" class="block min-w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray border-gray-400">
                                    <option selected disabled hidden>Pilih!</option>
                                    @foreach ($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->month }}</option>
                                    @endforeach
                                </select>
                            </label>
            
                            <label class="block text-sm my-2" for="name">
                                <span class="text-gray-700 dark:text-gray-400">Tahun</span>
                                <input type="number" name="year_periode" id="year_periode" value="{{ request('year_periode') ?? '' }}" min="1" class="block mx-auto w-24 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-gray-400"/>
                            </label>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="bg-green-500 dark:bg-gray-400 text-white dark:text-gray-800 py-1 px-3 rounded-md hover:bg-green-700 dark:hover:bg-gray-300 uppercase text-sm font-semibold">unduh</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
        
    </div>

    

    

</x-app-layout>