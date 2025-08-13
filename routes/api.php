<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\ContactusController;
use App\Http\Controllers\api\CareerController;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return response()->json(['message' => 'API root working']);
});

Route::get('/ping', function () {
    return response()->json(['message' => 'API is working']);
});


Route::post('/contactus', [ContactusController::class, 'store']);


Route::post('/career', [CareerController::class, 'store']);

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/product', [ProductController::class, 'store']);
Route::match(['get', 'post'], 'product_list', [ProductController::class, 'show']);