<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    // category api
    public function categories(Request $request)
    {
        $query = Categories::query();

        // Optional: search by name
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $categories = $query->select('name','image')->paginate(10);

        return response()->json($categories);
    }
}
