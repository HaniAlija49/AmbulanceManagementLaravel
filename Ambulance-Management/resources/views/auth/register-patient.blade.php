<x-app-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        <div class="mb-3">
            <label for="personal_number" class="form-label">{{ __('Personal Number') }}</label>
            <input type="text" id="personal_number" class="form-control" name="personal_number" value="{{ old('personal_number') }}" required autofocus autocomplete="personal_number">
            <x-input-error class="mt-2" :messages="$errors->get('personal_number')" />
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
            <input type="file" id="profile_image" class="form-control" name="profile_image" value="{{ old('profile_image') }}" required autofocus autocomplete="profile_image">
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">{{ __('Birth date') }}</label>
            <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" required autofocus autocomplete="date_of_birth">
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">{{ __('Gender') }}</label>
            <select id="gender" name="gender" class="form-control" required autofocus autocomplete="gender">
                @foreach (\App\Enums\Genders::cases() as $case)
                    <option value="{{ $case }}">{{ $case }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">{{ __('Phone number') }}</label>
            <input type="tel" id="phone_number" class="form-control" name="phone_number" required autofocus autocomplete="phone_number">
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password">
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary ms-4">{{ __('Register') }}</button>
        </div>
    </form>
</x-app-layout>
