<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{

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
