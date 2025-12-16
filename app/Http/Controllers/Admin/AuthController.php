<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;


class AuthController extends Controller
{
    //show Admin dashboard
    public function adminDashboard()
{
    return view('admin.pages.dashboard');
}

    //Login

public function login(Request $request)
{
    if ($request->isMethod('post')) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        // Login using admin guard; regenerate session on success
        if (Auth::guard('admin')->attempt($credentials)) {
            // Prevent session fixation
            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Logged in successfully!');
        }

        // If login fails
        return back()
            ->withErrors(['email' => 'Invalid admin credentials.'])
            ->withInput();
    }

    return view('admin.pages.login');
}



    //changePassword
    public function changePassword(Request $request)
{
    // Only one admin
       //   $user = Auth::user();
    $admin = Admin::first();

    if ($request->isMethod('post')) {

        $request->validate([
            'current_password' => 'required|string|min:4',
            'new_password'     => 'required|string|min:4|confirmed',
        ]);

        // Check current password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect'
            ]);
        }

        // Update new password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Password updated successfully!');
    }

    return view('admin.pages.changePassword', compact('admin'));
}

// Edit Profile

public function editProfile(Request $request)
{
    // Only one admin in DB
    $admin = Admin::first();

    if ($request->isMethod('post')) {

        $request->validate([
            'name'  => 'required|string|max:225',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $admin->name = $request->name;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/admins'), $imgName);
            $admin->image = $imgName;
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    return view('admin.pages.editProfile', compact('admin'));
}

// Logout
public function logout(Request $request){
    // Logout the admin guard and invalidate the session
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Logged out successfully!');
}

    
}
 
