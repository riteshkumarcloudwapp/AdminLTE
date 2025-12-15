<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;

class TermsAndConditionController extends Controller
{
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
