<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Akun') }}
        </h2>
    </x-slot>

    {{-- form tambah pengguna --}}
    <div class="py-4">
        <h4 class="mb-4 text-md font-semibold text-gray-600 text-center">
            Tambah Pengguna
        </h4>
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('register') }}">
                    @csrf
        
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Nama Lengkap')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <div class="flex flex-row mt-4">
                        
                        <!-- Phone Number -->
                        <div>
                            <x-label for="phone" :value="__('Phone Number')" />
            
                            <x-input id="phone" class="block mt-1 w-full" type="tel"  name="phone" :value="old('phone')" required />
                        </div>

                         <!-- Email Address -->
                        <div class="ml-4">
                            <x-label for="email" :value="__('Email')" />
            
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                        </div>
                    </div>
                    
                    <div class="flex flex-row mt-4">
                        <!-- Password -->
                        <div>
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="ml-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />
            
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-4">

                        <div>
                            <label class="inline-flex items-center">
                                <input class="form-radio" type="radio" name="role" value="admin" />
                                <span class="ml-2">Admin</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input class="form-radio" type="radio" name="role" value="bidan desa" />
                                <span class="ml-2">Bidan</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input class="form-radio" type="radio" name="role" value="kader kesehatan" />
                                <span class="ml-2">Kader</span>
                            </label>
                        </div>
                        <x-button class="ml-4">
                            {{ __('Tambah Akun') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- table kelola pengguna --}}
    <div class="py-4">
        <h4 class="mb-4 text-md font-semibold text-gray-600 text-center">
            Tabel Pengguna
        </h4>
        <div class="flex justify-center px-10">
            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                <th class="px-4 py-3">No.</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Hak Akses</th>
                                <th class="px-4 py-3">Phone</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach ($users as $key => $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100" >
                                        nama role
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->phone }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                            <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                                ></path>
                                            </svg>
                                        </button>
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                            <svg
                                                class="w-5 h-5"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    
</x-app-layout>