<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ManageCarddetailsController;
use App\Http\Controllers\API\ForgetPasswordController;
use App\Http\Controllers\EncryptionDecryption;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\API\AddCartController;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\API\OrderController;

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
//Routes for Login and Register API.
Route::post('register',[RegisterController::class,'Register']);
Route::post('login',[RegisterController::class,'login']);
Route::post('forget',[ForgetPasswordController::class,'forget']);
Route::post('reset/{token}',[ForgetPasswordController::class,'reset']);
Route::post('encryption',[EncryptionDecryption::class,'encryption']);
Route::post('productlist',[ProductListController::class,'ProductList']);
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::middleware('auth:api')->group(function ()
{
    Route::post('orders',[OrderController::class,'orders']);
    Route::post('addcart',[AddCartController::class,'addToCart']);
    Route::post('editcart',[AddCartController::class,'editToCart']);
    Route::post('deletecart',[AddCartController::class,'deleteToCart']);
    Route::post('profile', [ProfileController::class,'Profile']);
    Route::post('updateprofile',[ProfileController::class,'Updateprofile']);
    Route::post('carddetails', [ManageCarddetailsController::class, 'carddetails']);
    Route::post('userscard', [ManageCarddetailsController::class, 'UsersCards']);
    Route::get('mangeorders',[OrderController::class,'manageorders']);
    Route::get('orderdetails',[OrderController::class,'orderdetails']);


});
