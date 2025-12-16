<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use OpenApi\Annotations as OA;

class PrivacyPolicyController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/privacy-policy",
     *     summary="Get Privacy Policy",
     *     description="Fetch application privacy policy",
     *     tags={"CMS"},
     *  security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Privacy policy fetched successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Privacy Policy"),
     *             @OA\Property(property="content", type="string", example="Your privacy is important to us...")
     *         )
     *     )
     * )
     */

    // fetch privacy policy
    public function getPolicy(Request $request){
        $policy = PrivacyPolicy::first();

        if(!$policy){

            return response()->json([
                'status' => False ,
                'message' => 'privacy policy not found',

            ], 404);
        }

        return response()->json([
            'status' => True ,
            'data' => $policy ,
            'message' => 'privacy Policy fetched successfully!!',
        ] , 201);
    }
    
}
