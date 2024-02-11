<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\View\View;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{

    public function index($type = null)
    {
        $user = Auth::user();
        if ($type == null && $user->hasRole('admin')) {

            $patientsRole = Role::where('name', 'patient')->first();

            $users = User::doesntHave('roles', 'or', function ($query) use ($patientsRole) {
                $query->where('role_id', $patientsRole->id);
            })->get();
            return view('profile.index', ['users' => $users,'type'=>'Employees']);
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
            abort(404);
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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
        if($user->profile_image != null){
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
        public function del($id): RedirectResponse
    {
        $user = User::find($id);
        
        if ($user != null) {
            if($user->role != 'admin') {
                if($user->profile_image != null){
                    Storage::disk('public')->delete($user->profile_image);
                }
                $user->delete();
                return redirect()->back();
            }
            else{
                return Redirect::back()->with('error', 'You dont have the role to delete');
            }
        } else {
            return Redirect::back()->with('error', 'User not found.');
        }
    }


    public function details($id)
    {
    if ($id == null) {
        return response()->json(['error' => 'Not Found'], 404);
    }
    
    $user = User::where('id', $id)->first();
    if ($user && $user->hasRole('patient')) {
        $reports = Report::whereHas('appointment', function ($query) use ($user) {
            $query->where('patient_id', $user->id)->whereNotNull('patient_id');
})->get();

            return view('profile.details', ['user' => $user, 'reports' => $reports]);
            }
    else{
        $user = User::where('id', $id)->first();
         return view('profile.details', ['user' => $user]);
    }
   
    }
}
