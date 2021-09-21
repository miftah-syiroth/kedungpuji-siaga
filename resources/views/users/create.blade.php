<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pengguna') }}
    </x-slot>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('users.store') }}">
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
            
                            <x-input id="phone" class="block mt-1 w-full" type="tel"  name="phone" :value="old('phone')" required placeholder="Whatsapp"/>
                        </div>

                         <!-- Email Address -->
                        <div class="ml-4">
                            <x-label for="email" :value="__('Email')" />
            
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="kosongkan jika tidak punya" />
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
</x-app-layout>