<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    // ---------------------------------------
    // SHOW CATEGORY LIST
    // ---------------------------------------
    public function showCategories()
    {
        $categories = Categories::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    // ---------------------------------------
    // CREATE CATEGORY (GET + POST)
    // ---------------------------------------
    public function create(Request $request)
    {
        // POST - form submission
        if ($request->isMethod('post')) {

            $request->validate([
                'name'  => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            // Create Category first without image
            $category = Categories::create([
                'name'   => $request->name,
                'status' => $request->has('status') ? 'active' : 'inactive',
            ]);

            // Handle Image Upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $uploadPath = public_path('uploads/categories');

                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }

                $fileName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $fileName);

                $category->update(['image' => $fileName]);
            }

            return redirect('/categories')->with('success', 'Category created successfully.');
        }

        // GET - form view
        return view('admin.categories.create');
    }

    // ---------------------------------------
    // EDIT CATEGORY (SHOW FORM)
    // ---------------------------------------
    public function editCategories($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // ---------------------------------------
    // UPDATE CATEGORY
    // ---------------------------------------
    public function updateCategories(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $request->validate([
            'name'  => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Update name only if given
        if ($request->filled('name')) {
            $category->name = $request->name;
        }

        $category->status = $request->has('status') ? 'active' : 'inactive';

        // Handle New Image Upload
        if ($request->hasFile('image')) {

            // delete old image
            if ($category->image) {
                $old = public_path('uploads/categories/' . $category->image);
                if (file_exists($old)) {
                    @unlink($old);
                }
            }

            $file = $request->file('image');
            $uploadPath = public_path('uploads/categories');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $fileName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            $category->image = $fileName;
        }

        $category->save();

        return redirect('/categories')->with('success', 'Category updated successfully.');
    }

    // ---------------------------------------
    // DELETE CATEGORY
    // ---------------------------------------
    public function deleteCategories($id)
    {
        $category = Categories::findOrFail($id);

        // delete image
        if ($category->image) {
            $path = public_path('uploads/categories/' . $category->image);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $category->delete();

        return redirect('/categories')->with('success', 'Category deleted successfully.');
    }

    // ---------------------------------------
    // TOGGLE ACTIVE/INACTIVE
    // ---------------------------------------
    public function toggleStatus($id)
    {
        $category = Categories::findOrFail($id);
        $category->status = $category->status === 'active' ? 'inactive' : 'active';
        $category->save();

        return redirect()->back()->with('success', 'Category status updated successfully.');
    }
}
