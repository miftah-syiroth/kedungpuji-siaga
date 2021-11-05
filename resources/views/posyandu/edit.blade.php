<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Ringkasan Pelayanan Posyandu') }}
    </x-slot>

    @if (session('message'))
        <span class="text-red-500 text-sm text-center">
            {{ session('message') }}
        </span>
    @endif
    
    <div class="px-4 py-3 mb-8 bg-white shadow-md dark:bg-gray-800"> 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/posyandu/{{ $posyandu->id }}">
            @csrf
            @method('PUT')

            <!-- Informasi Tambahan -->
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Kesimpulan Neonatus</span>
                <textarea name="neonatus_conclusion" id="neonatus_conclusion" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ $posyandu->neonatus_conclusion ?? '' }}</textarea>
            </label>

            <!-- Informasi Tambahan -->
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Kesimpulan Anthropometri</span>
                <textarea name="posyandu_conclusion" id="posyandu_conclusion" class="block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ $posyandu->posyandu_conclusion ?? '' }}</textarea>
            </label>
            
            <div class="flex flex-wrap justify-between text-sm">
                <div>
                    <button type="submit" class="bg-purple-400 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-purple-700 dark:hover:bg-gray-300 mx-2 my-4">Simpan</button>
                    <a href="/posyandu/{{ $posyandu->id }}" type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Batal Ubah</a>
                </div>
                
            </div>
        </form>
        <form action="/posyandu/{{ $posyandu->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="flex justify-end text-sm">
                <button type="submit" class="bg-red-500 dark:bg-red-800 text-white dark:text-gray-200 py-2 px-3 rounded-md hover:bg-red-700 dark:hover:bg-red-900 mx-2 my-4">hapus</button>
            </div>
        </form>
    </div>

</x-app-layout>