<x-app-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        <div class="mb-3">
            <label for="personal_number" class="form-label">{{ __('Personal Number') }}</label>
            <x-text-input id="personal_number" class="form-control" type="text" name="personal_number" :value="old('personal_number')" required autofocus autocomplete="personal_number" />
            <x-input-error :messages="$errors->get('personal_number')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- <div class="mb-3">
            <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
            <x-text-input id="profile_image" class="form-control" type="file" name="profile_image" :value="old('profile_image')" required autofocus autocomplete="profile_image" />
            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
        </div> --}}

        <div class="mb-3">
            <label for="type_of_doctor" class="form-label">{{ __('Doctor Type') }}</label>
            <select id="type_of_doctor" name="type_of_doctor" class="form-control" required autofocus autocomplete="type_of_doctor">
                @foreach (\App\Enums\DoctorType::cases() as $case)
                    <option value="{{ $case }}">{{ $case }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">{{ __('Role') }}</label>
            <select id="role" name="role" class="form-control" required autofocus autocomplete="role">
                @foreach (\App\Enums\Roles::cases() as $case)
                    <option value="{{ $case }}">{{ $case }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>
        <!-- Add Bootstrap styling to other form elements similarly -->

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-start mt-4">
            <x-primary-button class="ms-4  ">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
