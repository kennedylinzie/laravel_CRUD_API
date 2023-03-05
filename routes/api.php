<?php

use App\Http\Controllers\Api\productController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('products',[productController::class,'index']);
Route::post('products',[productController::class,'addProducts']);
Route::get('products/{id}',[productController::class,'get_A_product']);
Route::get('products/{id}/edit',[productController::class,'edit']);
Route::put('products/{id}/edit',[productController::class,'update_product']);
Route::delete('products/{id}/delete',[productController::class,'destroy']);
