<div x-data="{ open: true }" class="px-4 py-2 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-2">
    <dt class="text-sm font-medium text-gray-700 dark:text-gray-200">
        <button x-on:click="open = ! open" class="border-b-2 hover:bg-gray-100 dark:hover:text-gray-700 rounded-lg shadow-md w-full">Keluarga</button>
    </dt>
    <dd x-show="open" class="mt-1 py-2 text-sm text-gray-900 border border-gray-200 rounded-md dark:text-gray-200 sm:mt-0 sm:col-span-3">
        
        <ul role="list">
            @forelse ($person->family as $family)
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-6 capitalize">
                <div>Kepala Keluarga</div>
                <div>: 
                    <a href="/families/{{ $family->id }}" class="text-blue-500 hover:text-blue-700">{{ $family->leader->name }}</a>
                </div>
            </li>
            <li class="pl-3 pr-4 pb-1 text-sm grid grid-cols-2 gap-6 capitalize">
                <div>Status Hubungan Kepala Keluarga</div>
                <div>: 
                        {{ $family->pivot->familyStatus->status }}
                </div>
            </li>
            @empty
            <li class="pl-3 pr-4 pb-1 text-sm text-red-600 grid grid-cols-2 gap-6 capitalize">
                <div>Belum ditambahkan pada keluarga !</div>
            </li>
            @endforelse
        </ul>
    </dd>
</div>