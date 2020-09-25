<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {

        $current = Auth::user();
        $profile = User::find($current->id)->profile;

        return view('layouts.panel.page.profile.index', compact('current', 'profile'));
    }

    public function addProfile(Request $request) {

        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        $file = $request->file('image');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

        // return dd(Auth::user()->id, $fileName, $request->get('phone'), $request->get('address'));

        $post = Profile::create([
            'user_id' => Auth::user()->id,
            'image' => $fileName,
            'phone' => $request->get('phone'),
            'address' => $request->get('address')
        ]);

        if ($post) {
            $file->move(public_path('uploads/profile/'), $fileName);
            return redirect()->route('profile.index')->with('success', 'Success add profile');
        } else {
            return back();
        }
    }

    public function updateProfile(Request $request) {

        $find = User::find(auth()->user()->id)->profile();
        $profile = User::find(auth()->user()->id)->profile;

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpg,png,jpeg',
                'phone' => 'required|numeric',
                'address' => 'required'
            ]);

            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName.'_'.time().'.'.$file->getClientOriginalExtension();

            $up = $find->update([
                'image' => $fileName,
                'phone' => $request->get('phone'),
                'address' => $request->get('address')
            ]);

            if ($up) {
                if (file_exists(public_path("uploads/profile/{$profile->image}"))) {
                    // remove old img
                    unlink(public_path("uploads/profile/{$profile->image}"));
                }
                
                $file->move(public_path('uploads/profile/'), $fileName);
                return redirect()->route('profile.index')->with('success', 'Success update profile');
            } else {
                return back();
            }

            return back();
        } else {
            $request->validate([
                'phone' => 'required|numeric',
                'address' => 'required'
            ]);

            $up = $find->update([
                'phone' => $request->get('phone'),
                'address' => $request->get('address')
            ]);

            if ($up) {
                return redirect()->route('profile.index')->with('success', 'Success update profile');
            } else {
                return back();
            }
        }

    }

    public function updateProfileName(Request $request) {

        $request->validate([
            'name' => 'required'
        ]);

        $find = User::find(auth()->user()->id);

        $up = $find->update([
            'name' => $request->get('name')
        ]);

        if ($up) {
            return redirect()->route('profile.index')->with('success', 'Success update profile');
        } else {
            return back();
        }
    }

    public function changePassword(Request $request) {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password',
        ]);

        $find = User::find(auth()->user()->id);
        $up = $find->update([
            'password'=> Hash::make($request->new_password)
        ]);

        if ($up) {
            return redirect()->route('profile.index')->with('success', 'Password changed');
        } else {
            return back();
        }
    }
}
