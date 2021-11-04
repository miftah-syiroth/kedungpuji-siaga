<div x-data="{ open: true }" class="px-4 py-2 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-2">
    <dt class="text-sm font-medium text-gray-700 dark:text-gray-200">
        <button x-on:click="open = ! open" class="border-b-2 hover:bg-gray-100 dark:hover:text-gray-700 rounded-lg shadow-md w-full">Pasangan dan KB</button>
    </dt>
    <dd x-show="open" class="py-2 text-sm text-gray-900 border border-gray-200 rounded-md dark:text-gray-200 sm:mt-0 sm:col-span-3">

        @if (!empty($wifes))
        @foreach ($wifes as $wife)
        <ul role="list" class="mb-4">
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Nama Istri</div>
                <div class="col-span-2">: 
                    <a href="/couples/{{ $wife->id }}" class="text-blue-500 hover:text-blue-700">
                        {{ $wife->wife->name }}
                    </a>
                </div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Tempat, Tanggal Lahir</div>
                <div class="col-span-2">: 
                    {{ $wife->wife->place_of_birth }}, {{ $wife->wife->date_of_birth->isoFormat('DD MMMM Y') }} ({{ $wife->wife->date_of_birth->age }} tahun)
                </div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Status Perkawinan Istri</div>
                <div class="col-span-2">: {{ $wife->wife->maritalStatus->status }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>peserta KB</div>
                <div class="col-span-2">: {{ $wife->is_kb == true ? $wife->kbService->service : 'tidak KB' }}</div>
            </li>
        </ul>
        @endforeach
        @endif

        @if(!empty($husband))

        <ul role="list">
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Nama Suami</div>
                <div class="col-span-2">: 
                    <a href="/couples/{{ $husband->id }}" class="text-blue-500 hover:text-blue-700">
                        {{ $husband->husband->name }}
                    </a>
                </div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Tempat, Tanggal Lahir</div>
                <div class="col-span-2">: 
                    {{ $husband->husband->place_of_birth }}, {{ $husband->husband->date_of_birth->isoFormat('DD MMMM Y') }} ({{ $husband->husband->date_of_birth->age }} tahun)
                </div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Status Perkawinan Istri</div>
                <div class="col-span-2">: {{ $husband->wife->maritalStatus->status }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>peserta KB</div>
                <div class="col-span-2">: {{ $husband->is_kb == true ? $husband->kbService->service : 'tidak KB' }}</div>
            </li>
        </ul>

        @endif

        @if (empty($wifes) && empty($husband))
        <ul role="list">
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 text-red-500">belum ada pasangan :p !!</li>
        </ul>
        @endif

        

    </dd>
</div>