<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="form-signin">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Username or Email')" />
            <x-text-input id="email" class="form-control mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="form-group mx-4">
            <label for="remember_me" class="form-check-label inline-flex items-center">
                <input id="remember_me" type="checkbox" class="form-check-input rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="form-group text-center mt-4">
            <a href="javascript: history.go(-1)" class="btn btn-danger">Back</a>
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
            
        </div>
    </form>
</x-guest-layout>
