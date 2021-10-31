<div x-data="{ open: true }" class="px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium text-gray-500 dark:text-gray-200">
        <button x-on:click="open = ! open" class="border-b-2 hover:bg-gray-100 dark:hover:text-gray-700 rounded-lg shadow-md w-full">Personal</button>
    </dt>
    <dd x-show="open" class="flex justify-between mt-1 py-2 text-sm text-gray-900 border border-gray-200 rounded-md dark:text-gray-200 sm:mt-0 sm:col-span-3">
        <div class="order-last mr-4">
            <a href="/people/{{ $person->id }}/edit" class="px-3 py-1 rounded-md bg-blue-500 dark:bg-gray-500 dark:hover:bg-gray-600 text-gray-200">edit</a>
        </div>
        <ul role="list">
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Nama Lengkap</div>
                <div class="col-span-2">: {{ $person->name }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>NIK</div>
                <div class="col-span-2">: {{ $person->nik }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Tempat, Tanggal Lahir</div>
                <div class="col-span-2">: {{ $person->place_of_birth }}, {{ $person->date_of_birth->isoFormat('DD MMMM Y') }} ({{ $person->date_of_birth->age }} tahun)</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Golongan Darah</div>
                <div class="col-span-2">: {{ $person->bloodGroup->group }}</div>
            </li>

            
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Ayah Kandung</div>
                <div class="col-span-2">: 
                    @isset($person->father)
                    <a href="{{ $person->father->id }}" class="text-blue-500 hover:text-blue-700">
                        {{ $person->father->name }}
                    </a>
                    @endisset
                </div>
            </li>
            
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Ibu Kandung</div>
                <div class="col-span-2">: 
                    @isset($person->mother)
                    <a href="{{ $person->mother->id }}" class="text-blue-500 hover:text-blue-700">
                        {{ $person->mother->name }}
                    </a>
                    @endisset
                </div>
            </li>
            
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Disabilitas</div>
                <div class="col-span-2">: {{ $person->is_cacat == true ? $person->disability->disability : 'tidak' }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Pendidikan</div>
                <div class="col-span-2">: {{ $person->educational->education }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Status Kawin</div>
                <div class="col-span-2">: {{ $person->maritalStatus->status }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Agama</div>
                <div class="col-span-2">: {{ $person->religion->religion }}</div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Domisili</div>
                <div class="col-span-2 capitalize">: 
                    {{ $person->village_id == 1 ? 'RT ' . $person->rt .'/'. $person->rw : 'pindah' }}    
                </div>  
            </li>
            @if ($person->is_alive == false)
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-3 gap-6 capitalize">
                <div>Meninggal</div>
                <div class="col-span-2 capitalize">: 
                    {{ $person->died_at->isoFormat('DD MMMM Y') }}
                </div>  
            </li>
            @endif
        </ul>
    </dd>
</div>