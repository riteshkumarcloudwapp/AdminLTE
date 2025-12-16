<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    // Display a listing of testimonials
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    // Show create form
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string||max:255',
                'description' => 'required|string|max:225',
                'designation' => 'required|string|max:255',
                'images' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);
            // dd($request->all());

            // Handle profile image upload (store in public/uploads/users)
            $testimonialImageName = null; // default image filename if none uploaded
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $testimonialImageName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/testimonials'), $testimonialImageName);
            }
            Testimonial::create([
                'name' => $request->name ,
                'description' => $request->description ,
                'designation' => $request->designation ,
                'images' => $testimonialImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect('/testimonial')->with('success' , 'Testimonial created successfully!');
        }
        return view('admin.testimonial.create');
    }

    // Show edit form
    public function edit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }
    
    // Update testimonial
    public function update(Request $request, $id)
{
    $testimonial = Testimonial::findOrFail($id);

    $data = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'designation' => 'required|string|max:255',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);

    // Handle single image upload
    if ($request->hasFile('image')) {

        // delete old image if exists
        if ($testimonial->images && file_exists(public_path('uploads/testimonials/' . $testimonial->images))) {
            unlink(public_path('uploads/testimonials/' . $testimonial->images));
        }

        $file = $request->file('image');
        $imageName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/testimonials'), $imageName);

        $data['images'] = $imageName;
    }

    $data['status'] = $request->has('status') ? 1 : 0;

    $testimonial->update($data);

    return redirect('/testimonial')->with('success', 'Testimonial updated.');
}


    // Delete testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->images) {
            foreach (explode(',', $testimonial->images) as $img) {
                $path = public_path('uploads/testimonials/' . trim($img));
                if (file_exists($path)) @unlink($path);
            }
        }
        $testimonial->delete();
        return redirect('/testimonial')->with('success', 'Testimonial deleted.');
    }

}

