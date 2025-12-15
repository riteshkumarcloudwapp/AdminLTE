<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

class UserController extends Controller
{
    // SHOW USERS LIST
    public function index()
    {
        // Order users in ascending order by `id` (oldest first)
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // SHOW ADD USER FORM AND HANDLE USER CREATION
    public function create(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|regex:/^[A-Za-z ]+$/|max:255',
                'email'=> 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            // dd($request->file('profile_image'));

            // Handle profile image upload (store in public/uploads/users)
            $profileImageName = null; // default image filename if none uploaded

            if ($request->hasFile('profile_image')) {

                //1 . get the uploaded file
                $file = $request->file('profile_image');

            //    // Optional: Use original filename or extension ie document.pdf
            // $originalName = $file->getClientOriginalName();

            //    // Check if this image name already exists in DB
            // if (User::where('profile_image', $originalName)->exists()) {
            //     return back()->withErrors([
            //         'profile_image' => 'This image has already been used. Please choose a different one.'
            //     ])->withInput();
            // }
                // Always generate unique filename (NO DB CHECK needed)
                $profileImageName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();

                // move to public folder
                $file->move(public_path('uploads/users'), $profileImageName);
            }

            User::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'password' => Hash::make($request->password),
                'profile_image' => $profileImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect('/user')->with('success' , 'User created successfully!');
        }
        return view('admin.users.create');
    } 



    // // SHOW update FORM
    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('admin.users.edit', compact('user'));
    // }

    // UPDATE USER
    
    public function update(Request $request, $id)
{
    // Get user or fail
    $user = User::findOrFail($id);

    // Show edit form (GET request)
    if ($request->isMethod('get')) {
        return view('admin.users.edit', compact('user'));
    }

    // Validate request (POST)
    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);

    // Handle profile image update
    if ($request->hasFile('profile_image')) {

    // Remove old image
    if ($user->profile_image) {
        File::delete(public_path('uploads/users/' . $user->profile_image));
    }

    // Save new image
    $image = $request->file('profile_image');
    $imageName = time() . '.' . $image->extension();
    $image->move(public_path('uploads/users'), $imageName);

    // Update image name
    $validated['profile_image'] = $imageName;
}


    // Update user
    $user->update($validated);

    return redirect('/user')->with('success', 'User updated successfully!');
}


    // DELETE USER
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('/user')->with('success', 'User deleted successfully!');
    }
}
