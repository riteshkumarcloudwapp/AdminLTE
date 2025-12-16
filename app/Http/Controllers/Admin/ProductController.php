<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // ----------------------------------------
    // SHOW ALL PRODUCTS
    // ----------------------------------------
    public function showCards()
    {
        // Include category automatically (JOIN)
        $products = Product::with('category')->latest()->get();

        return view('admin.products.showcards', compact('products'));
    }

    // ----------------------------------------
    // CREATE PRODUCT (GET + POST)
    // ----------------------------------------
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'title'           => 'required|regex:/^[A-Za-z\s]+$/|max:255',
                'description'     => 'required|string|regex:/^[A-Za-z\s]+$/',
                'actual_price'    => 'required|numeric',
                'discount_price'  => 'nullable|numeric',
                'tags'            => 'nullable|string',
                'category_id'     => 'required|exists:categories,id',
                'image'           => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120'
            ]);

            // Create product first
            $product = Product::create([
                'title'         => $request->title,
                'description'   => $request->description,
                'actual_price'  => $request->actual_price,
                'discount_price'=> $request->discount_price,
                'tags'          => $request->tags,
                'category_id'   => $request->category_id,
                'status'        => $request->has('status') ? 1 : 0,
            ]);

            // Image Upload
            if ($request->hasFile('image')) {
                $file       = $request->file('image');
                $uploadPath = public_path('uploads/products');

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $fileName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $fileName);

                $product->update(['image' => $fileName]);
            }

            return redirect('/product')->with('success', 'Product created successfully!');
        }

        // Get all categories for dropdown
        $categories = Categories::latest()->get();
        return view('admin.products.create', compact('categories'));
    }

    // ----------------------------------------
    // EDIT PRODUCT
    // ----------------------------------------
    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Categories::all(); 

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // ----------------------------------------
    // UPDATE PRODUCT
    // ----------------------------------------
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'title'           => 'required|string|regex:/^[A-Za-z\s]+$/|max:255',
            'description'     => 'required|string|max:255',
            'actual_price'    => 'required|numeric',
            'discount_price'  => 'nullable|numeric',
            'tags'            => 'nullable|string',
            'category_id'     => 'required|exists:categories,id',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Update base product fields
        $product->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'actual_price'  => $request->actual_price,
            'discount_price'=> $request->discount_price,
            'tags'          => $request->tags,
            'category_id'   => $request->category_id,
            'status'        => $request->has('status') ? 1 : 0,
        ]);

        // Handle NEW image
        if ($request->hasFile('image')) {

            // Delete old image
            if ($product->image) {
                $oldPath = public_path('uploads/products/' . $product->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Upload new image
            $file       = $request->file('image');
            $uploadPath = public_path('uploads/products');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $fileName = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            $product->update(['image' => $fileName]);
        }

        return redirect('/product')->with('success', 'Product updated successfully!');
    }

    // ----------------------------------------
    // DELETE PRODUCT
    // ----------------------------------------
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image from folder
        if ($product->image) {
            $path = public_path('uploads/products/' . $product->image);
            if (file_exists($path)) @unlink($path);
        }

        $product->delete();

        return redirect('/product')->with('success', 'Product deleted successfully!');
    }

    // ----------------------------------------
    // TOGGLE STATUS
    // ----------------------------------------
    public function toggleStatus($id)
    {
        $product         = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();

        return redirect()->back();
    }
}
    