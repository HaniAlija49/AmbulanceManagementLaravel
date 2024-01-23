<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Spatie\Permission\Contracts\Role;

class ProfileController extends Controller
{

    public function index($type = null)
    {
        $user = Auth::user();
        if ($type == null && $user->hasRole('admin')) {
            $users = User::all();
            return view('profile.index', ['users' => $users,'type'=>'Empolyees']);
         }
        else if ($type == 'patient') {
            $patients = User::role('patient')->get();
            return view('profile.index', ['users' => $patients ,'type'=>'Patients']);
        }
        else if ($type == 'doctor') {
            $doctors = User::role('doctor')->get();
            return view('profile.index', ['users' => $doctors ,'type'=>'Doctors']);
        }
        else {
            return view('profile.index', ['users' => [],'type'=>'Route does not exist 404']);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $id = null): View
    {
        if($id != null){
            $user = User::find($id);
            return view('profile.edit', [
                'user' => $user,
            ]);
        }
        else {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

}
    

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        //ddd($request);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if($request->hasFile('profile_image')){
            $path = Auth::user()->profile_image;
            if($path != null && Storage::disk('public')->exists($path)){
                Storage::disk('public')->delete($path);
            }
            $request->user()['profile_image']= $request->file('profile_image')->store('profile_images','public');
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function details($id)
    {
    if ($id == null) {
        return response()->json(['error' => 'Not Found'], 404);
     }

    $user = User::where('id', $id)->first();

    if ($user == null) {
        return response()->json(['error' => 'Not Found'], 404);
     }

    return view('profile.details', ['user' => $user]);
    }
}
