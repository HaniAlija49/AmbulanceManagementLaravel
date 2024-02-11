<!-- update-profile-information-form.blade.php -->
<section class="container mt-5">
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-secondary">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="mb-4">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-dark">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-secondary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">{{ __('Birth date') }}</label>
            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}" required autofocus autocomplete="date_of_birth" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">{{ __('Gender') }}</label>
            <select id="gender" name="gender" class="form-control" required autofocus autocomplete="gender">
                @foreach (\App\Enums\Genders::cases() as $case)
                    <option value="{{ $case }}" {{$user->gender == $case->value ? 'selected' : ''}}>
                        {{$case}}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>        
        
        <div class="mb-3">
            <label for="phone_number" class="form-label">{{ __('Phone number') }}</label>
            <input type="tel" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" required autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>
        @role('doctor|nurse')
        <div class="mb-3">
            <label for="type_of_doctor" class="form-label">{{ __('Doctor type') }}</label>
            <select id="type_of_doctor" name="type_of_doctor" class="form-control" required autofocus autocomplete="type_of_doctor">
                @foreach (\App\Enums\DoctorType::cases() as $case)
                <option value="{{ $case }}" {{ $user->type_of_doctor == $case->value ? 'selected' : '' }}>
                    {{ $case }}
                </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('type_of_doctor')" />
        </div>
        @else
        <input id="type_of_doctor" name="type_of_doctor" type="hidden" value="None">
        <x-input-error class="mt-2" :messages="$errors->get('type_of_doctor')" />
        @endrole
        
        <div class="mb-3">
            <label for="profile_image" class="form-label">{{ __('profile_image') }}</label>
            <input type="file" id="profile_image" name="profile_image" class="form-control" value="{{ old('profile_image', $user->profile_image) }}" autofocus autocomplete="profile_image" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
        </div>
        
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-dark"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
