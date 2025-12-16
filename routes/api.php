<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController ;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\PrivacyPolicyController;
use App\Http\Controllers\API\TermsAndConditionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/user/login', [AuthController::class, 'loginUser']);

// protected routes

Route::middleware('auth:sanctum')->group( function(){

   Route::get('/products', [ProductController::class, 'products']);
   Route::get('/categories', [CategoriesController::class, 'categories']);

   Route::get('/privacy-policy' , [PrivacyPolicyController::class , 'getPolicy']);
   Route::get('/terms-condition' , [TermsAndConditionController::class , 'getTerms']);

} );
