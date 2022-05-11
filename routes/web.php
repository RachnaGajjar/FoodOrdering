<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ForgetPasswordController;
use App\Http\Controllers\UserController;
use APP\Http\Controllers\RestaurantController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.login');
})->name('login.page');


Auth::routes(['verify' => true]);
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login');
Route::get('/dashboard', [App\Http\Controllers\Auth\LoginController::class, 'dashboard'])->name('dashboard');
Route::get('/user/verify/{token}', [App\Http\Controllers\RestaurantController::class, 'verifyuser']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/restaurant', App\Http\Controllers\RestaurantController::class);
Route::post('/upload-images', [App\Http\Controllers\RestaurantController::class, 'storeImage'])->name('images.store');
Route::post('api/fetch-states', [App\Http\Controllers\RestaurantController::class, 'fetchState']);
Route::post('api/fetch-cities', [App\Http\Controllers\RestaurantController::class, 'fetchCity']);
Route::get('/profile', [App\Http\Controllers\RestaurantProfileController::class, 'Profile'])->name('profile');
Route::post('/ajax-request', [\App\Http\Controllers\RestaurantProfileController::class, 'updateprofileAjax']);
Route::resource('/foodmenu', App\Http\Controllers\FoodMenuController::class);
Route::get('/viewProduct', [App\Http\Controllers\viewProductController::class, 'viewproduct'])->name('viewproduct');
Route::post('/Ajaxreason', [App\Http\Controllers\viewProductController::class, 'Ajaxreason'])->name('Ajaxreason');
Route::get('users/restore', [App\Http\Controllers\FoodMenuController::class, 'restoreAll'])->name('restore');

Route::get('Category', 'Category@index')->name('category');
Route::get('Category-create', [App\Http\Controllers\Category::class, 'create'])->name('category.create');
Route::post('Category/store', [App\Http\Controllers\Category::class, 'store'])->name('category.store');
Route::get('/getmenu', [App\Http\Controllers\Menu::class, 'getMenu']);
