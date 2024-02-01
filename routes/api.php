<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// apis controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;


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

Route::controller(CategoryController::class)->group(function(){
    Route::get("/categories","index");
    Route::post("/categories","store");
    Route::patch("/categories/{id_category}","update");
    Route::delete("/categories/{id_category}","destroy");
});

Route::controller(BookController::class)->group(function(){
    Route::get("/books","index");
    Route::post("/books","store")->name("book.store");
    Route::patch("/books/{id_book}","update")->name("book.update");
    Route::delete("/books/{id_book}","destroy");
});
