<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Akun') }}
    </x-slot>

    {{-- form tambah pengguna --}}

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="/users/{{ $user->id }}">
            @csrf
            @method('PUT')
            <!-- Name -->
            <label class="block text-sm mr-2 w-1/3" for="name">
                <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="block border-2 border-gray-400 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap"/>
            </label>

            <div class="flex flex-wrap mt-4">
                
                <!-- Phone Number -->
                <label class="block text-sm mr-2" for="phone">
                    <span class="text-gray-700 dark:text-gray-400">Phone Number</span>
                    <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" required class="block border-2 border-gray-400 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap"/>
                </label>

                <!-- Email Address -->
                <label class="block text-sm mr-2" for="email">
                    <span class="text-gray-700 dark:text-gray-400">email Number</span>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="block border-2 border-gray-400 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap"/>
                </label>
            </div>
            
            <div class="flex flex-wrap mt-4">
                <!-- Password -->
                <label class="block text-sm mr-2" for="password">
                    <span class="text-gray-700 dark:text-gray-400">Password Baru</span>
                    <input type="password" name="password" id="password" class="block border-2 border-gray-400 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Password Baru"/>
                </label>

                <!-- Confirm Password -->
                <label class="block text-sm mr-2" for="password_confirmation">
                    <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="block border-2 border-gray-400 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Konfirmasi Password"/>
                </label>
            </div>
            
            
            <div class="flex items-center justify-between mt-4">
                
                <div>
                    @role('admin')

                    @foreach ($roles as $role)
                    <label class="inline-flex items-center mx-2">
                        <input class="form-radio" type="radio" {{ $role == $user->getRoleNames()->first() ? 'checked' : '' }} name="role" value="{{ $role }}" />
                        <span class="ml-2">{{ $role }}</span>
                    </label>
                    @endforeach
                    
                    @endrole
                </div>
            </div>
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Ubah Akun</button>
            </div>
        </form>
    </div>

    
</x-app-layout>