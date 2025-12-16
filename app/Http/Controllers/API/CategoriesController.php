<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use OpenApi\Annotations as OA;

class CategoriesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Get categories list",
     *     description="Fetch paginated categories",
     *     tags={"Categories"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Categories fetched successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="name", type="string", example="Electronics"),
     *                     @OA\Property(property="image", type="string", example="electronics.jpg")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function categories(Request $request)
    {
        $categories = Categories::select('name', 'image')
            ->paginate(10);

        return response()->json($categories);
    }
}
