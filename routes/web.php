<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {
    Route::prefix('listings')->group(function () {
        Route::get('/create', [ListingController::class, 'create']);
        Route::post('/', [ListingController::class, 'store']);
        Route::get('/{listing}/edit', [ListingController::class, 'edit']);
        Route::put('/{listing}', [ListingController::class, 'update']);
        Route::delete('/{listing}', [ListingController::class, 'destroy']);
        //manage listing
        Route::get('manage',[ListingController::class, 'manage']);
    });
// user logout
Route::post('/logout',[UserController::class,'logout']);
});

Route::get('listings/{listing}', [ListingController::class, 'show']);
Route::get('/', [ListingController::class, 'index']);


// user route

Route::middleware('guest')->group(function () {
    // register
Route::get('/register',[UserController::class,'create']);
// login form
Route::get('/login',[UserController::class,'login'])->name('login');
});

//store new users
Route::post('/users',[UserController::class,'store']);




// login user
Route::post('/users/authenticate',[UserController::class,'authenticate']);
