<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\API\AuthController as APIAuthController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermsAndConditionController;


/* ========== Public Routes (no login required) ========== */
Route::match(['get','post'], '/login', [AuthController::class , 'login'])->name('admin.login');
Route::get('/logout', [AuthController::class , 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {   

/*...........DashBoard Routes............*/
Route::get('/', [DashboardController::class, 'dashboard']);
 
/*...........Admin Routes....................*/

Route::get('/admin/dashboard' , [AuthController::class , 'adminDashboard']);

Route::match(['get','post'], '/admin/edit', [AuthController::class , 'editProfile'])->name('admin.editProfile');

Route::match(['get','post'], '/admin/changepassword',[AuthController::class , 'changePassword'])->name('admin.changePassword');


/*..........Admin User Route..........*/
Route::get('/user', [UserController::class , 'index']);

Route::match(['get' , 'post'] , '/user/{id}' , [UserController::class , 'update'])->name('user.update');

Route::delete('/user/{id}', [UserController::class , 'destroy']);

Route::match(['get','post'], '/users/create',[UserController::class , 'create'])->name('users.create');

/*........Admin Products Route........*/
Route::get('/product', [ProductController::class , 'showCards']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
// Removed ProductImage id delete route (no longer used)
Route::post('/product/{id}/status', [ProductController::class, 'toggleStatus'])->name('product.status');
Route::match(['get','post'], '/product/create', [ProductController::class, 'create'])->name('product.create');
Route::delete('/product/image-delete/{id}/{image}', [ProductController::class, 'removeImage'])->name('product.image.delete');

/*............Admin Testimonial Routes............*/
Route::get('/testimonial', [TestimonialController::class, 'index']);
Route::match(['get','post'], '/testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
Route::get('/testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonial.edit');
Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');

/*............Admin Categories Routes............*/
Route::get('/categories', [CategoriesController::class, 'showCategories']);
Route::match(['get','post'],'/categories/create',[CategoriesController::class, 'create'])->name('categories.create');

Route::get('/categories/{id}/edit' , [CategoriesController::class, 'editCategories'])->name('categories.edit');
Route::put('/categories/{id}' , [CategoriesController::class, 'updateCategories'])->name('categories.update');

Route::delete('/categories/{id}' , [CategoriesController::class, 'deleteCategories'])->name('categories.delete');
Route::post('/categories/{id}/status' , [CategoriesController::class, 'toggleStatus'])->name('categories.status');  

/*............Admin Payments Routes............*/
Route::get('/payment', [PaymentController::class, 'paymentPage']);
Route::post('/admin/payment/store', [PaymentController::class, 'store'])->name('payment.store');

/*..........Admin termsandcondition......*/
Route::match(['get' , 'post'] , '/admin/termsandcondition' , [TermsAndConditionController::class , 'termsandcondition'])->name('admin.termsandcondition');

/*..........Admin PrivacyPolicy......*/
Route::match(['get' , 'post'] , '/admin/privacypolicy' , [PrivacyPolicyController::class ,
'privacypolicy' ])->name('admin.privacypolicy');

});
