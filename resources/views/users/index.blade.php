<x-app-layout>
    <x-slot name="header">
        {{ __('Semua Pengguna') }}
    </x-slot>

    <div x-data="{
        createForm: false
    }" class="py-2">
        <div class="flex flex-col justify-center">
            <div class="my-2">
                <button x-on:click=" createForm= ! createForm"  class="text-white bg-blue-500 px-4 py-1 text-sm rounded-lg hover:bg-blue-700">tambah</button>
            </div>
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700">
                            <th class="pl-4 py-3 text-left">Nama</th>
                            <th class="px-2 py-3">Phone Number</th>
                            <th class="px-2 py-3">Hak Akses</th>
                            <th class="px-2 py-3">Actions</th>
                            </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($users as $key => $user)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-1">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative md:block px-2">
                                        {{ $key + 1 . '.' }}
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-1 text-sm text-center">
                                {{ $user->phone ?? '--' }}
                            </td>
                            <td class="px-4 py-1 text-xs text-center">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    {{ $user->roles->first()->name }}
                                </span>
                            </td>
                            <td class="px-4 py-1">
                                <div class="flex justify-center space-x-4 text-sm">
                                    <a href="/users/{{ $user->id }}/edit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit" @click="openModal">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>

                                    {{-- jangan tambilkan button hapus pd row user autenticated --}}
                                    @unless (Auth::id() == $user->id)
                                    <form action="/users/{{ $user->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete" type="submit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </button>
                                    </form>
                                    @endunless
    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            
            <div x-show="createForm" class="flex mt-4">
                <x-user.create-user :roles="$roles" />
            </div>
        </div>
    </div>
</x-app-layout>