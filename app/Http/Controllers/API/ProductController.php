<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
        // product list api
    public function products(Request $request)
    {
        $query = Product::query();

        // Optional: search by name
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $products = $query->select('title','description','actual_price','discount_price','image')->paginate(10);

        return response()->json($products);
    }

    
}


