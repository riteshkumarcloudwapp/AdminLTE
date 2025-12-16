<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get products list",
     *     description="Fetch paginated products",
     *     tags={"Products"},
     *  security={{"bearerAuth":{}}},
     *  
     *     @OA\Response(
     *         response=200,
     *         description="Products fetched successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="title", type="string", example="Gaming Laptop"),
     *                     @OA\Property(property="description", type="string", example="High performance laptop"),
     *                     @OA\Property(property="actual_price", type="number", example=75000),
     *                     @OA\Property(property="discount_price", type="number", example=69999),
     *                     @OA\Property(property="image", type="string", example="laptop.jpg")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function products(Request $request)
    {
        $query = Product::query();

        // Optional search by title
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query
            ->select('title', 'description', 'actual_price', 'discount_price', 'image')
            ->paginate(10);

        return response()->json($products);
    }
}
