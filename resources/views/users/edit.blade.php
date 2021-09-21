<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Akun') }}
    </x-slot>

    {{-- form tambah pengguna --}}
    <div class="py-4">
        <div class="flex justify-center">
            <div class="px-6 py-6 bg-white rounded-lg shadow-lg">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="/users/{{ $user->id }}">
                    @csrf
                    @method('PUT')
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Nama Lengkap')" />
                        <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name ?? old('name') }}" required autofocus type="text">
                    </div>

                    <div class="flex flex-row mt-4">
                        
                        <!-- Phone Number -->
                        <div>
                            <x-label for="phone" :value="__('Phone Number')" />
            
                            <input value="{{ $user->phone ?? old('phone') }}" type="tel" name="phone" id="phone" class="block mt-1 w-full" required>
                        </div>

                         <!-- Email Address -->
                        <div class="ml-4">
                            <x-label for="email" :value="__('Email')" />
    
                            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email ?? old('email')}}">
                        </div>
                    </div>
                    
                    <div class="flex flex-row mt-4">
                        <!-- Password -->
                        <div>
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="ml-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />
            
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                        </div>
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
                        
                        
                        <x-button class="ml-4">
                            {{ __('Ubah Akun') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>