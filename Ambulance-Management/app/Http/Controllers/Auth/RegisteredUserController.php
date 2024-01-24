<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
    public function createPatient(): View
    {
        return view('auth.register-patient');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $userRequest = $request->validate([
            'personal_number'=>['required','max:13','unique:'.User::class],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_of_birth'=>['date'],
            'gender'=>['string'],
            'phone_number' => ['numeric', 'digits:9'],
            'type_of_doctor'=>['string'],
        ]);
        
        if($request->hasFile('profile_image')){
            $userRequest['profile_image']= $request->file('profile_image')->store('profile_images','public');
        }
        $user = User::create($userRequest);
        if($request->has('role')){
            $user->assignRole($request->role);
        }
        else{
            $user->assignrole('patient');
        }
       if($userRequest){
        event(new Registered($user));
       }
        

        // Auth::login($user);

        return redirect()->back();
    }
}
