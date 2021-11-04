<div x-data="{ open: true }" class="px-4 py-2 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-2">
    <dt class="text-sm font-medium text-gray-700 dark:text-gray-200">
        <button x-on:click="open = ! open" class="border-b-2 hover:bg-gray-100 dark:hover:text-gray-700 rounded-lg shadow-md w-full">Posyandu Terakhir</button>
    </dt>
    <dd x-show="open" class="flex justify-between mt-1 py-2 text-sm text-gray-900 border border-gray-200 rounded-md dark:text-gray-200 sm:mt-0 sm:col-span-3">
        <div class="order-last mr-4">
            @isset($person->posyandu)
            <a href="/posyandu/{{ $person->posyandu->id }}" class="px-3 py-1 rounded-md bg-blue-500 hover:bg-blue-700 text-white dark:bg-gray-500 dark:hover:bg-gray-600 dark:text-gray-200">detail</a>
            @endisset
        </div>

        @isset($latestPosyandu)
        <ul role="list">
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>Waktu Kunjungan</div>
                <div>: {{ $latestPosyandu->visited_at->isoFormat('dddd, DD MMMM Y') }}</div>
            </li>
            {{-- umur yaitu antara tgl lahir dan visited_at --}}
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10">
                <div>Umur Bayi Ketika Kunjungan</div>
                <div>: {{ $person->date_of_birth->diffInMonths($latestPosyandu->visited_at) }} bulan</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10">
                <div>Panjang Badan</div>
                <div>: {{ $latestPosyandu->height }} cm</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10">
                <div>Berat Badan</div>
                <div>: {{ $latestPosyandu->weight }} kg</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>Lingkar Kepala</div>
                <div>: {{ $latestPosyandu->head_circumference }} cm</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>Index Massa Tubuh</div>
                <div>: {{ $latestPosyandu->bmi }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>Panjang/Tinggi Badan Menurut Umur</div>
                <div>: {{ $latestPosyandu->heightForAgeCategory->category }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>Berat Badan Menurut Umur</div>
                <div>: {{ $latestPosyandu->weightForAgeCategory->category }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>IMT Menurut Umur</div>
                <div>: {{ $latestPosyandu->bmiForAgeCategory->category }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-10 capitalize">
                <div>Berat Badan Menurut Panjang Badan</div>
                <div>: {{ $latestPosyandu->weightForHeightCategory->category }}</div>
            </li>
        </ul>    
        @endisset
        
    </dd>
</div>