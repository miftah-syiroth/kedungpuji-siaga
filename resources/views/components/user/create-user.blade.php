<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="flex flex-wrap">
            <!-- Name -->
            <label class="block text-sm mr-2" for="name">
                <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-2 border-gray-300" placeholder="Nama Lengkap"/>
            </label>
        </div>

        <div class="flex flex-wrap mt-4">
            
            <!-- Phone Number -->
            <label class="block text-sm mr-2" for="phone">
                <span class="text-gray-700 dark:text-gray-400">Phone Number</span>
                <input type="tel" name="phone" id="phone" placeholder="whatsapp" value="{{ old('phone') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-2 border-gray-300">
            </label>

                <!-- Email Address -->
            <label class="block text-sm mr-2" for="email">
                <span class="text-gray-700 dark:text-gray-400">Alamat Email</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-2 border-gray-300" placeholder="kosongkan jika tidak punya">
            </label>
        </div>
        
        <div class="flex flex-row mt-4">
            <!-- Password -->
            <label class="block text-sm mr-2" for="password">
                <x-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-400" />
                <x-input id="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-2 border-gray-300" type="password" name="password" required autocomplete="new-password" />
            </label>

            <!-- Confirm Password -->
            <label class="block text-sm mr-2" for="password_confirmation">
                <x-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-400" />
                <x-input id="password_confirmation" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input border-2 border-gray-300" type="password" name="password_confirmation" required />
            </label>
        </div>
        
        <div class="flex items-center justify-between mt-4">

            <div>
                @role('admin')

                @foreach ($roles as $role)
                <label class="inline-flex items-center mx-2">
                    <input class="form-radio" type="radio" name="role" value="{{ $role }}" />
                    <span class="ml-2">{{ $role }}</span>
                </label>
                @endforeach

                @endrole
            </div>
            <div>
                <button type="submit" class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-800 py-2 px-3 rounded-md hover:bg-gray-700 dark:hover:bg-gray-300 mx-2 my-4">Tambah Akun</button>
            </div>
        </div>
    </form>
</div>