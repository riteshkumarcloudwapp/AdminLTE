<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use OpenApi\Annotations as OA;

class TermsAndConditionController extends Controller
{


     /**
     * @OA\Get(
     *     path="/api/terms-and-conditions",
     *     summary="Get Terms and Conditions",
     *     description="Fetch application terms and conditions",
     *     tags={"CMS"},
     *  security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Terms and conditions fetched successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Terms and Conditions"),
     *             @OA\Property(property="content", type="string", example="By using this app you agree...")
     *         )
     *     )
     * )
     */

    public function getTerms(Request $request){

        $terms = TermsAndCondition::first() ;

        if( !$terms ){

            return response()->json([
                'status' => False ,
                'message' => 'Terms and Condition not found!!' ,
            ] , 404) ;
            }

            return response()->json([
                'status' => True ,
                'data' => $terms ,
                'message' => 'Terms and Condition fetched successfully!!' 
            ] , 201);
        }
}
